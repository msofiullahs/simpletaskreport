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
                <tr>
                    @foreach($row as $key => $value)
                        @if ($key != 'Type')
                            @if ($row['Type'] == 'weekend')
                                <td style="background-color: #00695c; color: #fff;">
                            @elseif ($row['Type'] == 'offday')
                                <td style="background-color: #1565c0; color: #fff;">
                            @else
                                <td>
                            @endif
                                {!! $value !!}
                            </td>
                        @endif
                    @endforeach
                </tr>
            @endforeach
        </table>
    </body>
</html>
