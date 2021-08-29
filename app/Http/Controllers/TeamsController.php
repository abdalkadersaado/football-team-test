<?php

namespace App\Http\Controllers;

use App\Team;
use Illuminate\Http\Request;
use App\Http\Requests\StoreTeamsRequest;
use App\Http\Requests\UpdateTeamsRequest;
use Validator;

class TeamsController extends Controller
{
    public function index()
    {
        $teams = Team::all();

        return response()->json($teams);
    }
    public function teams1()
    {
        $team = Team::get();
        return response()->json(['status' => 'success', 'data' => $team]);
    }
    public function teams2()
    {
        $team = Team::get();
        return response()->json(['status' => 'success', 'data' => $team]);
    }
    public function getteams()
    {

        $teams = Team::paginate(4);
        return response()->json(['status' => 'success', 'data' => $teams]);
    }
    /**
     * Show the form for creating new Team.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $validate = Validator::make($request->all(), [

            'name' => 'required',

        ]);

        if ($validate->fails()) {
            return response()->json(['status' => 'error', 'errors' => $validate->errors()]);
        }

        //  $game = Game::create($request->all());
        $game = new Team();
        $game->name = $request->name;

        $game->save();

        return response()->json(['status' => 'success', 'data' => $game]);
    }


    public function update(UpdateTeamsRequest $request, $id)
    {

        $team = Team::findOrFail($id);
        $team->update($request->all());

        return redirect()->route('teams.index');
    }

    /**
     * Remove Team from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($teamid)
    {
        $team = Team::findOrFail($teamid);
        $team->delete();

        return response()->json(['status' => 'success', 'data' => $team]);
    }

    /**
     * Delete all selected Team at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if ($request->input('ids')) {
            $entries = Team::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }
}
