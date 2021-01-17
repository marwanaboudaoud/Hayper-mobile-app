<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    public function employeeSchedules()
    {
        return $this->belongsToMany(User::class, 'employee_schedule');
    }

    public function driver()
    {
        return $this->belongsTo(User::class, 'driver_id');
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }
}
