<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
	protected $fillname='products';
	protected $fillable=['name','source','time_expired'];
	public function sizes(){
		return $this->belongstomany('App\Models\Size','middle','product_id','size_id')->withPivot('price','stock');
	}
	
    //
}
