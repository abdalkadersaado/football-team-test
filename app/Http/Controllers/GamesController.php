<?php

namespace App\Http\Controllers;

use App\Game;
use Illuminate\Http\Request;
use Validator;
use App\Http\Requests\StoreGamesRequest;
use App\Http\Requests\UpdateGamesRequest;

class GamesController extends Controller
{
    public function index()
    {
        $games = Game::all();

        return response()->json([
            'status' => 'success',
             'data' => $games]
            );
    }

    /**
     * Show the form for creating new Game.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $team1s = \App\Team::get()->pluck('name', 'id')->prepend('Please select', '');
        $team2s = \App\Team::get()->pluck('name', 'id')->prepend('Please select', '');

        $validate = Validator::make($request->all(), [
            // 'team1_id'=>'required',
            // 'team2_id'=>'required',
            'start_time' => 'required',
            'result1' => 'required',
            'result2' => 'required'
        ]);

        if ($validate->fails()) {
            return response()->json(['status' => 'error', 'errors' => $validate->errors()]);
        }

        //  $game = Game::create($request->all());
        $game = new Game();
        $game->team1_id = $request->team1_id;
        $game->team2_id = $request->team2_id;
        $game->start_time = $request->start_time;
        $game->result1 = $request->result1;
        $game->result2 = $request->result2;
        $game->type_match = $request->type_match;

        $game->save();

        // $team1s->team1()->create($request->input('teams.*.id', []));
        // $team2s->team2()->create($request->input('teams.*.id', []));

        return response()->json(['status' => 'success', 'data' => $game]);
    }

    public function getgames()
    {
        $game =  Game::with('team1', 'team2')->orderBy('id', 'desc')->paginate(3);
        // $game = Game::all()->orderBy('id', 'desc');
        return response()->json(['status' => 'success', 'data' => $game]);
    }


    /**
     * Store a newly created Game in storage.
     *
     * @param  \App\Http\Requests\StoreGamesRequest  $request
     * @return \Illuminate\Http\Response
     */



    /**
     * Show the form for editing Game.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $team1s = \App\Team::get()->pluck('name', 'id')->prepend('Please select', '');
        $team2s = \App\Team::get()->pluck('name', 'id')->prepend('Please select', '');

        $game = Game::findOrFail($id);

        return response()->json($game);
    }

    /**
     * Update Game in storage.
     *
     * @param  \App\Http\Requests\UpdateGamesRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateGamesRequest $request, $id)
    {
        $game = Game::findOrFail($id);
        $game->update($request->all());

        return redirect()->route('games.index');
    }

    public function destroy($postid)
    {
        $game = Game::find($postid);
        if ($game->delete()); {
            return response()->json(['status' => 'success', 'data' => $game]);
        }
    }

    /**
     * Delete all selected Game at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if ($request->input('ids')) {
            $entries = Game::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }
}
