<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class MessengerController extends Controller
{
    //
    public function index() {
        $users = User::all()->whereNotIn("id", auth()->id());
        return Inertia::render("Messenger/Index", compact("users"));
    }

    public function conversation(User $user) {
        return Chat::query()
            ->where(function ($q) use ($user) {
                $q->where("from_id" , auth()->id())
                    ->where("to_id", $user->id);
            })
            ->orWhere(function($q) use ($user) {
                $q->where("from_id", $user->id)
                    ->where("to_id", auth()->id());
            })
            ->with(['from', 'to'])
            ->orderBy("id", "asc")
            ->get();
    }
}
