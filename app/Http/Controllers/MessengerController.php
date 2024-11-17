<?php

namespace App\Http\Controllers;

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
}
