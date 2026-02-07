<?php

namespace App\Services;
use App\DTO\Material\MaterialDTO;
use App\DTO\Ticket\TicketDTO;
use App\Repository\TicketRepository;
use Bpjs\Framework\Helpers\Date;
use Bpjs\Framework\Helpers\Mailer;
use Bpjs\Framework\Helpers\Validator;

class TiketService
{
    // Service logic here
    public function __construct(protected TicketRepository $ticketrepo){}
    public function createTicket(array $data,$file)
    {
        // vd($this->ticketrepo->getTicketById(1));
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
            $this->upload($file);
            $this->sentEmail($ticket);
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
        // vd($data);
        $ticket = $this->ticketrepo->updateTicket(array($dto));
        return [
            'success' => true,
            'status' => 200,
            'message' => 'success update ticket',
            'data' => $ticket
        ];
    }

    public function deleteTicket($id)
    {
        $ticket = $this->ticketrepo->deleteTicket($id);
        return [
            'success' => true,
            'status' => 200,
            'message' => 'success delete ticket',
            'data' => $ticket
        ];
    }

    private function upload($file)
    {
        // vd($file);
        $path = storage_path('attachment/');
        if(!is_dir($path)){
            mkdir($path,0777,true);
        }
        return uploadFile($file,$path);
    }

    private function sentEmail($ticket)
    {
        $dto = new TicketRepository();
        $res = $dto->getTicketById($ticket->ticket_id);
        $templatePath = BPJS_BASE_PATH .'/public/templates/email_ticket.html';
        if(!file_exists($templatePath)){
            throw new \Exception("Email template not found: ".$templatePath);
        }

        $template = file_get_contents($templatePath);

        $search = [
            '{receiver_name}',
            '{ticket_uuid}',
            '{no_order}',
            '{name}',
            '{section}',
            '{material}',
            '{type_ticket}',
            '{action}',
            '{lot_shot}',
            '{total_shot}',
            '{date_create}',
            '{ticket_url}'
        ];

        $replace = [
            'Mold & Dies Team',
            $ticket->uuid,
            $ticket->no_order,
            $res->user->name,
            $res->user->section,
            $res->material->mold_number,
            $ticket->type_ticket,
            $ticket->action,
            $ticket->lot_shot,
            $ticket->total_shot,
            Date::parse($ticket->date_create)->format('d-m-Y'),
            'http:sch-server:82/spk-mdf/'.$ticket->uuid
        ];

        $body = str_replace($search, $replace, $template);

        Mailer::make()
            ->to('fadli_azka_prayogi@stanley-electric.com')
            ->subject('Notification SPK Mold')
            ->body($body)
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
            'material' => 'required',
            'file_sketch' => 'required|image:image/png,image/jpg,image/jpeg,image/webp,image/jfif',
        ],
        [
            'date_create.required' => 'Date Create is required',
            'user_id.required' => 'User is required',
            'action.required' => 'Action is required',
            'material.required' => 'Material is required',
            'file_sketch.required' => 'Sketch is required',
            'file_sketch.filetype' => 'Sketch must be image (jpg,png,jpeg,webp,jfif)',
        ]
        );
        return $validate;
    }
}
