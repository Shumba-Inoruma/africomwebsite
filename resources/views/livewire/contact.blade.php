<div>
    @if (session()->has("success"))
        <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 4000)" x-show="show">
            <div class="alert alert-success" role="alert" style="text-align: center; width: 60%; margin-left: 20%;">
                {{ session()->get("success") }}
            </div>
        </div>
    @endif

    <form wire:submit.prevent="sendMail" method="post" class="php-email-form">
        <div class="row">
            <div class="col-md-12 form-group">
                <input wire:model="name" type="text" class="form-control" placeholder="Your Name">
                @error('name')<p style="color:rgb(171, 75, 60); font-size:12px;">{{ $message }}</p>@enderror
            </div>
            
            <div class="col-md-12 form-group">
                <input wire:model="surname" type="text" class="form-control" placeholder="Surname">
                @error('surname')<p style="color:rgb(171, 75, 60); font-size:12px;">{{ $message }}</p>@enderror
            </div>
            
            <div class="col-md-6 form-group">
                <input wire:model="email" type="email" class="form-control" placeholder="Your Email">
                @error('email')<p style="color:rgb(171, 75, 60); font-size:12px;">{{ $message }}</p>@enderror
            </div>
            
            <div class="col-md-6 form-group">
                <input wire:model="phone" type="text" class="form-control" placeholder="Phone Number">
                @error('phone')<p style="color:rgb(171, 75, 60); font-size:12px;">{{ $message }}</p>@enderror
            </div>
            
            <div class="col-md-6 form-group mt-3">
                <select wire:model="gender" class="form-select">
                    <option value="">Select Gender</option>
                    <option value="1">Male</option>
                    <option value="2">Female</option>
                    <option value="3">Other</option>
                </select>
                @error('gender')<p style="color:rgb(171, 75, 60); font-size:12px;">{{ $message }}</p>@enderror
            </div>
            
            <div class="col-md-6 form-group mt-3">
                <select wire:model="product" class="form-select">
                    <option value="">Select Product</option>
                    <option value="1">Starlink</option>
                    <option value="2">CatchApp</option>
                    <option value="3">Maswerasei</option>
                    <option value="4">Mobile Voice and Data</option>
                    <option value="5">Broadband Plus</option>
                    <option value="6">Other</option>
                </select>
                @error('product')<p style="color:rgb(171, 75, 60); font-size:12px;">{{ $message }}</p>@enderror
            </div>
        </div>
        
        <div class="form-group mt-3">
            <input wire:model="location" type="text" class="form-control" placeholder="Location">
            @error('location')<p style="color:rgb(171, 75, 60); font-size:12px;">{{ $message }}</p>@enderror
        </div>
        
        <div class="form-group mt-3">
            <textarea wire:model="message" class="form-control" placeholder="Message" style="height: 250px;"></textarea>
            @error('message')<p style="color:rgb(171, 75, 60); font-size:12px;">{{ $message }}</p>@enderror
        </div>
        
        <div class="text-center mt-3">
            <button type="submit" style="border-radius: 35px;">
                <span wire:loading.remove>Submit</span>
                <span wire:loading>Please Wait...</span>
            </button>
        </div>
    </form>
</div>
