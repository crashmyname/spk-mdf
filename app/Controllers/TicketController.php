<?php

namespace App\Controllers;

use Bpjs\Framework\Helpers\BaseController;
use Bpjs\Core\Request;
use Bpjs\Framework\Helpers\Validator;
use Bpjs\Framework\Helpers\View;
use Bpjs\Framework\Helpers\CSRFToken;

class TicketController extends BaseController
{
    public function index()
    {
        // Tampilkan semua resource
    }

    public function show($id)
    {
        // Tampilkan resource dengan ID: $id
    }

    public function store(Request $request)
    {
        // Simpan resource baru
    }

    public function update(Request $request, $id)
    {
        // Update resource dengan ID: $id
    }

    public function destroy($id)
    {
        // Hapus resource dengan ID: $id
    }
}
