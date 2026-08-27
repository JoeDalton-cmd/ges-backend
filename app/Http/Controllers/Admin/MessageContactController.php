<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MessageContact;
use Illuminate\Http\Request;

class MessageContactController extends Controller
{
    public function index()
    {
        $messages = MessageContact::orderBy('created_at', 'desc')->get();
        return view('admin.messages.index', ['messages' => $messages]);
    }

    public function updateStatut(Request $request, $id)
    {
        $message = MessageContact::findOrFail($id);
        $message->update(['statut' => $request->statut]);
        return back()->with('succes', 'Statut mis à jour.');
    }
}
