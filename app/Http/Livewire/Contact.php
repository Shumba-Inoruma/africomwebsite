<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Mail\sendmail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Http;

class Contact extends Component
{
    public $name;
    public $surname;
    public $email;
    public $phone;
    public $gender;
    public $product;
    public $location;
    public $message;
    public $allemail = ['munyaradzichirove@gmail.com',"customerquiries@afri-com.net"];

    public function render()
    {
        return view('livewire.contact');
    }

    protected $rules = [
        'name' => 'required|min:5',
        'surname' => 'required|min:5',
        'email' => 'required|email',
        'phone' => 'required|min:10',
        'gender' => 'required',
        'product' => 'required',
        'location' => 'required|min:5',
        'message' => 'required|min:10',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function sendMail()
    {
        $this->validate();

        // Handle product mapping logic
        switch ($this->product) {
            case 1:
                $this->product = 'Starlink';
                break;
            case 2:
                $this->product = 'CatchApp';
                break;
            case 3:
                $this->product = 'Maswerasei';
                break;
            case 4:
                $this->product = 'Mobile Voice and Data';
                break;
            case 5:
                $this->product = 'Broadband Plus';
                break;
            case 6:
                $this->product = 'Other';
                break;
            default:
                $this->product = 'Unknown';  // Default if no valid product is selected
                break;
        }

        // Handle gender mapping logic
        switch ($this->gender) {
            case 1:
                $this->gender = 'Male';
                break;
            case 2:
                $this->gender = 'Female';
                break;
            case 3:
                $this->gender = 'Other';
                break;
            default:
                $this->gender = 'Unknown';  // Default if no valid gender is selected
                break;
        }

        $data = [
            'name' => $this->name,
            'surname' => $this->surname,
            'email' => $this->email,
            'phone' => $this->phone,
            'gender' => $this->gender,  // The modified gender value will be sent here
            'product' => $this->product,  // The modified product value will be sent here
            'location' => $this->location,
            'message' => $this->message,
        ];

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Cookie' => 'full_name=Guest; sid=Guest; system_user=no; user_id=Guest; user_image='
        ])->post('https://erp.ai.co.zw/api/method/africom_cdma.www.number.create_lead', [
            'first_name' => $data['name'],
            'surname' => $data['surname'],
            'phone' => $data['phone'],
            'gender' => $data['gender'],
            'product' => $data['product'],
            'email' => $data['email'],
            'location' => $data['location'],
            'message' => $data['message']
        ]);

        // Send the email
        Mail::to($this->allemail)
            ->send(new sendMail($data));

        // Show success message and reset the form
        session()->flash("success", "The email has been sent. Thank you!");
        $this->reset();
    }
}
