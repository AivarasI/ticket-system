<h2>New comment on your ticket</h2>

<p><strong>Ticket:</strong> {{ $comment->ticket->title }}</p>
<p><strong>Comment:</strong><br>{{ $comment->content }}</p>
<p>Added by: {{ $comment->user->name }}</p>