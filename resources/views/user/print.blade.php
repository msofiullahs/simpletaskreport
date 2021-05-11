<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Print Table</title>
        <meta charset="UTF-8">
        <meta name=description content="">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Bootstrap CSS -->
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
        <style>
            body {margin: 20px}
            tr.weekend {
                background: #00695c !important;
                color: #fff !important;
                -webkit-print-color-adjust: exact;
            }
            tr.offday {
                background: #1565c0 !important;
                color: #fff !important;
                -webkit-print-color-adjust: exact;
            }
            @media print, screen {
                tr.weekend {
                    background: #00695c !important;
                    color: #fff !important;
                    -webkit-print-color-adjust: exact;
                }
                tr.offday {
                    background: #1565c0 !important;
                    color: #fff !important;
                    -webkit-print-color-adjust: exact;
                }
            }
        </style>
    </head>
    <body>
        <table class="table table-bordered table-condensed table-striped">
            @foreach($data as $row)
                @if ($loop->first)
                    <tr>
                        @foreach($row as $key => $value)
                            @if ($key != 'Type')
                            <th>{!! $key !!}</th>
                            @endif
                        @endforeach
                    </tr>
                @endif
                <tr class="{{$row['Type']}}">
                    @foreach($row as $key => $value)
                        @if ($key != 'Type')
                           <td>{!! $value !!}</td>
                        @endif
                    @endforeach
                </tr>
            @endforeach
        </table>
    </body>
</html>
