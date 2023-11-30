<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pizzas</title>
</head>
<body>
<h1>Types of Pizzas</h1>
<ul>
    <li>Black Pizza</li>
    <li>White Pizza</li>
    <li>Yellow Pizza</li>
    <li>Green Pizza</li>

</ul>
@foreach($pizzas as $piece)
    <div>
{{$loop->index}} -- {{$piece['type']}} -- {{$piece['base']}}
        @if($loop->first)
            <p>First in the loop </p>
        @endif
        @if($loop->last)
            <span> -Last in the loop</span>
        @endif
</div>
@endforeach

</body>
</html>
