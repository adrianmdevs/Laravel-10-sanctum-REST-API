<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ImageUploadRequest;

class ImageUploadController extends Controller
{   
    public function index(){
        return view('image_upload.index');
    }

    public function upload(ImageUploadRequest $request){
        $filename=time().'.'.$request->image->extension();
        $request->image->move(public_path('images'), $filename);//Saves uploaded image to the database

        return back()
        ->with('Success', 'image Uploaded successfully!')
        ->with('image',$filename);
    }
}
