<?php

namespace App\Controllers;

use App\Models\User;
use Bpjs\Framework\Helpers\BaseController;
use Bpjs\Core\Request;
use Bpjs\Framework\Helpers\Validator;
use Bpjs\Framework\Helpers\View;
use Bpjs\Framework\Helpers\CSRFToken;

class HomeController extends BaseController
{
    // Controller logic here
    public function index()
    {
        $title = 'Dashboard';
        $user = User::query()->count();
        return view('home/dashboard',['title' => $title,'user' => $user],'layout/app');
    }
}
