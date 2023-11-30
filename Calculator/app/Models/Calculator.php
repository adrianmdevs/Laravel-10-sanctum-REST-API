<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Calculator extends Model
{
    use HasFactory;
    protected $fillable = ['operand1', 'operand2', 'operator', 'result'];

public function add()

{

return $this->operand1 + $this->operand2;

}

public function subtract()

{

return $this->operand1 - $this->operand2;

}

public function multiply()

{

return $this->operand1 * $this->operand2;

}

public function divide()

{

return $this->operand1 / $this->operand2;

}
}
