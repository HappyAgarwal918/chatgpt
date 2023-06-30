<?php

namespace App\Http\Controllers;
use OrhanErday\OpenAI\Facades\OpenAI;
use Illuminate\Http\Request;

class ChatbotController extends Controller
{
    public function index()
    {
        return view('chatbot');
    }

    public function getResponse(Request $request)
    {
        $prompt = $request->input('prompt');
        $message = OpenAI::language()->davinci()->completion($prompt);
        return response()->json(['message' => $message]);
    }
}
