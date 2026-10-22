<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Portfolio extends Model
{
    protected $table = 'portfolios';

    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $fillable = [
        'full_name',
        'profile_picture',
        'email',
        'contact_number',
        'address',
        'about_me',
        'education',
        'skills',
        'projects',
        'work_experience',
        'social_links',
        'template',
        'visitor_id',
        'user_id',
    ];
}