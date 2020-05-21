<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;
class Middle extends Model
{
    protected $fillname = 'middle';
    protected $fillable = ['product_id','size_id','price','stock'];
}
