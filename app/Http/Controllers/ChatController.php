<?php

namespace App\Http\Controllers;

use App\Events\ChatMessageSent;
use App\Models\ChatMessage;
use Database\Seeders\ChatMessageSeeder;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function index()
    {
        $messages = ChatMessage::with('user')->select('id', 'user_id', 'message', 'created_at')->latest()->take(500)->get()->reverse();

        return view('chat.chat', compact('messages'));
    }

    public function seedMessages(Request $request)
    {
        // call ChatMessageSeeder
        $seeder = new ChatMessageSeeder;
        $seeder->run($request);

        return redirect()->route('chat');
    }

    public function sendMessage(Request $request)
    {
        $request->validate([
            'message' => 'required|string|max:1000',
        ]);

        $message = ChatMessage::create([
            'user_id' => auth()->user()->id,
            'message' => $request->message,
        ]);

        broadcast(new ChatMessageSent($message))->toOthers();

        return response()->json(['message' => $message, 'status' => 'Message sent!']);
    }

    public function getMessages()
    {
        $messages = ChatMessage::with('user')->latest()->take(50)->get()->reverse();

        return response()->json($messages);
    }

    public function destroy(Request $request, ChatMessage $message)
    {
        try {
            if (! $message->user_id == auth()->user()->id) {
                return response()->json(['error' => 'Unauthorized!'], 401);
            }
            if (! $message) {
                return response()->json(['error' => 'Message not found!'], 404);
            }
            $message->delete();

            return response()->json(['success' => 'Message deleted successfully!'], 200);

        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()], 500);
        }
    }

    public function clearMessages()
    {
        try {
            if (ChatMessage::count() == 0) {
                return redirect()->back()->with('error', 'No messages found!');
            }
            if (auth()->user()->is_admin()) {
                ChatMessage::truncate();
            } else {
                if (auth()->user()->chatMessages()->count() > 0) {
                    auth()->user()->chatMessages()->delete();
                } else {
                    return redirect()->back()->with('error', 'No messages found!');
                }
            }

            return redirect()->back()->with('success', 'Messages cleared successfully!');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }
}
