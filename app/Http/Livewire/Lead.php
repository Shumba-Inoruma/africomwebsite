<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Lead extends Component
{

    public $firstName;
    public $lastName;
    public $location;
    public $phone;
    public $email;
    public $gender;

    protected $rules = [
        'firstName' => 'required|min:2|max:50',
        'lastName' => 'required|min:2|max:50',
        'location' => 'required|min:2|max:100',
        'phone' => 'required|numeric|digits_between:10,12',
        'email' => 'required|email',
        'gender' => 'required|in:1,2', // Assuming "1" is Male and "2" is Female
    ];
    protected function updated($fields){
        $this->validateOnly($fields);
    }


    public function sendLead()
    {
        // Validate the input data
        $this->validate();

        // Handle successful validation logic here (e.g., sending an email or saving to database)
        session()->flash('success', 'Your information has been submitted successfully!');
        
        // Clear the form
        $this->reset(['firstName', 'lastName', 'location', 'phone', 'email', 'gender']);
    }

    public function render()
    {
        return view('livewire.lead');
    }
}
