<div>
    @if (session()->has("success"))
        <div x-data="{ show: true }" x-init='setTimeout(()=>show=false,4000)' x-show='show'>
            <div class="alert alert-success" role="alert" style="text-align: center;width:60%;margin-left:20%;">
                {{ session()->get("success") }}
            </div>
        </div>
    @endif

    <form wire:submit.prevent="sendLead" method="post" role="form" class="php-email-form">
        <div class="row">
            <div class="col-md-12 form-group">
                <input wire:model="firstName" type="text" class="form-control" placeholder="First Name">
                @error('firstName')
                    <p style="color:rgb(171, 75, 60);font-size:12px;">{{ $message }}</p>
                @enderror
            </div>

            <div class="col-md-12 form-group">
                <input wire:model="lastName" type="text" class="form-control" placeholder="Last Name">
                @error('lastName')
                    <p style="color:rgb(171, 75, 60);font-size:12px;">{{ $message }}</p>
                @enderror
            </div>

            <div class="col-md-12 form-group">
                <input wire:model="location" type="text" class="form-control" placeholder="Location">
                @error('location')
                    <p style="color:rgb(171, 75, 60);font-size:12px;">{{ $message }}</p>
                @enderror
            </div>

            <div class="col-md-6 form-group mt-3 mt-md-0">
                <input wire:model="phone" type="text" class="form-control" placeholder="Phone Number">
                @error('phone')
                    <p style="color:rgb(171, 75, 60);font-size:12px;">{{ $message }}</p>
                @enderror
            </div>

            <div class="col-md-6 form-group mt-3 mt-md-0">
                <input wire:model="email" type="text" class="form-control" placeholder="Your Email">
                @error('email')
                    <p style="color:rgb(171, 75, 60);font-size:12px;">{{ $message }}</p>
                @enderror
            </div>

            <div class="col-md-6 form-group mt-3">
                <select wire:model="gender" class="form-select">
                    <option value="">Select Gender</option>
                    <option value="1">Male</option>
                    <option value="2">Female</option>
                </select>
                @error('gender')
                    <p style="color:rgb(171, 75, 60);font-size:12px;">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="text-center mt-3">
            <button type="submit" style="border-radius:35px;">
                <span >Send Message</span> 
                <!-- <span>Please Wait...</span>  -->
            </button>
        </div>
    </form>

    <style>
    .loading button span:not([wire\\:loading]) {
        display: none; /* hides the Send Message text when loading */
    }
</style>

</div>
