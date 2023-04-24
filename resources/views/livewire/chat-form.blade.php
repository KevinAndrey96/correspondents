<div class="mb-3">
    <input type="text" id="message" class="form-control border p-2 mt-2" name="message" wire:model="message" required>
    <div class="d-flex justify-content-center">
        <button class="btn btn-success ms-auto me-auto mt-3" wire:click="sendMessage" onclick="clearInput()">Enviar</button>
    </div>
    <script type="text/javascript">
        function clearInput()
        {
            document.getElementById('message').value = '';
        }
    </script>
</div>
