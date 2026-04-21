<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Project;

class Workspace extends Model
{
    protected $fillable = ['name', 'slug', 'owner_id', 'description'];

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function projects()
    {
        return $this->hasMany(Project::class);
    }
}
