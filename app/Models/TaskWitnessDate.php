<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TaskWitnessDate extends Model
{
    protected $table = 'task_witness_date';

    protected $fillable = ['id', 'date', 'task', 'role_id', 'witness_id'];

    public $timestamps = false;

    public function witness(): BelongsTo
    {
        return $this->belongsTo(Witness::class);
    }

    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }
}
