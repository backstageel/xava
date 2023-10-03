<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function index(){
        $messages = Message::where('receiver_id', Auth::user()->id)->get();
        return view('messages.index', compact('messages'));
    }

    public function create(){
        $users = User::pluck('id', 'name');
        return view ('message.create', compact('users'));
    }
    public function send(Request $request)
    {
        $message = new Message();
        $message->sender_id = auth()->user()->i;
        $message->receiver_id = $request->input('receiver_id');
        $message->message_content = $request->input('message_content');


        return redirect('/')->with('success', 'Mensagem enviada com sucesso!');
    }
}
