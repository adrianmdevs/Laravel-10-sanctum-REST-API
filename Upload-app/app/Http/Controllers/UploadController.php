<?php

namespace App\Http\Controllers;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Http\Request;
use App\Http\Requests\UploadFileRequest; //our new request class
use Illuminate\Support\Facades\Storage;

class UploadController extends Controller
{
     /**
    * This is the method that will simply list all the files uploaded by name and provide a
    * link to each one so they may be downloaded
    *
    * @param $request : A standard form request object
    * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
    * @throws BindingResolutionException
    */
   public function list(Request $request)
   {
       $uploads = Storage::allFiles('uploads');

       return view('list', ['files' => $uploads]);
   }

   /**
    * @param $file
    * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
    * @throws BindingResolutionException
    */
   public function download($file)
   {
       return response()->download(storage_path('app/'.$file));
   }

   /**
    * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
    * @throws BindingResolutionException
    */
   public function upload()
   {
       return view('upload');
   }

   /**
    * This method will handle the file uploads. Notice that the parameter's typehint
    * is the exact request class we generated in the last step. There is a reason for this!
    *
    * @param $request : The special form request for our upload application
    * @return array|\Illuminate\Http\UploadedFile|\Illuminate\Http\UploadedFile[]|null
    * @throws BindingResolutionException
    */
   public function store(UploadFileRequest $request)
   {
       //At this point, the parameters passed into the $request (from form) are
       //valid--they satisfy each of the conditions inside the rules() method

       $filename = $request->fileName;    //parameters have already been validated
       $file = $request->file('userFile'); //that we don't need any additional isset()

       $extension = $file->getClientOriginalExtension(); //grab the file extension
       $saveAs = $filename . "." . $extension; //filename to save file under

       $file->storeAs('uploads', $saveAs, 'local'); //save the file to local folder

       return response()->json(['success' => true]); //return a success message
   }
}
