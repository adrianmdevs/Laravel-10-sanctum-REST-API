<?php

namespace App\Http\Controllers;

use Illuminate\Http\r;
use App\Models\Books;
use PHPUnit\Util\Json;

class BookController extends Controller
{
    public function index(){
        $books= Books::all();
        return response()->Json($books);

    }
    public function store(Request $request){
        $book=new Books;
        $book->name=$request->name;
        $book->author=$request->author;
        $book->publish_date=$request->publish_date;
        $book->save();
        return response()->json([
            "message"=>"Book Added"
        ],201);
    }
    public function show($id){
        $book=Books::find($id);
        if (!empty($book)) {
            return response()->json($book);
        }
        else {
            return response()->json([
                "message"=>"Book not found"
            ], 404);
        }
    }
    public function update(Request $request $id){
        if (Books::where('id', $id)->exists()) {
            
            
        }


    }

}
