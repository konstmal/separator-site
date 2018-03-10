<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['number', 'input', 'output'];

    /**
     * User, who create this task
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }


}
