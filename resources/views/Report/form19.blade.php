<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">

<html>
<head>
	<style type="text/css">
		body,div,table,thead,tbody,tfoot,tr,th,td,p { font-family:"Arial"; font-size:x-small }
		a.comment-indicator:hover + comment { background:#ffd; position:absolute; display:block; border:1px solid black; padding:0.5em;  }
		a.comment-indicator { background:red; display:inline-block; border:1px solid black; width:0.5em; height:0.5em;  }
        comment { display:none;  }
        @page {
            margin-top: -10px;
            margin-bottom: -10px;
        }

	</style>

</head>

<body>
<table cellspacing="0" border="0">
	<colgroup width="75"></colgroup>
	<colgroup span="2" width="75"></colgroup>
	<colgroup width="75"></colgroup>
	<colgroup width="75"></colgroup>
	<colgroup width="75"></colgroup>
	<colgroup width="75"></colgroup>
	<colgroup width="75"></colgroup>
	<colgroup width="75"></colgroup>
	<colgroup width="75"></colgroup>
	<colgroup width="108"></colgroup>
	<colgroup width="75"></colgroup>
	<tr>
		<td height="17" align="left" valign=middle><br></td>
		<td align="left" valign=middle><br></td>
		<td align="left" valign=middle><br></td>
		<td align="left" valign=middle><br></td>
		<td colspan=5 rowspan=4 align="left" valign=middle><font face="Decorated035 bt" size=5 color="#0000FF"><br><img src="{{ asset('img/aal_logo.jpg') }}" width=209 height=61 hspace=35 vspace=10>
		</font></td>
		<td align="left" valign=middle><br></td>
		<td align="left" valign=middle><br></td>
		<td align="left" valign=middle><br></td>
	</tr>
	<tr>
		<td height="17" align="left" valign=middle><br></td>
		<td align="left" valign=middle><br></td>
		<td align="left" valign=middle><br></td>
		<td align="left" valign=middle><br></td>
		<td align="left" valign=middle><br></td>
		<td align="left" valign=middle><br></td>
		<td align="left" valign=middle><br></td>
	</tr>
	<tr>
		<td height="24" align="left" valign=middle><font size=1><br></font></td>
		<td align="left" valign=middle><font size=1><br></font></td>
		<td align="left" valign=middle><font size=1><br></font></td>
		<td align="left" valign=middle><font size=1 color="#000080"><br></font></td>
		<td align="left" valign=middle><font size=1><br></font></td>
		<td align="left" valign=middle><font size=1><br></font></td>
		<td align="left" valign=middle><font size=1><br></font></td>
	</tr>
	<tr>
		<td height="20" align="left" valign=middle><font size=1><br></font></td>
		<td align="left" valign=middle><font size=1><br></font></td>
		<td align="left" valign=middle><font size=1><br></font></td>
		<td align="left" valign=middle><font size=1><br></font></td>
		<td align="left" valign=middle><font size=1><br></font></td>
		<td colspan=2 align="right" valign=middle><b><font size=3 color="#0000FF">FORM 19i</font></b></td>
		</tr>
	<tr>
		<td height="17" align="left" valign=middle><font size=1><br></font></td>
		<td align="left" valign=middle><font size=1><br></font></td>
		<td align="left" valign=middle><font size=1><br></font></td>
		<td align="left" valign=middle><font size=1><br></font></td>
		<td align="left" valign=middle><font size=1><br></font></td>
		<td align="left" valign=middle><font size=1><br></font></td>
		<td align="left" valign=middle><font size=1><br></font></td>
		<td align="left" valign=middle><font size=1><br></font></td>
		<td align="left" valign=middle><font size=1><br></font></td>
		<td align="left" valign=middle><font size=1><br></font></td>
		<td align="right" valign=middle><b><font size=3 color="#000080"><br></font></b></td>
		<td align="right" valign=middle><b><font size=3 color="#000080"><br></font></b></td>
	</tr>
	<tr>
		<td colspan=12 height="17" align="center" valign=middle><b><font size=5 color="#0000FF">Monthly Squadron Report</font></b></td>
		</tr>
	<tr>
		<td height="21" align="left" valign=middle><font size=1><br></font></td>
		<td align="left" valign=middle><font size=1><br></font></td>
		<td align="left" valign=middle><font size=1><br></font></td>
		<td align="left" valign=middle><font size=1><br></font></td>
		<td align="left" valign=middle><font size=1><br></font></td>
		<td align="left" valign=middle><font size=1><br></font></td>
		<td align="left" valign=middle><font size=1><br></font></td>
		<td align="left" valign=middle><font size=1><br></font></td>
		<td align="left" valign=middle><font size=1><br></font></td>
		<td align="left" valign=middle><font size=1><br></font></td>
		<td align="left" valign=middle><font size=1><br></font></td>
		<td align="left" valign=middle><font size=1><br></font></td>
	</tr>
	<tr>
		<td style="border-top: 1px solid #0000ff; border-left: 1px solid #0000ff" colspan=4 height="16" align="center" valign=middle>{{ config('app.name', 'Squadron') }}<b><br></b></td>
		<td style="border-top: 1px solid #0000ff; border-left: 1px solid #0000ff; border-right: 1px solid #0000ff" colspan=5 align="center" valign=middle>{{config('global.Wing')}}<b><br></b></td>
		<td style="border-top: 1px solid #0000ff" colspan=2 align="center" valign=middle>{{$month_name}}<b><br></b></td>
		<td style="border-top: 1px solid #0000ff; border-left: 1px solid #0000ff; border-right: 1px solid #0000ff" align="center" valign=middle>{{$lastRollMap->roll_year}}<b><br></b></td>
	</tr>
	<tr>
		<td style="border-bottom: 1px solid #0000ff; border-left: 1px solid #0000ff" colspan=4 height="16" align="center" valign=middle><font color="#0000FF">SQUADRON</font></td>
		<td style="border-bottom: 1px solid #0000ff; border-left: 1px solid #0000ff; border-right: 1px solid #0000ff" colspan=5 align="center" valign=middle><font color="#0000FF">WING</font></td>
		<td style="border-bottom: 1px solid #0000ff" colspan=2 align="center" valign=middle><font color="#0000FF">MONTH</font></td>
		<td style="border-bottom: 1px solid #0000ff; border-left: 1px solid #0000ff; border-right: 1px solid #0000ff" align="center" valign=middle><font color="#0000FF">YEAR</font></td>
	</tr>
	<tr>
		<td height="16" align="left" valign=middle><font size=1><br></font></td>
		<td align="left" valign=middle><font size=1><br></font></td>
		<td align="left" valign=middle><font size=1><br></font></td>
		<td align="left" valign=middle><font size=1><br></font></td>
		<td align="left" valign=middle><font size=1><br></font></td>
		<td align="left" valign=middle><font size=1><br></font></td>
		<td align="left" valign=middle><font size=1><br></font></td>
		<td align="left" valign=middle><font size=1><br></font></td>
		<td align="left" valign=middle><font size=1><br></font></td>
		<td align="left" valign=middle><font size=1><br></font></td>
		<td align="left" valign=middle><font size=1><br></font></td>
		<td align="left" valign=middle><font size=1><br></font></td>
	</tr>
	<tr>
		<td style="border-top: 1px solid #0000ff; border-bottom: 1px solid #0000ff; border-left: 1px solid #0000ff; border-right: 1px solid #0000ff" height="31" align="center" valign=middle><br></td>
        @for ($i = 1; $i <= $nightsInMonth; $i++)
            <td style="border-top: 1px solid #0000ff; border-left: 1px solid #0000ff; border-right: 1px solid #0000ff" align="center" valign=middle><font color="#0000FF">Week {{$i}}</font></td>

            @if($nightsInMonth != 5)
                <td style="border-top: 1px solid #0000ff; border-left: 1px solid #0000ff; border-right: 1px solid #0000ff" align="center" valign=middle><font color="#0000FF">Week 5</font></td>
            @endif

        @endfor



		<td style="border-top: 1px solid #0000ff; border-bottom: 1px solid #0000ff; border-left: 1px solid #0000ff; border-right: 1px solid #0000ff" align="center" valign=middle><font color="#0000FF">TOTAL</font></td>
		<td align="center" valign=middle><br></td>
		<td style="border-top: 1px solid #0000ff; border-bottom: 1px solid #0000ff; border-left: 1px solid #0000ff; border-right: 1px solid #0000ff" align="center" valign=middle><font color="#0000FF">Number <br>On Roll</font></td>
		<td align="center" valign=middle><br></td>
		<td style="border-top: 1px solid #0000ff; border-bottom: 1px solid #0000ff; border-left: 1px solid #0000ff; border-right: 1px solid #0000ff" colspan=2 align="center" valign=middle><font color="#0000FF">INCREASES</font></td>
		</tr>
	<tr>
         @php
            $total =  0;
         @endphp
        <td style="border-top: 1px solid #0000ff; border-bottom: 1px solid #0000ff; border-left: 1px solid #0000ff" height="16" align="left" valign=middle><font color="#0000FF">Officers</font></td>

        @for ($i = 1; $i <= $nightsInMonth; $i++)
            @php
                $count = 0;
                $week = $monthlyRoll->where('roll_week', $i)->first();
                if($week != null)
                {
                    $count = $week->officercount();
                }
                $total += $count;
            @endphp

             <td style="border-top: 1px solid #0000ff; border-bottom: 1px solid #0000ff; border-left: 1px solid #0000ff; border-right: 1px solid #0000ff" align="center" valign=middle>{{$count}}<b><br></b></td>

            @if($nightsInMonth != 5)
                <td style="border-top: 1px solid #0000ff; border-bottom: 1px solid #0000ff; border-left: 1px solid #0000ff; border-right: 1px solid #0000ff" align="center" valign=middle>-<b><br></b></td>
            @endif

        @endfor
		<td style="border-top: 1px solid #0000ff; border-bottom: 1px solid #0000ff; border-left: 1px solid #0000ff; border-right: 1px solid #0000ff" align="center" valign=middle>{{$total}}<b><br></b></td>
		<td align="center" valign=middle><br></td>
		<td style="border-top: 1px solid #0000ff; border-bottom: 1px solid #0000ff; border-left: 1px solid #0000ff; border-right: 1px solid #0000ff" align="center" valign=middle>{{$totalofficer}}<br></td>
		<td align="center" valign=middle><br></td>
		<td style="border-top: 1px solid #0000ff; border-bottom: 1px solid #0000ff; border-left: 1px solid #0000ff; border-right: 1px solid #0000ff" align="left" valign=middle><font color="#0000FF">Officers</font><br></td>
		<td style="border-top: 1px solid #0000ff; border-bottom: 1px solid #0000ff; border-left: 1px solid #0000ff; border-right: 1px solid #0000ff" align="center" valign=middle>{{$newmembers->where('rank', '<=', 11)->count()}}<br></td>
	</tr>
	<tr>
        @php
            $total = 0;
        @endphp

        <td style="border-top: 1px solid #0000ff; border-bottom: 1px solid #0000ff; border-left: 1px solid #0000ff" height="16" align="left" valign=middle><font color="#0000FF">W.O.'s</font></td>

        @for ($i = 1; $i <= $nightsInMonth; $i++)
        @php
            $count = 0;
            $week = $monthlyRoll->where('roll_week', $i)->first();
            if($week != null)
            {
                $count = $week->tocount();
            }
            $total += $count;
        @endphp

        <td style="border-top: 1px solid #0000ff; border-bottom: 1px solid #0000ff; border-left: 1px solid #0000ff; border-right: 1px solid #0000ff" align="center" valign=middle>{{$count}}<b><br></b></td>

        @if($nightsInMonth != 5)
            <td style="border-top: 1px solid #0000ff; border-bottom: 1px solid #0000ff; border-left: 1px solid #0000ff; border-right: 1px solid #0000ff" align="center" valign=middle>-<b><br></b></td>
        @endif

        @endfor


		<td style="border-top: 1px solid #0000ff; border-bottom: 1px solid #0000ff; border-left: 1px solid #0000ff; border-right: 1px solid #0000ff" align="center" valign=middle>{{$total}}<b><br></b></td>
		<td align="center" valign=middle><br></td>
		<td style="border-top: 1px solid #0000ff; border-bottom: 1px solid #0000ff; border-left: 1px solid #0000ff; border-right: 1px solid #0000ff" align="center" valign=middle>{{$totalto}}<br></td>
		<td align="center" valign=middle><br></td>
		<td style="border-top: 1px solid #0000ff; border-bottom: 1px solid #0000ff; border-left: 1px solid #0000ff; border-right: 1px solid #0000ff" align="left" valign=middle><font color="#0000FF">Senior Cadets</font></td>
		<td style="border-top: 1px solid #0000ff; border-bottom: 1px solid #0000ff; border-left: 1px solid #0000ff; border-right: 1px solid #0000ff" align="center" valign=middle>{{$newmembers->where('rank', 19)->count()}}<br></td>
	</tr>
	<tr>
		@php
            $total = 0;
        @endphp

        <td style="border-top: 1px solid #0000ff; border-bottom: 1px solid #0000ff; border-left: 1px solid #0000ff" height="14" align="left" valign=middle><font color="#0000FF">N.C.O's</font></td>

        @for ($i = 1; $i <= $nightsInMonth; $i++)
        @php
            $count = 0;
            $week = $monthlyRoll->where('roll_week', $i)->first();
            if($week != null)
            {
                $count = $week->ncocount();
            }
            $total += $count;
        @endphp

        <td style="border-top: 1px solid #0000ff; border-bottom: 1px solid #0000ff; border-left: 1px solid #0000ff; border-right: 1px solid #0000ff" align="center" valign=middle>{{$count}}<b><br></b></td>

         @if($nightsInMonth != 5)
            <td style="border-top: 1px solid #0000ff; border-bottom: 1px solid #0000ff; border-left: 1px solid #0000ff; border-right: 1px solid #0000ff" align="center" valign=middle>-<b><br></b></td>
        @endif

        @endfor

		<td style="border-top: 1px solid #0000ff; border-bottom: 1px solid #0000ff; border-left: 1px solid #0000ff; border-right: 1px solid #0000ff" align="center" valign=middle>{{$total}}<br></td>

		<td align="center" valign=middle><br></td>
		<td style="border-top: 1px solid #0000ff; border-bottom: 1px solid #0000ff; border-left: 1px solid #0000ff; border-right: 1px solid #0000ff" align="center" valign=middle>{{$totalnco}}<br></td>
		<td align="center" valign=middle><br></td>
		<td style="border-top: 1px solid #0000ff; border-bottom: 1px solid #0000ff; border-left: 1px solid #0000ff; border-right: 1px solid #0000ff" align="left" valign=middle><font color="#0000FF">Cadets</font><br></td>
		<td style="border-top: 1px solid #0000ff; border-bottom: 1px solid #0000ff; border-left: 1px solid #0000ff; border-right: 1px solid #0000ff" align="center" valign=middle>{{$newmembers->where('rank', 20)->count()}}<br></td>
	</tr>
	<tr>
        @php
            $total = 0;
        @endphp

        <td style="border-top: 1px solid #0000ff; border-bottom: 1px solid #0000ff; border-left: 1px solid #0000ff" height="16" align="left" valign=middle><font color="#0000FF">Cadets</font></td>

        @for ($i = 1; $i <= $nightsInMonth; $i++)
            @php
                $count = 0;
                $week = $monthlyRoll->where('roll_week', $i)->first();
                if($week != null)
                {
                    $count = $week->cadetcount();
                }
                $total += $count;
            @endphp

            <td style="border-top: 1px solid #0000ff; border-bottom: 1px solid #0000ff; border-left: 1px solid #0000ff; border-right: 1px solid #0000ff" align="center" valign=middle>{{$count}}<b><br></b></td>

            @if($nightsInMonth != 5)
                <td style="border-top: 1px solid #0000ff; border-bottom: 1px solid #0000ff; border-left: 1px solid #0000ff; border-right: 1px solid #0000ff" align="center" valign=middle>-<b><br></b></td>
            @endif

        @endfor

        <td style="border-top: 1px solid #0000ff; border-bottom: 1px solid #0000ff; border-left: 1px solid #0000ff; border-right: 1px solid #0000ff" align="center" valign=middle>{{$total}}<br></td>

    <td align="center" valign=middle><br></td>
    <td style="border-top: 1px solid #0000ff; border-bottom: 1px solid #0000ff; border-left: 1px solid #0000ff; border-right: 1px solid #0000ff" align="center" valign=middle>{{$totalcadets}}<br></td>
    <td align="center" valign=middle><br></td>
    <td style="border-top: 1px solid #0000ff; border-bottom: 1px solid #0000ff; border-left: 1px solid #0000ff; border-right: 1px solid #0000ff" align="left" valign=middle><font color="#0000FF">Junior Cadets</font></td>
    <td style="border-top: 1px solid #0000ff; border-bottom: 1px solid #0000ff; border-left: 1px solid #0000ff; border-right: 1px solid #0000ff" align="center" valign=middle>{{$newmembers->where('rank', 21)->count()}}<br></td>
	</tr>
	<tr>
        @php
            $total = 0;
        @endphp

        <td style="border-top: 1px solid #0000ff; border-bottom: 1px solid #0000ff; border-left: 1px solid #0000ff" height="16" align="left" valign=middle><font color="#0000FF">Totals</font></td>

         @for ($i = 1; $i <= $nightsInMonth; $i++)
            @php
                $count = 0;
                $week = $monthlyRoll->where('roll_week', $i)->first();
                if($week != null)
                {
                    $count = $week->total();
                }
                $total += $count;
            @endphp

            <td style="border-top: 1px solid #0000ff; border-bottom: 1px solid #0000ff; border-left: 1px solid #0000ff; border-right: 1px solid #0000ff" align="center" valign=middle>{{$count}}<b><br></b></td>

            @if($nightsInMonth != 5)
                <td style="border-top: 1px solid #0000ff; border-bottom: 1px solid #0000ff; border-left: 1px solid #0000ff; border-right: 1px solid #0000ff" align="center" valign=middle>-<b><br></b></td>
            @endif
        @endfor
    <td style="border-top: 1px solid #0000ff; border-bottom: 1px solid #0000ff; border-left: 1px solid #0000ff; border-right: 1px solid #0000ff" align="center" valign=middle>{{$total}}<br></td>

<td align="center" valign=middle><br></td>
<td style="border-top: 1px solid #0000ff; border-bottom: 1px solid #0000ff; border-left: 1px solid #0000ff; border-right: 1px solid #0000ff" align="center" valign=middle>{{$totalmember}}<br></td>
<td align="center" valign=middle><br></td>
<td style="border-top: 1px solid #0000ff; border-bottom: 1px solid #0000ff; border-left: 1px solid #0000ff; border-right: 1px solid #0000ff" align="left" valign=middle><font color="#0000FF">Total Increase</font></td>
<td style="border-top: 1px solid #0000ff; border-bottom: 1px solid #0000ff; border-left: 1px solid #0000ff; border-right: 1px solid #0000ff" align="center" valign=middle>{{$newmembers->count()}}</td>
	</tr>
	<tr>
		<td height="16" align="left" valign=middle><br></td>
		<td align="left" valign=middle><font color="#FFFFFF">n</font></td>
		<td align="left" valign=middle><font color="#FFFFFF">n</font></td>
		<td align="left" valign=middle><font color="#FFFFFF">n</font></td>
		<td align="left" valign=middle><font color="#FFFFFF">n</font></td>
		<td align="left" valign=middle><font color="#FFFFFF">n</font></td>
		<td align="left" valign=middle><br></td>
		<td align="left" valign=bottom><font color="#000000"><br></font></td>
		<td align="left" valign=middle><br></td>
		<td align="left" valign=middle><br></td>
		<td align="left" valign=middle><br></td>
		<td align="left" valign=middle><br></td>
	</tr>
	<tr>
		<td style="border-top: 1px solid #0000ff; border-left: 1px solid #0000ff; border-right: 1px solid #0000ff" height="16" align="center" valign=middle><br></td>
		<td style="border-top: 1px solid #0000ff; border-left: 1px solid #0000ff; border-right: 1px solid #0000ff" align="center" valign=middle><br></td>
		<td style="border-top: 1px solid #0000ff; border-left: 1px solid #0000ff; border-right: 1px solid #0000ff" align="center" valign=middle><br></td>
		<td style="border-top: 1px solid #0000ff; border-left: 1px solid #0000ff; border-right: 1px solid #0000ff" align="center" valign=middle><br></td>
		<td align="left" valign=middle><br></td>
		<td style="border-top: 1px solid #0000ff; border-bottom: 1px solid #0000ff; border-left: 1px solid #0000ff" rowspan=2 align="center" valign=middle><font color="#0000FF">Average<br>Attendance</font></td>
		<td style="border-top: 1px solid #0000ff; border-bottom: 1px solid #0000ff; border-right: 1px solid #0000ff" rowspan=2 align="center" valign=middle sdval="0" sdnum="1033;0;0">{{number_format(($total/$meetingnights),2)}}</td>
		<td align="left" valign=middle><br></td>
		<td style="border-top: 1px solid #0000ff; border-left: 1px solid #0000ff; border-right: 1px solid #0000ff" align="center" valign=middle sdval="0" sdnum="1033;0;_-&quot;$&quot;* #,##0.00_-;-&quot;$&quot;* #,##0.00_-;_-&quot;$&quot;* &quot;-&quot;??_-;_-@">${{number_format(($total*$groupfee),2)}}</td>
		<td align="left" valign=middle><br></td>
		<td style="border-top: 1px solid #0000ff; border-left: 1px solid #0000ff; border-right: 1px solid #0000ff" colspan=2 align="center" valign=middle><br></td>
		</tr>
	<tr>
		<td style="border-bottom: 1px solid #0000ff; border-left: 1px solid #0000ff; border-right: 1px solid #0000ff" height="16" align="center" valign=middle><font color="#0000FF">Corp</font></td>
		<td style="border-bottom: 1px solid #0000ff; border-left: 1px solid #0000ff; border-right: 1px solid #0000ff" align="center" valign=middle><font color="#0000FF">Lay</font></td>
		<td style="border-bottom: 1px solid #0000ff; border-left: 1px solid #0000ff; border-right: 1px solid #0000ff" align="center" valign=middle><font color="#0000FF">Life</font></td>
		<td style="border-bottom: 1px solid #0000ff; border-left: 1px solid #0000ff; border-right: 1px solid #0000ff" align="center" valign=middle><font color="#0000FF">On Leave</font></td>
		<td align="left" valign=middle><br></td>
		<td align="left" valign=middle><br></td>
		<td style="border-bottom: 1px solid #0000ff; border-left: 1px solid #0000ff; border-right: 1px solid #0000ff" align="center" valign=middle><font color="#0000FF">Levies</font></td>
		<td align="left" valign=middle><br></td>
		<td style="border-bottom: 1px solid #0000ff; border-left: 1px solid #0000ff; border-right: 1px solid #0000ff" colspan=2 align="center" valign=middle><font color="#0000FF">G.H.Q. Use Only</font></td>
		</tr>
	<tr>
		<td height="16" align="left" valign=middle><br></td>
		<td align="left" valign=middle><br></td>
		<td align="left" valign=middle><br></td>
		<td align="left" valign=middle><br></td>
		<td align="left" valign=middle><br></td>
		<td align="center" valign=middle><br></td>
		<td align="left" valign=middle><br></td>
		<td align="left" valign=middle><br></td>
		<td align="left" valign=middle><br></td>
		<td align="left" valign=middle><br></td>
		<td align="left" valign=middle><br></td>
		<td align="left" valign=middle><br></td>
	</tr>
	<tr>
		<td style="border-top: 1px solid #0000ff; border-bottom: 1px solid #0000ff; border-left: 1px solid #0000ff; border-right: 1px solid #0000ff" colspan=12 height="16" align="center" valign=middle><font color="#0000FF">MEMBERS CROSSED OFF ROLL (Including Transfers)</font></td>
		</tr>
	<tr>
		<td style="border-top: 1px solid #0000ff; border-bottom: 1px solid #0000ff; border-left: 1px solid #0000ff; border-right: 1px solid #0000ff" height="34" align="center" valign=middle><font color="#0000FF">Certificate<br>Number</font></td>
		<td style="border-top: 1px solid #0000ff; border-bottom: 1px solid #0000ff; border-left: 1px solid #0000ff; border-right: 1px solid #0000ff" colspan=3 align="center" valign=middle><font color="#0000FF">SURNAME</font></td>
		<td style="border-top: 1px solid #0000ff; border-bottom: 1px solid #0000ff; border-left: 1px solid #0000ff; border-right: 1px solid #0000ff" align="center" valign=middle><font color="#0000FF">INIT</font></td>
		<td style="border-top: 1px solid #0000ff; border-bottom: 1px solid #0000ff; border-left: 1px solid #0000ff; border-right: 1px solid #0000ff" align="center" valign=middle><font color="#0000FF">RANK</font></td>
		<td style="border-top: 1px solid #0000ff; border-bottom: 1px solid #0000ff; border-left: 1px solid #0000ff; border-right: 1px solid #0000ff" colspan=6 align="center" valign=middle><font color="#0000FF">REASON</font></td>
		</tr>
	<tr>
		<td style="border-top: 1px solid #0000ff; border-bottom: 1px solid #0000ff; border-left: 1px solid #0000ff; border-right: 1px solid #0000ff" height="16" align="center" valign=middle><br></td>
		<td style="border-top: 1px solid #0000ff; border-bottom: 1px solid #0000ff; border-left: 1px solid #0000ff; border-right: 1px solid #0000ff" colspan=3 align="left" valign=middle><br></td>
		<td style="border-top: 1px solid #0000ff; border-bottom: 1px solid #0000ff; border-left: 1px solid #0000ff; border-right: 1px solid #0000ff" align="left" valign=middle><br></td>
		<td style="border-top: 1px solid #0000ff; border-bottom: 1px solid #0000ff; border-left: 1px solid #0000ff; border-right: 1px solid #0000ff" align="center" valign=middle><br></td>
		<td style="border-top: 1px solid #0000ff; border-bottom: 1px solid #0000ff; border-left: 1px solid #0000ff; border-right: 1px solid #0000ff" colspan=6 align="left" valign=middle><br></td>
		</tr>
	<tr>
		<td style="border-top: 1px solid #0000ff; border-bottom: 1px solid #0000ff; border-left: 1px solid #0000ff; border-right: 1px solid #0000ff" height="16" align="center" valign=middle><br></td>
		<td style="border-top: 1px solid #0000ff; border-bottom: 1px solid #0000ff; border-left: 1px solid #0000ff; border-right: 1px solid #0000ff" colspan=3 align="left" valign=middle><br></td>
		<td style="border-top: 1px solid #0000ff; border-bottom: 1px solid #0000ff; border-left: 1px solid #0000ff; border-right: 1px solid #0000ff" align="left" valign=middle><br></td>
		<td style="border-top: 1px solid #0000ff; border-bottom: 1px solid #0000ff; border-left: 1px solid #0000ff; border-right: 1px solid #0000ff" align="center" valign=middle><br></td>
		<td style="border-top: 1px solid #0000ff; border-bottom: 1px solid #0000ff; border-left: 1px solid #0000ff; border-right: 1px solid #0000ff" colspan=6 align="left" valign=middle><br></td>
		</tr>
	<tr>
		<td style="border-top: 1px solid #0000ff; border-bottom: 1px solid #0000ff; border-left: 1px solid #0000ff; border-right: 1px solid #0000ff" height="16" align="center" valign=middle><br></td>
		<td style="border-top: 1px solid #0000ff; border-bottom: 1px solid #0000ff; border-left: 1px solid #0000ff; border-right: 1px solid #0000ff" colspan=3 align="left" valign=middle><br></td>
		<td style="border-top: 1px solid #0000ff; border-bottom: 1px solid #0000ff; border-left: 1px solid #0000ff; border-right: 1px solid #0000ff" align="left" valign=middle><br></td>
		<td style="border-top: 1px solid #0000ff; border-bottom: 1px solid #0000ff; border-left: 1px solid #0000ff; border-right: 1px solid #0000ff" align="center" valign=middle><br></td>
		<td style="border-top: 1px solid #0000ff; border-bottom: 1px solid #0000ff; border-left: 1px solid #0000ff; border-right: 1px solid #0000ff" colspan=6 align="left" valign=middle><br></td>
		</tr>
	<tr>
		<td style="border-top: 1px solid #0000ff; border-bottom: 1px solid #0000ff; border-left: 1px solid #0000ff; border-right: 1px solid #0000ff" height="16" align="center" valign=middle><br></td>
		<td style="border-top: 1px solid #0000ff; border-bottom: 1px solid #0000ff; border-left: 1px solid #0000ff; border-right: 1px solid #0000ff" colspan=3 align="left" valign=middle><br></td>
		<td style="border-top: 1px solid #0000ff; border-bottom: 1px solid #0000ff; border-left: 1px solid #0000ff; border-right: 1px solid #0000ff" align="left" valign=middle><br></td>
		<td style="border-top: 1px solid #0000ff; border-bottom: 1px solid #0000ff; border-left: 1px solid #0000ff; border-right: 1px solid #0000ff" align="center" valign=middle><br></td>
		<td style="border-top: 1px solid #0000ff; border-bottom: 1px solid #0000ff; border-left: 1px solid #0000ff; border-right: 1px solid #0000ff" colspan=6 align="left" valign=middle><br></td>
		</tr>
	<tr>
		<td height="16" align="left" valign=middle><br></td>
		<td align="left" valign=middle><br></td>
		<td align="left" valign=middle><br></td>
		<td align="left" valign=middle><br></td>
		<td align="left" valign=middle><br></td>
		<td align="left" valign=middle><br></td>
		<td align="left" valign=middle><br></td>
		<td align="left" valign=middle><br></td>
		<td align="left" valign=middle><br></td>
		<td align="left" valign=middle><br></td>
		<td align="left" valign=middle><br></td>
		<td align="left" valign=middle><br></td>
    </tr>
</table>
<table Style="width:80%">


	<tr>
		<td colspan=2 height="16" align="left" valign=middle><font color="#0000FF">General Report:</font></td>
		<td colspan=20 rowspan=10 align="left" valign=middle>{!! nl2br(e($generalreport)) !!}<br></td>
		</tr>
	<tr>
		<td height="16" align="left" valign=middle><br></td>
		<td align="left" valign=middle><br></td>
		</tr>
	<tr>
		<td height="16" align="left" valign=middle><br></td>
		<td align="left" valign=middle><br></td>
		</tr>
	<tr>
		<td height="16" align="left" valign=middle><br></td>
		<td align="left" valign=middle><br></td>
		</tr>
	<tr>
		<td height="16" align="left" valign=middle><br></td>
		<td align="left" valign=middle><br></td>
		</tr>
	<tr>
		<td height="16" align="left" valign=middle><br></td>
		<td align="left" valign=middle><br></td>
		</tr>
	<tr>
		<td height="16" align="left" valign=middle><br></td>
		<td align="left" valign=middle><br></td>
		</tr>
	<tr>
		<td height="16" align="left" valign=middle><br></td>
		<td align="left" valign=middle><br></td>
		</tr>
	<tr>
		<td height="17" align="left" valign=middle><br></td>
		<td align="left" valign=middle><br></td>
		</tr>
	<tr>
		<td height="17" align="left" valign=middle><br></td>
		<td align="left" valign=middle><br></td>
		</tr>


	<tr>
		<td height="16" align="left" valign=middle><br></td>
		<td align="left" valign=middle><br></td>
		<td align="left" valign=middle><br></td>
		<td align="left" valign=middle><br></td>
		<td align="center" valign=middle><br><?php echo date('j/m/Y'); ?></td>
		<td align="left" valign=middle><br></td>
		<td align="left" valign=middle><br></td>
		<td align="left" valign=middle><br></td>
		<td align="left" valign=middle><br></td>
		<td align="left" valign=middle><br></td>
		<td align="left" valign=middle><br></td>
		<td align="left" valign=middle><br></td>
	</tr>
	<tr>
		<td style="border-top: 1px solid #0000ff" colspan=3 height="16" align="center" valign=middle><font color="#0000FF">Squadron O.C.</font></td>
		<td align="center" valign=middle><font color="#0000FF"><br></font></td>
		<td style="border-top: 1px solid #0000ff" align="center" valign=middle><font color="#0000FF">Date</font></td>
		<td align="left" valign=middle><br></td>
		<td style="border-top: 1px solid #0000ff" colspan=4 align="center" valign=middle><font color="#0000FF">Wing O.C.</font></td>
		<td align="center" valign=middle><br></td>
		<td style="border-top: 1px solid #0000ff" align="center" valign=middle><font color="#0000FF">Date</font></td>
	</tr>
	<tr>
		<td height="17" align="left" valign=bottom><br></td>
		<td align="left" valign=bottom><br></td>
		<td align="left" valign=bottom><br></td>
		<td align="left" valign=bottom><br></td>
		<td align="left" valign=bottom><br></td>
		<td align="left" valign=bottom><br></td>
		<td align="left" valign=bottom><br></td>
		<td align="left" valign=bottom><br></td>
		<td align="left" valign=bottom><br></td>
		<td align="left" valign=bottom><br></td>
		<td align="left" valign=bottom><br></td>
		<td align="left" valign=bottom><font color="#000000"><br></font></td>
	</tr>
	<tr>
		<td colspan=13 height="17" align="center" valign=bottom><b><font size=1 color="#0000FF">WHITE &amp; PINK COPY TO HQ  -  YELLOW COPY RETAINED BY SQUADRON</font></b></td>
		</tr>
</table>
<!-- ************************************************************************** -->
</body>

</html>
