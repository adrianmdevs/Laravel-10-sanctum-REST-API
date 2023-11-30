<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Models\Calculator; 


class Calculatorcontroller extends Controller
{
    public function ShowForm(){
        return view ('Calculator.Calculator');

    }
    public function Calculate(request $request){
        // Validate form input

        $validatedData = $request->validate([

            'operand1' => 'required|numeric',
    
            'operand2' => 'required|numeric',
    
            'operator' => 'required|in:add,subtract,multiply,divide', // Add other operators here
    
    ]);
    
    // Create a new Calculator instance
    
    $calculator = new Calculator($validatedData);
    
    // Perform calculation based on the selected operator
    
    $result = $calculator->{$validatedData['operator']}();
    
    // Return the result view with the calculated result
    
    return view('Calculator.result', ['result' => $result]);
    }
}
