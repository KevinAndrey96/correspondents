<?php

namespace App\Http\Controllers\Chats;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class indexChatsController extends Controller
{
    public function __invoke($id)
    {
        return view('transactions.chat', ['id'=>$id]);
    }
}
