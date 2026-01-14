<!DOCTYPE html>
<html>
<head>
    <title>Kelola Antrian</title>
</head>
<body>

<h2>Kelola Antrian</h2>

@if (session('success'))
    <p style="color:green">{{ session('success') }}</p>
@endif
@if (session('error'))
    <p style="color:red">{{ session('error') }}</p>
@endif

<table border="1" cellpadding="5">
    <tr>
        <th>No</th>
        <th>Dokter</th>
        <th>Poli</th>
        <th>User</th>
        <th>Tanggal Kunjungan</th>
        <th>Nomor Antrian</th>
        <th>Keluhan</th>
        <th>Status</th>
        <th>Aksi</th>
    </tr>

    @foreach($antrians as $a)
    <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $a->dokter->name }}</td>
        <td>{{ $a->dokter->poli->name }}</td>
        <td>{{ $a->user->name }}</td>
        <td>{{ $a->tanggal_kunjungan }}</td>
        <td>{{ $a->nomor_antrian }}</td>
        <td>{{ $a->keluhan }}</td>
        <td>{{ $a->status }}</td>
        <td>
            @if($a->status=='WAITING')
            <form method="post" action="{{ route('admin.queue.updateStatus', $a->id) }}" style="display:inline">
                @csrf
                @method('PATCH')
                <input type="hidden" name="status" value="CANCELED">
                <button type="submit">Cancel</button>
            </form>
            @endif
        </td>
    </tr>
    @endforeach
</table>

<hr>
<h3>Panggil Nomor Berikutnya</h3>
@php
    $dokters = \App\Models\Dokter::with('poli')->get();
@endphp

@foreach($dokters as $dokter)
    <form method="post" action="{{ route('admin.queue.callNext', $dokter->id) }}">
        @csrf
        <strong>{{ $dokter->name }} - {{ $dokter->poli->name }} ({{ $dokter->schedule_day }})</strong>
        <button type="submit">Panggil Nomor Berikutnya</button>
    </form>
@endforeach

{{ $antrians->links() }}

</body>
</html>