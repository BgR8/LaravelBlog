<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;

use App\Http\Requests;
use App\Post;
use Mail;
use Session;

class PagesController extends Controller {

    public function getIndex() {
        $posts = Post::orderBy('created_at', 'desc')->limit(4)->get();
        return view('pages.welcome')->withPosts($posts);
    }
    public function getAbout() {
        $first = 'İsim';
        $last = 'Soyad';
        $fullname = $first . " ". $last;
        $email = "bilgi@atolyemde.com";
        $data = [];
        $data['email'] = $email;
        $data['fullname'] = $fullname;
        return view('pages.about')->withData($data);
        //return view('pages.about')->withFullname($fullname)->withemail($email);
    }
    public function getContact() {
        return view('pages.contact');
    }

    public function postContact(Request $request) {
        $this->validate($request, [
            'email' => 'required|email',
            'subject' => 'min:3',
            'message' => 'min:10'
            ]);

            $data = array(
                'email' => $request->email,
                'subject' => $request->subject,
                'bodyMessage' => $request->message,
                'survey' => ['Q1' => 'hello', 'Q2' => 'YES']
            );
            
            Mail::send('emails.contact', $data, function ($message) use ($data) {
                $message->from($data['email']);;
                $message->to('bilgi@atolyemde.com', 'AtölyemDe');
                $message->subject($data['subject']);
            });

            Session::flash('success', 'Your email was Sent!');
            
            //return view('pages.contact');
            return redirect('/');
    }
}