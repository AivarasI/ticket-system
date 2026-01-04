<h2>Ticket status updated</h2>

<p><strong>Title:</strong> {{ $ticket->title }}</p>
<p><strong>New status:</strong> {{ ucfirst(str_replace('_',' ', $ticket->status)) }}</p>

<p>You can log in to the system to view details.</p>