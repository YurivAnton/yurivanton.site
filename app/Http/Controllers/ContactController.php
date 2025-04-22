<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactFormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendEmail;
use \Illuminate\Http\Response;

class ContactController extends Controller
{
    public function contact(ContactFormRequest $request)
    {
        $validated = $request->validated();
        $data = $request->validated();

        Mail::to('yurivanton@gmail.com')->send(new SendEmail($data));
        return redirect()->back();
    }
}
