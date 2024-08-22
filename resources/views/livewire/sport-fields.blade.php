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
  
    <form wire:submit.prevent="saveSport" method="post" role="form" class="php-email-form">
        <div class="row">
          <div class="col-md-6 form-group">
            <input wire:model="name" type="text" name="name" class="form-control" id="name" placeholder="First Name" >
            @error('name')
            <p style="color:rgb(171, 75, 60);font-size:12px;">{{$message}}</p>
            @enderror
          </div>
          <div class="col-md-6 form-group mt-3 mt-md-0">
            <input  wire:model="surname" type="text" class="form-control" name="surname" id="surname" placeholder="Surname" >
            @error('surname')
            <p style="color:rgb(171, 75, 60);font-size:12px;">{{$message}}</p>
            @enderror
          </div>
        </div>
        <select class="form-select" aria-label="Default select example" style="width: 100%;height: 50px;margin-top: 10px;" wire:model="gender">
    <option selected>Select Gender</option>
    <option value="male">Male</option>
    <option value="female">Female</option>
</select>
@error('gender')
    <p style="color:rgb(171, 75, 60);font-size:12px;">{{$message}}</p>
@enderror

              
<div style="width: 100%; margin-top: 10px;">
    <h3>Choose Sports</h3>
    <label><input type="checkbox" name="activity" value="5 aside soccer" wire:model="sports"> 5 aside soccer</label><br>
    <label><input type="checkbox" name="activity" value="Zumba" wire:model="sports"> Zumba</label><br>
    <label><input type="checkbox" name="activity" value="Tug-of-war" wire:model="sports"> Tug-of-war</label><br>
    <label><input type="checkbox" name="activity" value="Medical Checks" wire:model="sports"> Medical Checks</label>
    @error('sports')
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
          <span wire:loading.remove>Register</span> 
          <span wire:loading>Please Wait...</span> 
        </button>
        <br><br>
        <div>
          <p style="color:red">Deadline for registration: Tuesday 20 August</p>
        </div>
      
      </div>
      </form>
</div>
