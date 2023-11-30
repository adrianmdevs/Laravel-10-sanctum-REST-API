<form action= "{{ route("calculate") }}" method="POST">


@csrf

<input type:"text" name="operand1" placeholder="Enter the first number" required> <br><br>

<select name="operator" required> <br>

<option "add">+</option>

<option "subtract">-</option>

<option "multiply">*</option>

<option "divide">/</option>

</select>

<input type:"text" name="operand2"  placeholder="Enter the second number" required><br>

<button type="submit">Calculate</button>

</form>
