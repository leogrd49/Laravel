<?php

namespace App\Http\Controllers;

use App\Models\Absence;
use App\Models\User;
use DB;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function index()
    {
        $users = User::all();
        return view('user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('user.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    public function show($id)
{
    $absences = DB::table('absences')
        ->where('user_id', $id)
        ->get();

    if ($absences->isEmpty()) {
        return redirect()->back()->with('error', 'Aucune absence trouvée pour cet utilisateur.');
    }

    return view('user.show', ['absences' => $absences]);
}
}
