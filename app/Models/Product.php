<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
	protected $fillname='products';
	protected $fillable=['name','source','time_expired'];
	public function sizes(){
		return $this->belongstomany('App\Models\Size','middle','product_id','size_id')->withPivot('price','stock','id')->withTimestamps();;
	}
	public function images(){
		return $this->hasmany('App\Models\Image','product_id','id')->orderby('sort','desc');
	}
	// public function delete()    
 //    {
 //        DB::transaction(function() 
 //        {
 //            $this->images()->delete();
 //            parent::delete();
 //        });
 //    }
    //
}
