<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class sport extends Model
{
    use HasFactory;
    protected $table = 'sports';

    protected $fillable = ['firstname', 'surname', 'gender', 'sports'];
    
}
