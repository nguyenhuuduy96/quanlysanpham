<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Image;
use App\Models\Size;
use Str;
class HomeCotroller extends Controller
{
	public function index(){
		$sizes=Size::all();
		// $product= Product::find(1);
		// // $add=$product->sizes()->attach([1],['price'=>150]);
		// // $product->sizes()->detach(2);
		// // $dd=$product->sizes;
		// // $up=$product->sizes()->sync(3);s
		// // $dd=$product->middle();
		// $up=$product->sizes()->updateExistingPivot(3,['price'=>1200,'stock'=>10]);
		// $dd=$product->sizes;

		// foreach ($dd as $value) {
		// 	# code...

		// 	echo $value->size;
		// }
		// dd($dd);
		return view('form',['sizes'=>$sizes]);
	}
	public function savesize(Request $req){
		$addsize = new Size();
		// dd($req->all);
		$addsize->size=$req->size;
		$addsize->save();
		// $all=Size::all();
		$size='<option value="'.$addsize->id.'" > '.$addsize->size.'</option>';
		// foreach ($all as $value) {
		// 	# code...
		// 	$size.='<option value="'.$value->id.'" > --'.$value->size.'--</option>';
		// }
		return response()->json(['listsize'=>$size]);
	}
	public function getsize(){
		$sizes=Size::all();
		$getSize='<div class="col-md-3">
				              <label>size</label>
				              <select class="form-control select2" style="width: 100%;" name="size_id[]" class="validatesize" id="validateSize">
				                <option selected="selected" value="">-- chọn --</option>';
		foreach ($sizes as $value) {
			# code...
			$getSize.='<option value="'.$value->id.'" > '.$value->size.'</option>';
		}
		$getSize.='</select>
				            </div>
				            <div class="col-md-5">
				             <label>giá</label>
				             <input type="number" name="price[]" class="form-control">
				           </div>
				           <div class="col-md-2">
				             <label>số lượng</label>
				             <input type="number" name="stock[]" class="form-control">	                  
				           </div>
				           <div class="col-md-2">
				           	<label>  </label>
				           	<a onclick="xoa(event)" class="form-control addSizePriceStock btn-danger">delete</a>
				           </div>
				        </div>
				           ';
		
		return response()->json(['getsize'=>$getSize]);
	}
	public function test(Request $req){
		// dd($req->price);
		// dd($req->all());
		$product = new Product();
		$product->time_expired=date("Y-m-d",strtotime($req->date));
		$product->fill($req->all());
		$product->save();
		// dd($product);
		// $product= Product::find(1);
		$array_attribute=[];
		// $product->sizes()->attach([4],['price'=>120,'stock'=>10]);
		// $dd=$product->sizes;
		// dd($dd);
		foreach ($req->price as $key => $price) {
			# code...
			echo $price;
			array_push($array_attribute, ['size_id'=>$req->size_id[$key],'price'=>$price]);
			$product->sizes()->attach($req->size_id[$key],['price'=>$price,'stock'=>$req->stock[$key]]);
			
		}
		// dd($array_attribute);
	
				// $product= Product::find(1);
		// // $up=$product->sizes()->sync(3);
		// $add=$product->sizes()->attach([1],['price'=>120,'stock'=>10]);
		// $dd=$product->sizes;
		// dd($dd);
		$newArrayImage =[];
		if ($req->has('image'))
		{   
 
			foreach ($req->file('image') as $key => $file)
			{
				// lấy đuôi file .jpg
				$ext = $file->extension();
				
            	// lay ten anh go
            	$filename = $file->getClientOriginalName();
            	// đôi tên file
            	$filename = str::slug(str_replace("." . $ext, "", $filename)) . "-" . str::random(20) . "." . $ext;
            	// dd($filename);
            	//lưu file vào thư mục
            	$saveImage=$file->move("img/images",$filename);
            	$image="img/images/".$filename;
            	array_push($newArrayImage,['image'=>$image,'product_id'=>$product->id]);
            	// dd($newArrayImage);
   
			}
			
			Image::insert($newArrayImage);
			// dd($newArrayImage,$array_attribute);
		}
		
	}
}
