@if(session('success'))
    <div style="color: green; background: #eaffea; padding: 10px; border-radius: 5px;">
        {{ session('success') }}
    </div>
@endif

<h1>Daftar Ticket</h1>

<form method="GET" action="/tickets">
    <select name="status">
        <option value="">Semua Status</option>
        <option value="open">Open</option>
        <option value="on progress">On Progress</option>
        <option value="resolved">Resolved</option>
        <option value="closed">Closed</option>
    </select>

    <select name="category">
        <option value="">Semua Kategori</option>
        <option value="hardware">Hardware</option>
        <option value="software">Software</option>
        <option value="network">Network</option>
    </select>

    <input type="date" name="date">

    <button type="submit">Filter</button>
</form>

<hr><hr>

<div style="display:flex; gap:20px;">

    <!-- OPEN -->
<div style="flex:1;">
    <h3>Open</h3>

    @foreach($tickets->where('status','open') as $t)
        <div style="margin-bottom:15px; border:1px solid #ccc; padding:10px;">
            <b>No Ticket: {{ $t->ticket_no }}</b><br>
            <b>{{ $t->title }}</b><br>
            {{ $t->description }}<br>
            Kategori: {{ $t->category ?? '-' }}<br>

            Tanggal dibuat: {{ $t->created_at->format('d-m-Y H:i') }}<br>
            <a href="/tickets/{{ $t->id }}" style="color:blue;">Lihat Detail / Histori</a>
            <form action="/tickets/{{ $t->id }}/process" method="POST">
                @csrf
                <input type="text" name="note" placeholder="Catatan">
                <button type="submit">On Progress</button>
            </form>
        </div>
    @endforeach
</div>

    <div style="flex:1;">
    <h3>On Progress</h3>

    @foreach($tickets->where('status','on progress') as $t)
        <div style="margin-bottom:15px; border:1px solid #ccc; padding:10px;">
            <b>No Ticket: {{ $t->ticket_no }}</b><br>
            <b>{{ $t->title }}</b><br>
            {{ $t->description }}<br>
            Kategori: {{ $t->category ?? '-' }}<br>

            Tanggal dibuat: {{ $t->updated_at->format('d-m-Y H:i') }}<br>
            Catatan IT: {{ $t->note ?? '-' }}<br>   
            <a href="/tickets/{{ $t->id }}" style="color:blue;">Lihat Detail / Histori</a>
            <form action="/tickets/{{ $t->id }}/resolve" method="POST">
                @csrf
                <input type="text" name="note" placeholder="Catatan">
                <button type="submit">Resolve</button>
            </form>
        </div>
    @endforeach
    </div>

    <div style="flex:1;">
    <h3>Resolved</h3>

    @foreach($tickets->where('status','resolved') as $t)
        <div style="margin-bottom:15px; border:1px solid #ccc; padding:10px;">
            <b>No Ticket: {{ $t->ticket_no }}</b><br>
            <b>{{ $t->title }}</b><br>
            {{ $t->description }}<br>
            Kategori: {{ $t->category ?? '-' }}<br>

            Tanggal dibuat: {{ $t->updated_at->format('d-m-Y H:i') }}<br>
            Catatan IT: {{ $t->note ?? '-' }}<br>
            <a href="/tickets/{{ $t->id }}" style="color:blue;">Lihat Detail / Histori</a>
            <form action="/tickets/{{ $t->id }}/close" method="POST">
                @csrf
                <input type="text" name="note" placeholder="Catatan final">
                <button type="submit">Close</button>
            </form>
        </div>
    @endforeach
    </div>

    <div style="flex:1;">
    <h3>Closed</h3>

    @foreach($tickets->where('status','closed') as $t)
        <div style="margin-bottom:15px; border:1px solid #ccc; padding:10px;">
            <b>No Ticket: {{ $t->ticket_no }}</b><br>
            <b>{{ $t->title }}</b><br>
            {{ $t->description }}<br>
            Kategori: {{ $t->category ?? '-' }}<br>

            Tanggal dibuat: {{ $t->updated_at->format('d-m-Y H:i') }}<br>
            Catatan IT: {{ $t->note ?? '-' }}<br>
            <a href="/tickets/{{ $t->id }}" style="color:blue;">Lihat Detail / Histori</a>
        </div>
    @endforeach
</div>

</div>