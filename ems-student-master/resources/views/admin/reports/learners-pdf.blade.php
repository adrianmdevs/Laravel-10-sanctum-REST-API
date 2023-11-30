<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Learners List</title>
    <style>
        #layout {
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
            background-color: #01579b;
            color: #ffffff;
        }

        caption {
            font-size: 26px;
            font-weight: bold;
            color: #222222;
            padding: .2em .8em;
        }

        caption.cap {
            font-size: 16px;
            font-weight: bold;
            color: #000000;
            padding: .2em .8em;
        }

        /* Create 2 unequal columns that floats next to each other */

        .column {
            float: left;
            padding: 10px;
        }

        .left {
            height: 200px;
            width: 100%;
            margin-top: -80px;
            background: url(http://{{$hostname}}/assets/images/votehead.PNG);
        }

        /* Clear floats after the columns */
        .header:after {
            content: "";
            display: table;
            clear: both;
            margin-bottom: -120px;
        }
    </style>

</head>
<body>
<div class="header">
    <div class="column left"></div>
</div>
<h6 style="margin-bottom: 100px;">&nbsp;&nbsp;</h6>
<table id="layout">
    <caption>Learners Report</caption>
    <br>
    <caption class="cap">From: {{$start ?? ''}} to {{$end ?? ''}} </caption>
    <thead>
    <tr>
        <th>#</th>
        <th>Learner Name</th>
        <th>Email</th>
        <th>Phone</th>
        <th>ID No.</th>
        <th>IHRM No.</th>
    </tr>
    </thead>
    <tbody>
    @foreach($members as $i=>$member)
        <tr>
            <td>{{$i+1}}</td>
            <td>{{$member->fname ?? ''}}</td>
            <td>{{$member->email ?? ''}}</td>
            <td>{{$member->phone ?? ''}}</td>
            <td>{{$member->nid ?? ''}}</td>
            <td>{{$member->ihrm_no ?? ''}}</td>

        </tr>
    @endforeach

    </tbody>
</table>

</body>
</html>

