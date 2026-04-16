<h2>Ticket Detail</h2>

<p><b>{{ $ticket->ticket_no }}</b></p>
<p>{{ $ticket->title }}</p>
<p>Status: {{ $ticket->status }}</p>

<hr>

<h3>Ticket History</h3>

@if($logs->count() == 0)
    <p>Belum ada history</p>
@else
    @foreach($logs as $log)
        <div style="border-left:3px solid #3490dc; padding:10px; margin-bottom:12px;">

            <!-- STATUS -->
            <b>● {{ strtoupper($log->new_status) }}</b><br>

            <!-- WAKTU -->
            <small>
                {{ $log->created_at->format('d-m-Y H:i') }}
            </small>
            <br>

            <!-- CATATAN -->
            <div style="margin-top:5px;">
                Catatan: {{ $log->note ?? '-' }}
            </div>

            <!-- AKTOR -->
            <small style="color:gray;">
                oleh: {{ $log->actor ?? 'system' }}
            </small>

        </div>
    @endforeach
@endif