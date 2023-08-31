<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\newsletter;
use Illuminate\Http\Request;
class Newsletters extends Component
{
    public $email;
    public function render()
    {
        return view('livewire.newsletters');
    }
    protected $rules=[
        'email'=>'email|required|unique:newsletters',
    ];
    public function updated($fields){
         $this->validateOnly($fields);
    }
    public function saveEmail(Request $request){

        $this->validate();
        if (newsletter::where('email',$this->email)->first()){
        }
        else{
            newsletter::create(["email"=>$this->email]);
            session()->flash("sucess","Email Saved");
            $this->email="";
        }
      

    }

   
}
