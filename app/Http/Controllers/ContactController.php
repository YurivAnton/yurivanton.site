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

        // return var_dump($data);
        Mail::to('yurivanton@gmail.com')->send(new SendEmail($data));
        // return response()->json(['success' => 'Email sent successfully.']);
        return redirect()->back();
    }
}
