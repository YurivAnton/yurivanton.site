<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactFormRequest;
use Illuminate\Http\Request;

use \Illuminate\Http\Response;

class ContactController extends Controller
{
    public function contact(ContactFormRequest $request)
    {
        $validated = $request->validated();
        return redirect()->back();
    }
}
