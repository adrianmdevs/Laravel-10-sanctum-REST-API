<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Payments Record</title>
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
    <caption>Payments Report</caption>
    <br>
    <caption class="cap">Course Unit : {{$course}} </caption>
    <br>
    <caption class="cap1">From: {{$start ?? ''}} to {{$end ?? ''}} </caption>
    <thead>
    <tr>
        <th>S/No.</th>
        <th>Date</th>
        <th>Mpesa Ref No.</th>
        <th>Amount</th>
        <th>Learner Name</th>
        <th>Course Unit</th>
    </tr>
    </thead>
    <tbody>
    @forelse($payments as $i=>$payment)
        <tr>
            <td>{{$i+1}}</td>
            <td>{{date('d-m-Y',strtotime($payment->created_at)) ?? ''}}</td>
            <td>{{$payment->mpesa_ref_no ?? ''}}</td>
            <td>Kshs. @convert($payment->amount)</td>
            <td>{{$payment->member->fname ?? ''}}</td>
            <td>{{$payment->unit->name ?? ''}}</td>
        </tr>
    @empty
        {{""}}
    @endforelse

    </tbody>
</table>

</body>
</html>

