<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{

    protected $fillable = ['name', 'priority', 'id'];

    public $timestamps = false;

    public function witnesses()
    {
        return $this->belongsToMany(Witness::class);
    }
}
