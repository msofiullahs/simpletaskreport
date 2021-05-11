<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Print Table</title>
        <meta charset="UTF-8">
        <meta name=description content="">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;600;700&family=Material+Icons+Outlined&display=swap" rel="stylesheet">
        <style type="text/css">
            body {
                -webkit-print-color-adjust:exact;
                margin: 20px;
                font-size: .875rem;
                font-family: 'Nunito', sans-serif;
                font-weight: 300;
            }
            table{
                width: 100%;
                border-collapse: collapse;
                border: 1px solid #333;
            }

            table tr th, table tr td{
                padding: 3px;
            }
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
        </style>
        <style type="text/css" media="print">
            @media print {
                body {
                    background: transparent;
                    -webkit-print-color-adjust:exact;
                }
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
