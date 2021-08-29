<?php

namespace App;

use App\Game;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Team extends Model
{
    use SoftDeletes;

    protected $fillable = ['name'];

    protected $appends=['games','won','tied','lost','points'];

    //################# Accessor #############################

    public function getGamesAttribute() //games
    {
        return Game::where(function ($query) {
            $query->where('team1_id', $this->attributes['id'])->orWhere('team2_id', $this->attributes['id']);
        })
            ->whereNotNull('result1')
            ->count();
    }

    public function getWonAttribute() //won
    {
        return Game::whereNotNull('result1')
            ->where(function ($query) {
                $query->where(function ($query2) {
                    $query2->where('team1_id', $this->attributes['id'])->whereRaw('result1 > result2');
                })->orWhere(function ($query2) {
                    $query2->where('team2_id', $this->attributes['id'])->whereRaw('result1 < result2');
                });
            })
            ->count();
    }

    public function getTiedAttribute() //tied
    {
        return Game::whereNotNull('result1')
            ->whereRaw('result1 = result2')
            ->where(function ($query) {
                $query->where('team1_id', $this->attributes['id'])
                    ->orWhere('team2_id', $this->attributes['id']);
            })
            ->count();
    }

    public function getLostAttribute() //lost
    {
        return Game::whereNotNull('result1')
            ->where(function ($query) {
                $query->where(function ($query2) {
                    $query2->where('team1_id', $this->attributes['id'])->whereRaw('result1 < result2');
                })->orWhere(function ($query2) {
                    $query2->where('team2_id', $this->attributes['id'])->whereRaw('result1 > result2');
                });
            })
            ->count();
    }

    public function getPointsAttribute() //points
    {
        return $this->getWonAttribute() * 3 + $this->getTiedAttribute() * 1;
    }

    //################# End Accessor #############################
}
