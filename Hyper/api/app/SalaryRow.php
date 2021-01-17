<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SalaryRow extends Model
{
    public function salaryDay()
    {
        return $this->belongsTo(SalaryDay::class);
    }
}
