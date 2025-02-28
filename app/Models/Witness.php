<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Witness extends Model
{
    protected $fillable = ['full_name', 'active', 'id'];

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }
}
