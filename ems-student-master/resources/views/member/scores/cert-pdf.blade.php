@php error_reporting(0);@endphp
    <!doctype html>
<html lang="en">
<head>
    <meta charset=utf-8"/>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <title>Certificate</title>
    @include('member.scores.certificate-css')
    <style>
        .table-wrapper {
            display: table-cell;
            vertical-align: middle;
        }

        #layout {
            margin-left: auto;
            margin-right: auto;
        }

        #layout td.td-center {
            text-align: center;
            padding: 8px;
        }


    </style>
</head>

<body>
<div class="main-wrapper">
    <div class="inner-wrapper">
        <p style="font-size:17px; float:left;font-family: 'Lato', sans-serif;font-weight: 700;margin-left: 690px; margin-bottom: -7px;">
            CERTIFICATION NO.:<em
                style="color:#ff3111;"> {{$cert->cert_no ?? ''}}</em>
        </p>
        <div class="table-wrapper">
            <table id="layout">

                <tr>
                    <td class="title td-center">INSTITUTE OF CERTIFIED HUMAN RESOURCE MANAGERS</td>
                </tr>
                <tr>
                    <td class="certify td-center"><i>HEREBY CERTIFIES THAT</i></td>
                </tr>
                <tr>
                    <td class="student_name td-center"><b>{{$member->fname ?? ''}}</b></td>
                </tr>
                <tr>
                    <td class="description td-center"><i>HAVING MET WITH DISTINCTION THE HIGH STANDARDS OF EDUCATION,
                            EXPERIENCE
                            AND<br> DEMONSTRATED KNOWLEDGE ESTABLISHED BY THIS INSTITUTE,
                            HAS BEEN CERTIFIED AS A</i></td>
                </tr>
                <tr>
                    <td class="course td-center">{{$course->description ?? ''}}</td>
                </tr>
                <tr>
                    <td class="course_code td-center">({{strtoupper($course->name) ?? ''}})</td>
                </tr>
                <tr>
                    <td class="attest td-center">WITNESS THE SIGNATURE OF THE DULY AUTHORIZED OFFICER OF THIS INSTITUTE:
                        <br> ATTEST:
                    </td>
                </tr>
                <tr>
                    <td class="td-center">________________________________</td>
                </tr>
                <tr>
                    <td style="font-size:13px; font-family: 'Lato', sans-serif;font-weight: 700;" class="td-center">
                        EXECUTIVE DIRECTOR
                    </td>
                </tr>
            </table>

        </div>
        <section>
            <div id="left">
                <p style="float: left;width:40%; margin-top: 30px;">
                    @if($course->name=="CHRM")
                        <img src="{{ asset('assets/images/CHRM.png') }}" style="width: 140px;height:140px;">
                    @else
                        <img src="{{ asset('assets/images/CHRD.png') }}" style="width: 140px;height:140px;">
                    @endif
                </p>
                <p style="float: left;width:60%; margin-left: -40px; margin-top: 50px;font-family: 'Lato', sans-serif;font-size: 1.0em; ">
                    PERIOD OF CERTIFICATION:<br>
                    <em style="font-size:0.8em;"> {{strtoupper(date('F d, Y',strtotime($cert->created_at))) }}
                        - {{strtoupper(date('F d, Y',strtotime($enrollment->created_at))) }}</em>
                </p>
            </div>
            <div id="right">
                <p style="float: left;width:40%;  margin-left: 40px;margin-top: 80px;font-family: 'Lato', sans-serif;font-size: 1.0em;">
                    CERTIFIED SINCE:<br> {{strtoupper(date('F d, Y',strtotime($cert->created_at))) }}</p>
                <p style="float: left;margin-left: -45px;width:60%;margin-top: -40px;"><img
                        src="{{asset('assets/images/logo22.PNG')}}"
                        style="width: 140px;height:140px;">
                </p>
            </div>
        </section>
    </div>
</div>

</body>

</html>
