<h2>Daftar Antrian</h2>

<form method="POST" action="{{ route('queue.store') }}">
@csrf

<select name="dokter_id" required>
    <option value="">-- Pilih Dokter --</option>
    @foreach($dokters as $dokter)
        <option value="{{ $dokter->id }}">
            {{ $dokter->name }} ({{ $dokter->poli->name }})
        </option>
    @endforeach
</select>
<br><br>

<input type="date" name="date" required>
<br><br>

<textarea name="complaint" placeholder="Keluhan (min 10 karakter)" required></textarea>
<br><br>

<button type="submit">Daftar</button>

</form>

@if($errors->any())
    <ul style="color:red">
        @foreach($errors->all() as $err)
            <li>{{ $err }}</li>
        @endforeach
    </ul>
@endif