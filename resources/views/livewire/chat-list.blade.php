<div style="height:350px; overflow-y: scroll;">
    @if (! is_null($messages))
        @foreach ($messages as $message)
            @if ($message->message != '')
                @if ($message->user_role == Auth::user()->role)
                    <div class="alert alert-info w-70 text-white float-end" style="display:block">{{$message->message}}</div>
                @else
                    <div class="alert alert-success w-70 text-white float-start" style="display:block">{{$message->message}}</div>
                @endif
            @endif
        @endforeach
    @endif

        <script>
            // Enable pusher logging - don't include this in production
            Pusher.logToConsole = true;

            var pusher = new Pusher('0fbdb644e77038da8545', {
                cluster: 'us2'
            });

            var channel = pusher.subscribe('chat-channel');
            channel.bind('chat-event', function(data) {
                //alert(JSON.stringify(data));
                window.livewire.emit('messageReceived', data)
            });
        </script>
</div>
