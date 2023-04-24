<div style="height:400px; overflow-y: scroll;">
    @if (! is_null($messages))
        @foreach ($messages as $message)
            <div style="display:block">{{$message->message}}</div>
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
