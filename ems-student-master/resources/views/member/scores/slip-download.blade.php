@php error_reporting(0);@endphp
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Result Slip</title>
    <style>
        .title {
            text-align: center;
            border-bottom: 2px solid #2f3239;
        }

        .description {
            font-family: 'Lato', sans-serif;
            font-size: 23px;
            font-weight: bold;
            color: #2D3595;
        }

        .course_code {
            font-family: 'Lobster', sans-serif;
            font-weight: 400;
            font-size: 30px;
            letter-spacing: 0.0625em;
        }

        .course {
            font-family: 'Vibes', sans-serif;
            font-size: 30px;
            font-weight: 400;
            letter-spacing: 0.0625em;
        }

        section {
            margin-top: -40px;
        }

        #left {
            box-sizing: border-box;
            -moz-box-sizing: border-box;
            -webkit-box-sizing: border-box;
            display: inline-block;
            float: left;
            padding: 2px;
            width: 30%;

        }

        #right {
            box-sizing: border-box;
            -moz-box-sizing: border-box;
            -webkit-box-sizing: border-box;
            display: inline-block;
            float: left;
            padding: 2px;
            width: 70%;
            margin-left: -10px;
        }

        #layout {
            font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
            caption-side: top;
        }

        #layout td, #layout th {
            border: 1px solid #ddd;
            padding: 8px;
        }

        #layout tr:hover {
            background-color: #ddd;
        }

        #layout th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            background-color: #eceff1;
            color: #222222;
        }

        caption {
            font-size: 22px;
            font-weight: bold;
            color: #222222;
            padding: .2em .8em;
        }


    </style>

</head>
<body>
<section>
    <div id="left">
        <p style="float: left;">
            @if($course->name=="CHRM")
                <img src="{{ asset('assets/images/CHRM.png') }}" style="width: 140px;height:140px;">
            @else
                <img src="{{ asset('assets/images/CHRD.png') }}" style="width: 140px;height:140px;">
            @endif
        </p>

    </div>
    <div id="right">
        <p class="title"><strong class="description">{{strtoupper($course->description) ?? ''}}</strong>
            <br/>
            <em class="course_code">({{strtoupper($course->name) ?? ''}})</em>
            <br/>
            <em class="course">{{$member->fname ?? ''}}</em>
        </p>

    </div>
</section>
<h6>&nbsp;</h6>

<table id="layout">
    <caption>Result Slip</caption>
    <thead>
    <tr>
        <th>#</th>
        <th>Course Unit</th>
        <th>Score in %</th>
    </tr>
    </thead>
    <tbody>
    @foreach(json_decode(json_encode($units)) as $i=>$unit)
        <tr>
            <td>{{$i+1}}</td>
            <td>{{$unit->unit ?? ''}}</td>
            <td>{{$unit->score ?? ''}}</td>
        </tr>
    @endforeach
    </tbody>
</table>

</body>
</html>

