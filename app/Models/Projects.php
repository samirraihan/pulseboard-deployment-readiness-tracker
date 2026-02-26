<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Projects extends Model
{
    protected $fillable = ['name', 'owner_email', 'release_date'];

    protected $casts = [
        'release_date' => 'date',
    ];

    public function deploymentChecks()
    {
        return $this->hasMany(DeploymentChecks::class, 'project_id');
    }
}
