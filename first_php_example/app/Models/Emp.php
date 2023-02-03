<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Emp extends Model
{
    use HasFactory;
    protected $fillable = [
        'emp_name',
        'emp_email',
        'emp_gender',
        'emp_image'
    ];
}
