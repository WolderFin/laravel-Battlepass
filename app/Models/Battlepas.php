<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Battlepas extends Model
{
    use HasFactory;
    protected $table = 'battlepas';
    protected $primaryKey = 'lvl';
    protected $guarded = false;
}
