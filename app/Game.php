<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Game extends Model
{
    use SoftDeletes;

    protected $fillable = ['start_time', 'result1', 'result2', 'team1_id', 'team2_id'];

    /**
     * Set to null if empty
     * @param $input
     */
    public function setTeam1IdAttribute($input)
    {
        $this->attributes['team1_id'] = $input ? $input : null;
    }

    /**
     * Set to null if empty
     * @param $input
     */
    public function setTeam2IdAttribute($input)
    {
        $this->attributes['team2_id'] = $input ? $input : null;
    }

    /**
     * Set attribute to date format
     * @param $input
     */
    // public function setStartTime1Attribute()
    // {

    //     // if ($input != null && $input != '') {

    //     //     $this->attributes['start_time'] = Carbon::createFromFormat(config('app.date_format') , $input)->format('Y-m-d');
    //     // } else {
    //     //     $this->attributes['start_time'] = null;
    //     // }
    // }
    //################# Accessor #############################
    /**
     * Get attribute from date format
     * @param $input
     *
     * @return string
     */
    // public function getStartTime1Attribute()
    // {
    //     // $zeroDate = str_replace(['Y', 'm', 'd'], ['0000', '00', '00'], config('app.date_format'));

    //     // if ($input != $zeroDate && $input != null) {
    //     //     return Carbon::createFromFormat('Y-m-d', $input)->format(config('app.date_format') );
    //     // } else {
    //     //     return '';
    //     // }
    // }

    /**
     * Set attribute to money format
     * @param $input
     */
    public function setResult1Attribute($input)
    {
        $this->attributes['result1'] = $input ? $input : null;
    }

    /**
     * Set attribute to money format
     * @param $input
     */
    public function setResult2Attribute($input)
    {
        $this->attributes['result2'] = $input ? $input : null;
    }
    // ################## Mutators ##########################

    public function team1()
    {
        return $this->belongsTo(Team::class, 'team1_id')->withTrashed();
    }

    public function team2()
    {
        return $this->belongsTo(Team::class, 'team2_id')->withTrashed();
    }
}
