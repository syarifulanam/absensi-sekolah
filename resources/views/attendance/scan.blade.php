@extends('layouts.app')

@section('content')
    <h4>Scan Absensi</h4>

    <input type="text" id="barcode" class="form-control mb-3" autofocus placeholder="Scan barcode...">

    <table class="table table-bordered">
        <tr>
            <th>Nama</th>
            <th>Kelas</th>
            <th>Waktu</th>
        </tr>
        @foreach ($today as $row)
            <tr>
                <td>{{ $row->student->name }}</td>
                <td>{{ $row->student->class }}</td>
                <td>{{ $row->time }}</td>
            </tr>
        @endforeach
    </table>

    <script>
        document.getElementById('barcode').addEventListener('change', function() {
            fetch('{{ route('absensi.scan') }}', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    barcode: this.value
                })
            }).then(() => location.reload());
        });
    </script>
@endsection
