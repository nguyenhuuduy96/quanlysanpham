<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillname='images';
    protected $fillable=['image','product_id'];
}
