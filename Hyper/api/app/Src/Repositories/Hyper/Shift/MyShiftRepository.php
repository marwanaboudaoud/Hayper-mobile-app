<?php


namespace App\Src\Repositories\Hyper\Shift;

use App\Src\Models\Hyper\User\UserModel;
use App\Src\Repositories\Hyper\Schedule\IMyScheduleRepository;
use App\User;

class MyShiftRepository implements IMyShiftRepository
{

    public function count(string $token)
    {

        $half_shifts_count = User::withCount(['schedules' => function ($query) {
            $query->where('availability_shift_id', 2);
        }])
            ->where('api_token', $token)
            ->get();

        $full_shifts_count = User::withCount(['schedules' => function ($query) {
            $query->where('availability_shift_id', 1);
        }])
            ->where('api_token', $token)
            ->get();

        $half_shift = $half_shifts_count[0]->schedules_count / 2;
        return $half_shift + $full_shifts_count[0]->schedules_count;
    }
}
