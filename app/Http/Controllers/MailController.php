<?php

namespace App\Http\Controllers;

use App\Mail\Attendance;
use Illuminate\Http\Request;
use App\Mail\WelcomeEmail;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function test()
    {
        Mail::to('jerrichopamisa@gmail.com')->send(new WelcomeEmail());
    }
    public function AttendanceCheck($value)
    {
        Mail::to('jerrichopamisa@gmail.com')->send(new Attendance());
    }
}
