<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Models\Chat;

class ChatList extends Component
{
    public $messages;
    public $transactionID;

    public function mount()
    {
        $this->messages = Chat::where('transaction_id', $this->transactionID)->orderBy('id', 'asc')->get();
    }

    protected $listeners = ['messageReceived'];

    public function messageReceived($data)
    {
        $chatCount = Chat::where('message', $data['message']['message'])->get()->count();

        if ($chatCount == 0) {
            $chat = new Chat();
            $chat->transaction_id = $data['message']['transactionID'];
            $chat->message = $data['message']['message'];
            $chat->user_role = $data['message']['userRole'];
            $chat->user_id = $data['message']['userID'];
            $chat->save();
            dd($data['message']['userID']);
        }

        $this->messages = Chat::where('transaction_id', $data['message']['transactionID'])->orderBy('id', 'asc')->get();
    }

    public function render()
    {
        return view('livewire.chat-list');
    }
}
