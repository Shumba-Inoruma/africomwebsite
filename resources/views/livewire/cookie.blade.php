<div>


    @if (session()->has("sucess"))
   
    <div x-data="{ show: true }" x-init='setTimeout(()=>show=false,4000)'x-show='show'>
    <div class="alert alert-success" role="alert" style="text-align: center;width:60%;margin-left:20%;margin">
    {{session()->get("sucess")}}
    
    </div>
        </span>
    </div>
    <script>
        setTimeout(function () {
       $('#exampleModalCenter').modal('hide'); 
       setcookie("name","chaos",20);


  }, 2000);

   </script>

    
    
    @endif
    <form action="#" wire:submit.prevent="saveEmail">
        <label for="">Please Provide Your Email to Get Newsletter</label>
        <div class="form-group mb-4">
          <input wire:model="email" type="text" class="form-control text-center" placeholder="Email">
        </div>

        <div class="d-flex">
          <div class="mx-auto">
         
          <button type="submit" style=" border-radius:5px; background-color:green;border:0px;height:35px;"> <span  style="color: white;"> SUBMIT</span></button>
          <button onclick="myFunction()" style=" border-radius:5px; background-color:green;border:0px;height:35px;"> <span  style="color: white;">LATER</span></button>

          </div>
        </div>
      </form>
      @error('email')
      <p style="color:rgb(255, 61, 31);font-size:15px;">{{$message}}</p>
      @enderror   

</div>