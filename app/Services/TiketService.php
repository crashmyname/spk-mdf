<?php

namespace App\Services;
use App\DTO\Ticket\TicketDTO;
use App\Repository\TicketRepository;
use Bpjs\Framework\Helpers\Mailer;
use Bpjs\Framework\Helpers\Validator;

class TiketService
{
    // Service logic here
    public function __construct(protected TicketRepository $ticketrepo){}
    public function createTicket(array $data)
    {
        $validate = $this->validate($data);
        if($validate){
            return [
                'success' => false,
                'status' => 422,
                'message' => $validate
            ];
        }
        $ticket = $this->ticketrepo->createTicket($data);
        if($ticket){
            $this->uploadedFile($data['sketch_item']);
            $this->sentEmail();
        }
        return [
            'success' => true,
            'status' => 200,
            'message' => 'SPK Created',
            'data' => $ticket
        ];
    }

    public function updateTicket($id, array $data)
    {
        $dto = new TicketDTO(
            $data['no_order'],
            $data['date_create'],
            $data['user_id'],
            $data['action'],
            $data['type_ticket'],
            $data['material_id'],
            $data['lot_shot'],
            $data['total_shot'],
            $data['sketch_item'],
            $data['options'],
        );
        vd($data);
        $ticket = $this->ticketrepo->updateTicket(array($dto));
        return [
            'success' => true,
            'status' => 200,
            'message' => 'success update ticket',
            'data' => $ticket
        ];
    }

    private function uploadedFile($file)
    {
        $path = storage_path('attachment');
        if(!is_dir($path)){
            mkdir($path,0777,true);
        }
        return uploadFile($file,$path);
    }

    private function sentEmail()
    {
        $mailer = Mailer::make();
        $mailer->to('fadli_azka_prayogi@stanley-electric.com')
        ->subject('Notification SPK Mold')
        ->body('<h1>Test</h1>')
        ->send();
    }

    private function validate(array $data)
    {
        $validate = Validator::make($data,
        [
            'date_create' => 'required',
            'user_id' => 'required',
            'action' => 'required',
            'type_ticket' => 'required',
            'material_id' => 'required',
            'sketch_item' => 'required|image:image/png,image/jpg,image/jpeg,image/webp,image/jfif',
        ],
        [
            'date_create.required' => 'Date Create is required',
            'user_id.required' => 'User is required',
            'action.required' => 'Action is required',
            'material_id.required' => 'Material is required',
            'sketch_item.required' => 'Sketch is required',
            'sketch_item.filetype' => 'Sketch must be image (jpg,png,jpeg,webp,jfif)',
        ]
        );
        return $validate;
    }
}
