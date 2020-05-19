<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Image;
use App\Models\Size;
use App\Models\Middle;
use Str;
use App\Http\Requests\ProductRequest;
class HomeCotroller extends Controller
{
	public function index(){
		$sizes=Size::all();
		$products=Product::paginate(10);		
		return view('list',['sizes'=>$sizes,'products'=>$products]);
	}
	public function getAddNew(){
		$sizes=Size::all();	
		return view('form',['sizes'=>$sizes]);
	}
	public function GetFormUpdate($id){
		$product=Product::find($id);
		$sizes = Size::all();
		return view('FormUpdate',['product'=>$product,'sizes'=>$sizes]);
	}
	public function savesize(Request $req){
		$addsize = new Size();
		$addsize->size=$req->size;
		$addsize->save();
		return response()->json(['addsize'=>$addsize]);
	}
	public function getsize(){
		$sizes=Size::all();
		return response()->json(['getsize'=>$sizes]);
	}
	public function test(Request $req){
		// dd($req->all());		
		$product = new Product();
		$product->time_expired=date("Y-m-d",strtotime($req->date));
		$product->fill($req->all());
		$product->save();
		foreach ($req->size_id as $key => $size_id) {
		
			$product->sizes()->attach($size_id,['price'=>$req->price[$key],'stock'=>$req->stock[$key]]);
			
		}
	
		if ($req->has('image'))
		{   
 
			foreach ($req->file('image') as $key => $file)
			{
				// lấy đuôi file .jpg
				$img = new Image();
				$ext = $file->extension();
				
            	// lay ten anh go
            	$filename = $file->getClientOriginalName();
            	// đôi tên file
            	$filename = str::slug(str_replace("." . $ext, "", $filename)) . "-" . str::random(20) . "." . $ext;
            	// dd($filename);
            	//lưu file vào thư mục
            	$saveImage=$file->move("img/images",$filename);
            	$image="img/images/".$filename;
            	$img->image=$image;
            	$img->product_id=$product->id;
            	$img->sort=$req->sort[$key];
            	$img->save();
            	// array_push($newArrayImage,['image'=>$image,'product_id'=>$product->id]);
            	// dd($newArrayImage);
   
			}
			
			// Image::insert($newArrayImage);
				return redirect('/');
			echo "success";
			// dd($newArrayImage,$array_attribute);
		}
		
	}
	public function saveupdate(Request $req){
	
		$product= Product::find($req->id);
		$product->time_expired=date('Y-m-d',strtotime($req->date));
		$product->save();
		foreach ($req->size_id as $key => $size) {
			# code...
			if (isset($req->middle_id[$key])) {
				# code...
				$product->sizes()->updateExistingPivot($size,['price'=>$req->price[$key],'stock'=>$req->stock[$key]]);
			} else {
				$product->sizes()->attach($size,['price'=>$req->price[$key],'stock'=>$req->stock[$key]]);
			}
			
		}
		$i=-1;
		foreach ($req->sort as $key => $value) {
			# code...
			if (isset($req->image_id[$key])) {
				# code...
				$image= Image::find($req->image_id[$key]);
				$image->sort=$req->sort[$key];
				$image->save();

			} else {
				# code...
				$i++;
				array_push($arr, $req->image[$i]);
				$img = new Image();
				echo $product->id;
				echo $req->sort[$key];
				$ext =$req->image[$i]->extension();
				$filename = $req->image[$i]->getClientOriginalName();
				// dd($req->image[$i]);
				$filename= str::slug(str_replace(".".$ext, "", $filename)."-".str::random(20).".".$ext);
				$saveImage =$req->image[$i]->move("img/images",$filename);
				$image="img/images/".$filename;
				$img->product_id=$req->id;
				$img->sort=$req->sort[$key];
				$img->image=$image;
				$img->save();
				
			}
			
		}
		// dd($arr);
	
		return redirect(route('home'));
	}
	public function deleteImage(Request $req){
		$image=Image::find($req->id);
		$image->delete();
	}
}
