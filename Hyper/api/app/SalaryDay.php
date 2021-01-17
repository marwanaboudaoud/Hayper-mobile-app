<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class SalaryDay extends Model
{
    public function salaryRows()
    {
        return $this->hasMany(SalaryRow::class);
    }

    public function partner()
    {
        return $this->belongsTo(Partner::class);
    }

    public function scopeManualSalary($query, int $id)
    {
        return $query->where('id', $id)
            ->andWhere('is_manual', 1)
            ->first();
    }
}
