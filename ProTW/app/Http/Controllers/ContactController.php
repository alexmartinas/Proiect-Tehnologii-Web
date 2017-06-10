<?php namespace App\Http\Controllers;
use App\Http\Requests\ContactFormRequest;

class ContactController extends Controller {

    public function create()
    {
        return view('about.contact');
    }

    public function store(ContactFormRequest $request)
    {

        \Mail::send('emails.contact',
            array(
                'name' => $request->get('name'),
                'email' => $request->get('email'),
                'user_message' => $request->get('message')
            ), function($message)
            {
                $message->from('kid.monitoringsender@gmail.com');
                $message->to('kid.monitoringtw@gmail.com', 'Admin')->subject('test contact');
            });

        return \Redirect::route('contact')->with('message', 'Thanks for contacting us!');

    }

}