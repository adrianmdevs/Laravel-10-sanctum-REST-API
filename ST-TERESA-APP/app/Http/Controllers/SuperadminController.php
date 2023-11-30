<?php

namespace App\Http\Controllers;

use App\Models\Pupil;
use Illuminate\Http\Request;

class SuperadminController extends Controller
{
    public function __construct(){ //Authenticate the super admin
        $this->middleware('auth');
        $this->middleware('superadmin');
    }
    //View list of puoils in the school;
    public function IndexPupils(){
        $pupil=Pupil::all();
        return view('pupils.index',['pupils'=>$pupil]);
    }
    //Create pupils; Display form to create pupils
    public function CreatePupil(){
        return view('pupils.create');
    }
    //Store new Pupils in the database
    Public function StorePupil(Request $request){
        //Validate input
        $request->validate([
            'Pupil_name'=>'string'
        ]);

    }
}
