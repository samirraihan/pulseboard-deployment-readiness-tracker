<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DeploymentChecks extends Model
{
    protected $fillable = ['project_id', 'title', 'is_completed', 'completed_at'];

    protected $casts = [
        'is_completed' => 'boolean',
        'completed_at' => 'datetime',
    ];

    public function project()
    {
        return $this->belongsTo(Projects::class, 'project_id');
    }
}
