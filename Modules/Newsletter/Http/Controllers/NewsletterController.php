<?php

namespace Modules\Newsletter\Http\Controllers;

// use App\Mail\NewsletterMail;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Mail;
use Modules\Newsletter\Entities\Email;
use Illuminate\Contracts\Support\Renderable;
use Modules\Newsletter\Emails\NewsletterMail;

class NewsletterController extends Controller
{
    public function subscribe(Request $request)
    {
        // dd($request->all());
        // if (!enableModule('newsletter')) {
        //     abort(404);
        // }

        $request->validate([
            'sub_email' => 'required|email|unique:emails,email'
        ]);

        $mail = Email::create(['email' => $request->sub_email]);
        if ($mail) {
            flashSuccess('Your subscription added successfully!');
        } else {
            flashError();
        }

        return back();
    }

    public function sendMail()
    {
        if (!userCan('newsletter.mailsend')) {
            abort(403);
        }
        $data['emails'] = Email::get();
        return view('newsletter::send-mail', $data);
    }

    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        if (!userCan('newsletter.view')) {
            abort(403);
        }

        $data['emails'] = Email::latest()->get();
        return view('newsletter::index', $data);
    }

    public function destroy(Email $email)
    {
        if (!userCan('newsletter.delete')) {
            abort(403);
        }
        $deleted = $email->delete();
        $deleted ? flashSuccess('Email Deleted Successfully') : flashError();
        return back();
    }

    public function submitMail(Request $request)
    {
        $request->validate([
            'emails' => 'required',
            'subject' => 'required',
            'body' => 'required',
        ]);

        if (!userCan('newsletter.mailsend')) {
            abort(403);
        }
        $arrayEmails = $request->emails;
        $emailSubject = $request->subject;
        $emailBody = $request->body;

        foreach ($arrayEmails as $email) {
            Mail::to($email)->send(new NewsletterMail($emailSubject, $emailBody));
        };

        flashSuccess('Mail Sent Successfully');
        return back();
    }
}
