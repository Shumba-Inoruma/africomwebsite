<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\newsletter;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class Cookie extends Component
{
    public $email;
    public function render()
    {
        return view('livewire.cookie');
    }
    protected $rules=[
        'email'=>'email|required',
    ];
    public function updated($fields){
         $this->validateOnly($fields);
    }

    public function saveEmail(){
        $this->validate();
        if(newsletter::where('email',$this->email)->first()){
            session()->flash("sucess","Email Saved");
            $this->email="";

        }
        else{
            newsletter::create(["email"=>$this->email]);
            session()->flash("sucess","Email Saved");
            $this->email="";
        }
 


        
        
    }

   
}
