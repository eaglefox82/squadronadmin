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
        <h1 style="text-align:center">Current Points as of: {{date("l - jS F Y",strtotime($date))}}</h1>
             <p style="font-weight: bold"></p>
              Australian Air League Inc.<br>
              {{ config('app.name', 'Squadron') }} Sqaudron<br>

        <div style="page-break-after:auto;">
        <h3 style="text-align: center">Points Ranking</h3>
        <table style = "width:100%">
            <tr>
                <th class="text-center">Rank</th>
                <th class="text-center">First Name</th>
                <th class="text-center">Last Name</th>
                <th class="text-center">Total Points</th>
            </tr>

            @foreach ($points as $p)
                <tr>
                    <td class="text-center">{{ $p->rank }}</td>
                    <td class="text-center">{{ $p->first_name }}</td>
                    <td class="text-center">{{ $p->last_name }}</td>
                    <td class="text-center">{{ $p->TotalPoints }}</td>
                </tr>
            @endforeach
        </table>
        </div>
        <br>
    </body>
</html>


