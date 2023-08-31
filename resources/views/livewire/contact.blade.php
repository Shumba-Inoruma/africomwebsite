<div>

    @if (session()->has("sucess"))

    <div x-data="{ show: true }" x-init='setTimeout(()=>show=false,4000)'x-show='show'>
    <div class="alert alert-success" role="alert" style="text-align: center;width:60%;margin-left:20%;">
    {{session()->get("sucess")}}
    
    </div>
        </span>
    </div>
    {{$succ=""}}
    
    
    @endif
  
    <form wire:submit.prevent="sendMail" method="post" role="form" class="php-email-form">
        <div class="row">
          <div class="col-md-6 form-group">
            <input wire:model="name" type="text" name="name" class="form-control" id="name" placeholder="Your Name" >
            @error('name')
            <p style="color:rgb(171, 75, 60);font-size:12px;">{{$message}}</p>
            @enderror
          </div>
          <div class="col-md-6 form-group mt-3 mt-md-0">
            <input  wire:model="email" type="email" class="form-control" name="email" id="email" placeholder="Your Email" >
            @error('email')
            <p style="color:rgb(171, 75, 60);font-size:12px;">{{$message}}</p>
            @enderror
          </div>
        </div>
        <div class="form-group mt-3">
          <input  wire:model="subject" type="text" class="form-control" name="subject" id="subject" placeholder="Subject" >
          @error('subject')
          <p style="color:rgb(171, 75, 60);font-size:12px;">{{$message}}</p>
          @enderror
        </div>
        <div class="form-group mt-3">
          <textarea  wire:model="message" class="form-control" name="message" placeholder="Message" style="height: 250px;"></textarea>
          @error('message')
          <p style="color:rgb(171, 75, 60);font-size:12px;">{{$message}}</p>
          @enderror
        </div>
        <div class="my-3">
          <div class="loading">Loading</div>
          <div class="error-message"></div>
          <div class="sent-message">Your message has been sent. Thank you!</div>
        </div>
        <div class="text-center">
        <button type="submit" style="border-radius:35px;back">
          <span wire:loading.remove>Send Message</span> 
          <span wire:loading>Please Wait...</span> 
        </button>
      
      </div>
      </form>
</div>
