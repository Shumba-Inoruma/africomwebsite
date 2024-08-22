<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class sport2 extends Model
{
    use HasFactory;
    protected $table = 'sports2';

    protected $fillable = ['firstname', 'surname', 'gender', 'sports'];
}
