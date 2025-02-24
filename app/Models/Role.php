<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{

    protected $fillable = ['name', 'priority'];

    public $timestamps = false;

    public function witneses()
    {
        return $this->belongsToMany(Witness::class);
    }
}
