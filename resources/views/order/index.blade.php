@extends('layout')
@section('content')
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Processed Date</th>
                <th>File</th>
                <th>Validate</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $v)
                <tr>
                    <td>{{ $v->processed_date }}</td>
                    <td><a href="/{{ $v->file_url }}">download</a></td>
                    <td><a href="{{ $v->csvlint_url }}" target="_blank">validate</a></td>
                    <td>{{ $v->statusName }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
