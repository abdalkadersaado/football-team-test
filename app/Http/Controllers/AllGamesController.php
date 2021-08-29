<?php

namespace App\Http\Controllers;

use App\Game;
use Illuminate\Http\Request;

class AllGamesController extends Controller
{
    public function index()
    {
        $games = Game::with('team1', 'team2')->whereNull('result1')->get();
        $results = Game::whereNotNull('result1')->get();

        return response()->json([
            'games' => $games,
            'results' => $results]
        );
    }
}
