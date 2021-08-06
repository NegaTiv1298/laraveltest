<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShortLink extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'request_link', 'token_link', 'attendance_limit', 'time_to_die', 'count_limit',
    ];
}
