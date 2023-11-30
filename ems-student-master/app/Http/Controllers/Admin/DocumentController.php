<?php

namespace App\Http\Controllers\Admin;

use App\Book;
use App\Unit;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class DocumentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $unit = Unit::find($id);
        $documents = $unit->documents()->latest()->get();
        return view('admin.documents')->with(compact('documents','unit'));
    }

    public function store(Request $request)
    {
       // dd($request->all());
        $this->validate($request, [
            'title' => 'required',
//            'attachment' => 'required|mimes:pdf,csv,pptx,xlsx,xls,odt,docx,doc|max:15000'
            'document' => 'required|mimes:pdf|max:15000'
        ]);
        try {
            $attachment = Book::create(array_merge($request->all()));
            if ($request->hasFile('document')) {
                $file = $request->file('document');
                $fileName = time() . '.' . $file->getClientOriginalExtension();
                $request->document->move('uploads/books/', $fileName);
                $attachment->update(['document' => $fileName]);
            }
            return redirect()->back()->with('success', 'Book has been saved!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occured during submission, please try again!');
        }
        // dd($request->all());
    }

    public function destroy($id)
    {
        try {
            $book = Book::where('id',$id);
            $upload=$book->first();
            $image_path = public_path('uploads/books/' . $upload->document);
            if (File::exists($image_path)) {
                //File::delete($image_path);
                unlink($image_path);
            }
            $book->delete();
            return redirect()->back()->with('info', 'Book has been deleted!');
        } catch (\Exception $exception) {
            return redirect()->back()->with('error', 'Whoops!, Something went wrong during deletion, Please try again.');
        }
    }
}
