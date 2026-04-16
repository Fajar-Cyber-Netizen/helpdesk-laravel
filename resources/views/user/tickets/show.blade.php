<h3>Ticket History</h3>

@foreach($logs as $log)
    <div style="border-left:3px solid #3490dc; padding:10px; margin-bottom:10px;">
        
        <b>{{ strtoupper($log->new_status) }}</b><br>

        <small>
            {{ $log->created_at->format('d-m-Y H:i') }} • {{ $log->actor ?? 'system' }}
        </small>

        <p style="margin:5px 0;">
            {{ $log->note }}
        </p>

        <small style="color:gray;">
            {{ $log->old_status }} → {{ $log->new_status }}
        </small>

    </div>
@endforeach