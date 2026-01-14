<h2>Riwayat Antrian</h2>

@if(session('success'))
<p style="color:green">{{ session('success') }}</p>
@endif

<table border="1">
<tr>
    <th>Dokter</th>
    <th>Poli</th>
    <th>Tanggal</th>
    <th>No</th>
    <th>Status</th>
    <th>Aksi</th>
</tr>

@foreach($queues as $q)
<tr>
    <td>{{ $q->dokter->name }}</td>
    <td>{{ $q->dokter->poli->name }}</td>
    <td>{{ $q->date }}</td>
    <td>{{ $q->queue_number }}</td>
    <td>{{ $q->status }}</td>
    <td>
        @if($q->status=='WAITING')
        <form method="POST" action="{{ route('queue.cancel',$q) }}">
            @csrf
            <button>Batal</button>
        </form>
        @endif
    </td>
</tr>
@endforeach
</table>