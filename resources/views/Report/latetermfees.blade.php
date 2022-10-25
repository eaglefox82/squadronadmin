<html>
    <head>
        <style>
            @page {
                margin: 25px 25px;
            }

            footer {
                position: fixed;
                bottom: -60px;
                left: 0px;
                right: 0px;
                height: 50px;
            }

            table, th, td {
                border: 1px solid black;
            }
            .text-center {
                text-align: center;
            }
            #leftbox {
                float: left;
                width: 30%;
                height: 20px;
            }

            #middlebox {
                float: left;
                width: 30%;
                height: 20px;
            }

            #rightbox {
                float: right;
                width: 30%;
                height: 20px;
            }

        </style>
    </head>
    <body>
        <div class="text-center">
            <img src="{{ asset('img/aal_logo.jpg') }}" height="90" class="text-center">
        </div>
        @foreach ($term as $t)
            <h1 style="text-align:center">Late Term Fees for Term {{ $t->term }} - {{ $t->year }}</h1>
        @endforeach
             <p style="font-weight: bold"></p>
              Australian Air League Inc.<br>
              {{ config('app.name', 'Squadron') }} Sqaudron<br>

        <div style="page-break-after:auto;">
        <h3 style="text-align: center">Member with Late Payments</h3>
        <table style = "width:100%">
            <tr>
                <th class="text-center">First Name</th>
                <th class="text-center">Last Name</th>
                <th class="text-center">Date Paid</th>
                <th class="text-center">Weeks Late</th>
            </tr>

            @foreach ($latetermfees as $p)
                <tr>

                    <td class="text-center">{{ $p->member->first_name }}</td>
                    <td class="text-center">{{ $p->member->last_name }}</td>
                    <td class="text-center">{{ $p->paid_date }}</td>
                    <td class="text-center">{{ $p->member->overduefeesweek() }}</td>
                </tr>
            @endforeach
        </table>
        </div>
        <br>
    </body>
</html>


