<?php

namespace App;

use App\Src\Models\Hyper\Availability\MyAvailabilityModel;
use Illuminate\Database\Eloquent\Model;

class Availability extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeDate($query, MyAvailabilityModel $availabilityModel)
    {
        return $query->whereBetween(
            'date',
            [
                $availabilityModel->getStartDate()->toDateString(),
                $availabilityModel->getEndDate()->toDateString()
            ]
        )->orderBy('date', 'asc');
    }
}
