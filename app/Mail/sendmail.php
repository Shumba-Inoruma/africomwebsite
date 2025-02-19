<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class sendMail extends Mailable
{
    use Queueable, SerializesModels;
    private $data=[];
        

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
 
    {
        $this->data=$data;
   
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from("chirovemunyaradzi@gmail.com",'Africom Customer Email')
                    ->subject($this->data['product'])
                    ->view('emails.index')->with('data',$this->data)
                    ->replyTo($this->data['email']);
    }
}
