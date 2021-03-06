<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class SendMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        if($data['sender'] == "Admin"){
            $this->name = "Admin Support";
        }else{
            $this->name = Auth::guard('vendor')->user()->name;
        }
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // return $this->view('view.name');
        return $this->subject(Str::limit($this->data['subject'], 20, '...'))->markdown('emails.create.vendor', [
            'subject' => $this->data['subject'],
            'content' => $this->data['content'],
            'name' => $this->name,
            
        ]);
    }
}
