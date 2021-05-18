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
                border: 1px solid #333;
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
            span.weekend, span.offday{
                padding-left: 23px;
                position: relative;
                display: inline-flex;
                align-items: center;
            }

            span.weekend{
                margin-right: 10px;
            }

            span.weekend:before, span.offday:before{
                content: "";
                width: 20px;
                height: 20px;
                border: 1px solid #fff;
                border-radius: 50%;
                left: 0;
                position: absolute;
            }

            span.weekend:before{
                background-color: #00695c;
            }
            span.offday:before{
                background-color: #1565c0;
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
        @php
            dd(request()->columns[0]['search']['value']);
        @endphp
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
                    @if ($row['Type'] == 'weekend')
                        <td colspan="6">{!! $row['Date'] !!}</td>
                    @elseif ($row['Type'] == 'offday')
                        <td>{!! $row['Date'] !!}</td>
                        <td colspan="5">{!! $row['Task'] !!}</td>
                    @else
                        @foreach($row as $key => $value)
                            @if ($key != 'Type')
                            <td>{!! $value !!}</td>
                            @endif
                        @endforeach
                    @endif
                </tr>
            @endforeach
                <tr>
                    <td colspan="6">
                        <span class="weekend">Weekend</span>
                        <span class="offday">National Off Day</span>
                    </td>
                </tr>
        </table>
    </body>
</html>
