<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

class Project extends Model
{
    protected $fillable = ['name', 'description', 'price', 'jobs_done', 'start_date', 'end_date'];

    public function users() {
        $user_id = Auth::user()->getId();
        return $this->belongsToMany('App\User', 'project_users')->wherePivot('user_id', $user_id);
    }
}
