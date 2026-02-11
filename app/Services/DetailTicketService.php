<?php

namespace App\Services;
use App\Repository\DetailTicketRepository;
use Bpjs\Framework\Helpers\Validator;

class DetailTicketService
{
    // Service logic here
    public function __construct(protected DetailTicketRepository $repo){}
    public function getData($id)
    {
        
    }
    public function create(array $data)
    {
        $detail = $this->repo->create($data);
        return [
            'success' => true,
            'status' => 200,
            'data' => $detail
        ];
    }

    public function update(array $data)
    {

    }

    public function destroy(array $data)
    {

    }
}
