<?php

namespace App\Http\Controllers;

use App\Team;
use Illuminate\Http\Request;

class AllTeamsController extends Controller
{
    public function index()
    {
        $teams = Team::all();
        return response()->json([
            'team' => $teams]
        );
    }
}
