@extends('layouts.app')

@section('content')
<h4>Data Siswa</h4>

<table class="table table-bordered">
    <tr>
        <th>Nama</th>
        <th>Kelas</th>
        <th>QR Code</th>
    </tr>

    @foreach($students as $student)
    <tr>
        <td>{{ $student->name }}</td>
        <td>{{ $student->class }}</td>
        <td>
            {!! QrCode::size(100)->generate($student->barcode) !!}
        </td>
    </tr>
    @endforeach
</table>
@endsection
