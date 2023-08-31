<div>

    @if (session()->has("sucess"))

    <div x-data="{ show: true }" x-init='setTimeout(()=>show=false,4000)'x-show='show'>
    <div class="alert alert-success" role="alert" style="text-align: center;width:60%;margin-left:20%;margin">
    {{session()->get("sucess")}}
    
    </div>
        </span>
    </div>
    
    
    @endif
    <form wire:submit.prevent="saveEmail" method="post">
        @csrf
        <input wire:model="email" type="text" name="email" style="border: none; width:70%">
        <input type="submit" value="Subscribe"><br>
       
       
    </form> 
    @error('email')
    <p style="color:rgb(255, 61, 31);font-size:15px;">{{$message}}</p>
    @enderror   

</div>
