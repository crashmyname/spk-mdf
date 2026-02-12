<?php

namespace App\Services;
use App\DTO\DetailTicket\DetailActDTO;
use App\DTO\DetailTicket\DetailTicketDTO;
use App\Models\DetailTicket;
use App\Repository\DetailTicketRepository;
use Bpjs\Core\Cache;
use Bpjs\Framework\Helpers\Validator;

class DetailTicketService
{
    // Service logic here
    public function __construct(protected DetailTicketRepository $repo){}
    public function getDetailReq($id)
    {
        $detail = $this->repo->req($id);
        if($detail){
            return [
                'status' => 200,
                'message' => 'data found',
                'data' => DetailTicketDTO::collection($detail)
            ];
        } else {
            return [
                'status' => 404,
                'message' => 'data not found',
                'data' => []
            ];
        }
    }

    public function getDetailAct($id)
    {
        $detailact = $this->repo->act($id);
        if($detailact){
            return [
                'status' => 200,
                'message' => 'data found',
                'data' => DetailActDTO::collection($detailact)
            ];
        } else {
            return [
                'status' => 404,
                'message' => 'data not found',
                'data' => []
            ];
        }
    }

    public function create(array $data)
    {
        $detail = $this->repo->create($data);
        Cache::forget($detail['detail_id']);
        return [
            'success' => true,
            'status' => 200,
            'data' => $detail
        ];
    }

    public function update(array $data, $id)
    {
       
    }

    public function destroy(array $data)
    {

    }

    public function createAct(array $data)
    {
        $detail = $this->repo->createAct($data);
        return [
            'success' => true,
            'status' => 200,
            'data' => $detail
        ];
    }
}
