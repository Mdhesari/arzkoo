<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SEOMeta;

class ContactUsController extends Controller
{
    public function __construct()
    {
        SEOMeta::setTitle('تماس با ما');
    }

    public function index()
    {
        return view('contactus.index');
    }
}
