<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Mail\sendmail;
use Illuminate\Support\Facades\Mail;

class Contact extends Component
{
    public $name;
    public $email;
    public $subject;
    public $message;
    public $allemail=['munyaradzichirove@gmail.com','contactcenter@afri-com.net'];
    public function render()
    {
        return view('livewire.contact');
    }

    protected $rules=[
        'name'=>'required|min:5',
        'email'=>'required|email',
        'subject'=>'required|min:10',
        'message'=>'required|min:10'
    ];

    protected function updated($fields){
        $this->validateOnly($fields);
    }

    public function sendMail(){
    
        $this->validate();
        $data=[
        'name'=>$this->name,
        'email'=>$this->email,
        'subject'=>$this->subject,
        'message'=>$this->message,
    
    ];

    // try{
        $allemail=['munyaradzichirove@gmail.com'];        
        Mail::to($allemail)
        ->send(new sendMail($data));
        Session()->flash("sucess","The email has been sent.Thank You");
        $this->name="";
        $this->email="";
        $this->subject="";
        $this->message="";
    

    // } 
    // catch(\Throwable $th){
    //       Session()->flash("sucess","The email has been sent.Thank Youuu");
    //     $this->name="";
    //     $this->email="";
    //     $this->subject="";
    //     $this->message="";
    
    // }

       
     
         




    }
   
   

}
