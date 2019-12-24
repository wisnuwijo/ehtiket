<!DOCTYPE html>
<html lang="en">
<head>
    <title>Tiket</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
</head>
<style>
    html {
        width: 100%;
        height: 100%;
        padding: 0;
        margin: 0;
    }

    * {
        padding: 0 0 0 0;
    }

    body {
        background-image: url('{{ url("public/ticket/template/ticket_design.png") }}');
    }

    .name {
        font-family: Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif;
        font-size: 50pt;
    }
</style>
<body>
    <table border="0px" width='100%' height="280pt">
        <tr>
            <td width="34%">
                <img src="{{ $data->qr_path }}" height="500pt" style="padding:50pt 0 0 27pt;">
            </td>
            <td>
                <h3>
                    <span class="name">{{ $data->name }}</span>
                </h3>
                <h5>{{ $data->email }}</h5>
                <h5>{{ $data->event_name }}</h5>
                <h5>{{ $data->ticket_type_name }}</h5>
                <h5>{{ $data->event_start }}</h5>
            </td>
        </tr>
    </table>
</body>
</html>
