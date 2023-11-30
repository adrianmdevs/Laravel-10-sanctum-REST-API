<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Payment Receipt</title>
    <style>
        .middle {
            position: absolute;
            top: 140px;
            left: 35%;
        }

        .middle h2 {
            font-size: 26px;
            font-weight: bold;
            color: #F2F2F2;
            padding: .2em .8em;
            background-color: #716DEE;
            width: 260px;
            text-transform: uppercase;
        }

        .column {
            font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
            width: 100%;
            float: left;
            padding: 8px;
            height: 5px; /* Should be removed. Only for demonstration */
        }

        .left {
            width: 10%;
            text-align: center;
            margin-left: 15px;
        }

        /*.center {*/
        /*width: 60%;*/
        /*text-align: center;*/
        /*}*/
        .right {
            width: 90%;
            text-align: right;
        }

        /* Clear floats after the columns */
        .header:after {
            content: "";
            display: table;
            clear: both;
            margin-bottom: 130px;
        }

        #layout {
            width: 100%;
            margin-top: 50px;
            margin-left: 20px;
        }

        #layout tr {

        }

        .title {
            color: #0D13F5;
            font-weight: 700;
            margin-right: 40px;
            margin-bottom: -20px;
        }

        .info {
            color: #0D13F5;
            font-weight: 900;
            margin-right: 40px;
        }
    </style>

</head>
<body>
<div class="header">
    <div class="column left">
        <img src="{{ asset('assets/images/logo22.PNG') }}" style="width:140px;height:140px;">
    </div>
    <div class="column right">
        <h3 class="title">INSTITUTE OF CERTIFIED HUMAN RESOURCE MANAGERS</h3>
        <h4 class="info">
            17th Floor,Regus Suites,ICEA,<br>
            Kenyatta Avenue,Nairobi,Kenya<br>
            P.O Box 18582-00100, Nairobi<br>
            Tel:020 515<br>
            E-mail:info@ichrm.org Website:http://www.ichrm.org
            <br>
        </h4>
    </div>
    {{--<div class="column right">--}}
    {{--<img src="{{ asset('assets/images/logo22.PNG') }}" style="width:140px;height:140px;">--}}
    {{--</div>--}}

</div>
<hr style="color: #716DEE; border-bottom: 1px solid #716DEE;">
<div class="middle" style="margin-bottom: -80px;">
    <h2>Official Receipt </h2>
</div>
<h6>&nbsp;</h6>

<table id="layout">
    <tr>
        <td>
            <p style="padding-bottom: 2px; font-size: 1.6em; margin-bottom: -20px;"><strong>No.{{$payment->id}}</strong>
                <span
                    style="margin-left: 110px; float: right;"> Date: {{date('d-m-Y',strtotime($payment->created_at)) ?? ''}}</span>
            </p>
        </td>
    </tr>
    <tr>
        <td>
            <p style="padding-bottom: 2px; font-size: 1.6em;">Received From <strong
                    style="margin-left: 110px;">{{$payment->member->fname}}</strong>
            </p>
            <hr style="border: 0 none; border-top: 2px dashed #322f32;background: none; margin-top:-20px; margin-left:250px; width:450px;
           ">
        </td>
    </tr>
    <tr>
        <td>
            {{--@php--}}
            {{--$f = new NumberFormatter("en", NumberFormatter::SPELLOUT);--}}
            {{--@endphp--}}
            <p style="padding-bottom: 2px; font-size: 1.6em;">the sum of shillings
                {{--<strong style="margin-left: 65px;">{{ucfirst($f->format($payment->amount))}}</strong>--}}
                <strong style="margin-left: 65px;">{{ucfirst(\Terbilang::make($payment->amount))}}</strong>
            </p>
            <hr style="border: 0 none; border-top: 2px dashed #322f32;background: none; margin-top:-20px; margin-left:250px; width:450px;
           ">
        </td>
    </tr>
    <tr>
        <td>
            <p style="padding-bottom: 2px; font-size: 1.6em;">being payment of <strong
                    style="margin-left: 85px;">{{$payment->unit->name}}</strong>
            </p>
            <hr style="border: 0 none; border-top: 2px dashed #322f32;background: none; margin-top:-20px; margin-left:250px; width:450px;
           ">
        </td>
    </tr>
    <tr>
        <td>
            <p style="padding-bottom: 2px; font-size: 1.6em;"><strong>Ksh. @convert($payment->amount)</strong> <span
                    style="margin-left: 110px; float: right;"> By Admin</span>
            </p>
        </td>
    </tr>
</table>

</body>
</html>

