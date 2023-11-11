<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GetGift extends Model
{
    use HasFactory;


    protected $table = 'get_gifts';
    protected $guarded = false;
}
