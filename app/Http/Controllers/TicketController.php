<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket;
use App\Models\TicketLog;

class TicketController extends Controller
{
    // =========================
    // IT - LIST TICKET
    // =========================
    public function index(Request $request)
    {
        $query = Ticket::query();

        if ($request->status) {
            $query->where('status', $request->status);
        }

        if ($request->category) {
            $query->where('category', $request->category);
        }

        if ($request->date) {
            $query->whereDate('created_at', $request->date);
        }

        $tickets = $query->latest()->get();

        return view('tickets.index', compact('tickets'));
    }

    // =========================
    // USER CREATE
    // =========================
    public function create()
    {
        return view('user.tickets.create');
    }

    // =========================
    // STORE TICKET
    // =========================
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'category' => 'required'
        ]);

        $year = date('Y');

        $lastTicket = Ticket::where('ticket_no', 'like', "TCK-$year-%")
            ->orderBy('id', 'desc')
            ->first();

        $newNumber = $lastTicket ? ((int) substr($lastTicket->ticket_no, -4) + 1) : 1;

        $ticketNo = "TCK-$year-" . str_pad($newNumber, 4, '0', STR_PAD_LEFT);

        $ticket = Ticket::create([
            'ticket_no'   => $ticketNo,
            'title'       => $request->title,
            'description' => $request->description,
            'category'    => $request->category,
            'status'      => 'open',
            'user_id'     => 1,
        ]);

        // LOG OPEN
        TicketLog::create([
            'ticket_id'  => $ticket->id,
            'old_status' => 'none',
            'new_status' => 'open',
            'note'       => 'Ticket dibuat oleh user',
            'actor'      => 'User'
        ]);

        return redirect('/user/dashboard')
            ->with('success', 'Ticket berhasil dibuat!');
    }

    // =========================
    // PROCESS
    // =========================
    public function process(Request $request, int $id)
    {
        $ticket = Ticket::findOrFail($id);
        $oldStatus = $ticket->status;

        $ticket->update([
            'status' => 'on progress',
            'note'   => $request->note
        ]);

        TicketLog::create([
            'ticket_id'  => $ticket->id,
            'old_status' => $oldStatus,
            'new_status' => 'on progress',
            'note'       => $request->note,
            'actor'      => 'IT Support'
        ]);

        return redirect('/tickets')->with('success', 'Status On Progress');
    }

    // =========================
    // RESOLVE
    // =========================
    public function resolve(Request $request, int $id)
    {
        $ticket = Ticket::findOrFail($id);
        $oldStatus = $ticket->status;

        $ticket->update([
            'status' => 'resolved',
            'note'   => $request->note
        ]);

        TicketLog::create([
            'ticket_id'  => $ticket->id,
            'old_status' => $oldStatus,
            'new_status' => 'resolved',
            'note'       => $request->note,
            'actor'      => 'IT Support'
        ]);

        return redirect('/tickets')->with('success', 'Resolved');
    }

    // =========================
    // CLOSE
    // =========================
    public function close(Request $request, int $id)
    {
        $ticket = Ticket::findOrFail($id);
        $oldStatus = $ticket->status;

        $ticket->update([
            'status' => 'closed',
            'note'   => $request->note
        ]);

        TicketLog::create([
            'ticket_id'  => $ticket->id,
            'old_status' => $oldStatus,
            'new_status' => 'closed',
            'note'       => $request->note,
            'actor'      => 'IT Support'
        ]);

        return redirect('/tickets')->with('success', 'Closed');
    }

    // =========================
    // SHOW DETAIL + HISTORY
    // =========================
    public function show(int $id)
    {
        $ticket = Ticket::findOrFail($id);

        $logs = TicketLog::where('ticket_id', $id)
            ->orderBy('created_at', 'asc')
            ->get();

        return view('tickets.show', compact('ticket', 'logs'));
    }

    // =========================
    // USER DASHBOARD
    // =========================
    public function userIndex()
    {
        $tickets = Ticket::where('user_id', 1)
            ->latest()
            ->get();

        return view('user.tickets.index', compact('tickets'));
    }
}