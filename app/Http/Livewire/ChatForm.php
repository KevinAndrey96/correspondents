<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ChatForm extends Component
{

    public $transactionID;
    public $message;


    public function mount()
    {
        $this->message = '';
    }


    public function render()
    {
        return view('livewire.chat-form');
    }

    public function sendMessage()
    {
        $data = [
            'message'=> $this->message,
            'transactionID' => $this->transactionID,
            'userRole' => Auth::user()->role
        ];

        //$this->emit('messageReceived', $data);

        event(new \App\Events\SendMessage($data));

        $this->message = '';
    }
}
