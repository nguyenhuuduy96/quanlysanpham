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
		return view('test');
	}
	public function savesize(Request $req){
		$addsize = new Size();
		// dd($req->all);
		$addsize->size=$req->size;
		$addsize->save();
		$all=Size::all();
		$size='<option value="" > --vui long chọn size--</option>';
		foreach ($all as $value) {
			# code...
			$size.='<option value="'.$value->id.'" > --'.$value->size.'--</option>';
		}
		return response()->json(['listsize'=>$size]);
	}
	public function getsize(){
		$sizes=Size::all();
		$getSize='<select name="size_id[]" id="showidsize"><option value="" > --vui long chọn size--</option>';
		foreach ($sizes as $value) {
			# code...
			$getSize.='<option value="'.$value->id.'" > --'.$value->size.'--</option>';
		}
		$getSize.='</select><input type="text" name="price[]"><br><a onclick="xoa(event)" href="javascript:void(0)">Xóa</a><br>';
		return response()->json(['getsize'=>$getSize]);
	}
	public function test(Request $req){
		// dd($req->price);

		$array_attribute=[];
		foreach ($req->price as $key => $value) {
			# code...
			echo $value;
			array_push($array_attribute, ['size_id'=>$req->size_id[$key],'price'=>$value]);
		}
		dd($array_attribute);
	
				// $product= Product::find(1);
		// // $up=$product->sizes()->sync(3);
		// $add=$product->sizes()->attach([1],['price'=>120,'stock'=>10]);
		// $dd=$product->sizes;
		// dd($dd);
		// $newArrayImage =[];
		// if ($req->has('image'))
		// {   
  //       //Handle File Upload


		// 	foreach ($req->file('image') as $key => $file)
		// 	{
		// 		// lấy đuôi file .jpg
		// 		$ext = $file->extension();
				
  //           	// lay ten anh go
  //           	$filename = $file->getClientOriginalName();
  //           	// đôi tên file
  //           	$filename = str::slug(str_replace("." . $ext, "", $filename)) . "-" . str::random(20) . "." . $ext;
  //           	// dd($filename);
  //           	//lưu file vào thư mục
  //           	$saveImage=$file->move("img/images",$filename);
  //           	$image="img/images/".$filename;
  //           	array_push($newArrayImage,['image'=>$image,'product_id'=>1]);
  //           	// dd($newArrayImage);
   
		// 	}
		// 	Image::insert($newArrayImage);
		// }
		
	}
}
