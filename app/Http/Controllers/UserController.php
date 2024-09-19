<?php

namespace App\Http\Controllers;

use App\Models\Absence;
use App\Models\Motif;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(): \Illuminate\View\View
    {
        $users = User::all();

        return view('user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): \Illuminate\View\View
    {
        return view('user.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): \Illuminate\View\View
    {
        return view('user.index');
    }

    public function show(int $id): \Illuminate\View\View
    {
        $users = User::findOrFail($id);
        $motifs = Motif::all();
        $absences = Absence::where('user_id', $users->id)->get();

        return view('user.show', compact('absences', 'users', 'motifs'));
    }
}
