<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Radcheck extends Model
{
    use HasFactory;


    protected $table = 'radcheck'; // Specify the table name explicitly
    public $timestamps = false;
    protected $fillable = ['username', 'attribute', 'op', 'value'];

}
