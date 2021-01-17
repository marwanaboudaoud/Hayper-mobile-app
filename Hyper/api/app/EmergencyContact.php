<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EmergencyContact extends Model
{
    protected $fillable = ['first_name', 'last_name', 'phone', 'relationship'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
