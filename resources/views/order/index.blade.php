<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Export List</title>
</head>
<body>
    <table>
        <thead>
            <tr>
                <th>Processed Date</th>
                <th>File</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $v)
                <tr>
                    <td>{{ $v->processed_date }}</td>
                    <td><a href="/{{ $v->file_url }}">download</a></td>
                    <td><a href="/validate/{{ $v->id }}" target="_blank">validate</a></td>
                    <td>{{ $v->statusName }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
