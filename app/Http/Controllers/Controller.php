<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
    
    public function download(){
        $file_path = public_path('activities.jpeg');
        return response()->download( $file_path);
    }
    public function sitedeveloper(){
        return redirect("https://mrchiroveonline.web.app");
    }
}
