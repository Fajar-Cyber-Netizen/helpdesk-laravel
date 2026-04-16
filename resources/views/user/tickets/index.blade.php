<h1>My Ticket Dashboard</h1>

@if(session('success'))
    <div style="background:#d4edda;padding:10px;margin-bottom:10px;">
        {{ session('success') }}
    </div>
@endif

<a href="/tickets/create">+ Buat Ticket Baru</a>

<hr>

<table border="1" cellpadding="10" cellspacing="0" width="100%">
    <tr>
        <th>No Ticket</th>
        <th>Judul</th>
        <th>Deskripsi</th>
        <th>Kategori</th>
        <th>Status</th>
        <th>Tanggal</th>
        <th>Catatan</th>
        <th>Aksi</th>
    </tr>

    @foreach($tickets as $t)
    <tr>
        <td>{{ $t->ticket_no }}</td>
        <td>{{ $t->title }}</td>
        <td>{{ $t->description }}</td>
        <td>{{ $t->category }}</td>
        <td>
            @if($t->status == 'open')
                🟡 Open
            @elseif($t->status == 'on progress')
                🔵 On Progress
            @elseif($t->status == 'resolved')
                🟢 Resolved
            @else
                ⚫ Closed
            @endif
        </td>
        <td>{{ $t->created_at->format('d-m-Y H:i') }}</td>
        <td>{{ $t->note ?? '-' }}</td>
        <td><a href="/tickets/{{ $t->id }}" style="color:blue;">Lihat Detail / History</a></td>
    </tr>
    @endforeach
</table>