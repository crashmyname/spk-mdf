<?php

namespace App\Controllers;

use Bpjs\Framework\Helpers\BaseController;
use Bpjs\Core\Request;
use Bpjs\Framework\Helpers\Validator;
use Bpjs\Framework\Helpers\View;
use Bpjs\Framework\Helpers\CSRFToken;

class ApprovalController extends BaseController
{
    // Controller logic here
    public function index()
    {
        $title = 'Approval SPK';
        // vd($title);
        return view('approval/approval',['title'=>$title],'layout/app');
    }
}
