<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class FeedbackController extends Controller
{
    public function create()
    {
        return view('feedback.create');
    }

    public function send(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string'
        ]);

        // Сохраняем в лог (для простоты)
        $log = "Feedback from: {$request->name} ({$request->email})\n";
        $log .= "Message: {$request->message}\n";
        $log .= str_repeat('-', 50) . "\n";
        
        \Log::info($log);

        return redirect()->route('feedback.create')->with('success', 'Спасибо! Ваше сообщение отправлено администратору.');
    }
}