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
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required'
        ]);

        // Отправка письма админу (нужно настроить MAIL_ в .env)
        // Для теста просто сохраним в БД или в лог
        \Log::info('Feedback from ' . $request->email . ': ' . $request->message);

        return redirect()->back()->with('success', 'Ваше сообщение отправлено администратору!');
    }
}