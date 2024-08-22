<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\sport2;

class SportFields extends Component
{

    public $name;
    public $surname;
    public $sports=[];
    public $gender;
    public function render()
    {
        return view('livewire.sport-fields');
    }
    protected $rules=[
        'name'=>'required|min:5',
        'sports'=>'required',
        'gender'=>'required',
      
    ];

    protected function updated($fields){
        $this->validateOnly($fields);
    }

    public function saveSport(){
        

    
        $this->validate();
        $sportsString = implode(', ', $this->sports);
        $data=[
        'firstname'=>$this->name,
        'surname'=>$this->surname,
        'gender'=>$this->gender,
        'sports'=>$sportsString,
    
    ];

    sport2::create($data);
        Session()->flash("sucess","The  has been sent.Thank You");
        $this->name="";
        $this->surname="";
        $this->sports=[];
        $this->gender="";
    

 

       
     
         




    }
   
   


}
