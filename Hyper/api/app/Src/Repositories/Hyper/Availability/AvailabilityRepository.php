<?php


namespace App\Src\Repositories\Hyper\Availability;

use App\Availability;
use App\Availability as AvailabilityAlias;
use App\Src\Mappers\Hyper\Availability\AvailabilityEloquentModelMapper;
use App\Src\Mappers\Hyper\Availability\AvailabilityModelMapper;
use App\Src\Models\Hyper\Availability\AvailabilityCountModel;
use App\Src\Models\Hyper\Availability\AvailabilityModel;
use App\Src\Models\Hyper\Availability\AvailabilitySearchModel;
use App\Src\Models\Hyper\AvailabilityShift\AvailabilityShiftModel;
use App\Src\Models\Hyper\User\UserModel;
use App\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class AvailabilityRepository implements IAvailabilityRepository
{
    /**
     * @param AvailabilityModel $availabilityModel
     * @return AvailabilityModel
     */
    public function store(AvailabilityModel $availabilityModel)
    {
        $model = AvailabilityModelMapper::toEloquentModel($availabilityModel);
        $model->save();

        return AvailabilityEloquentModelMapper::toModel($model);
    }

    public function findBy(array $args)
    {
        $availability = AvailabilityAlias::where($args)->first();

        if (!$availability) {
            return null;
        }

        return AvailabilityEloquentModelMapper::toModel($availability);
    }

    public function findByIdAndUserId(int $id, int $userId)
    {
        return $this->findBy([
            'id' => $id,
            'user_id' => $userId
        ]);
    }

    /**
     * @param AvailabilityModel $availabilityModel
     * @return AvailabilityModel|null
     */
    public function update(AvailabilityModel $availabilityModel)
    {
        $foundAvailability = $this->findByIdAndUserId(
            $availabilityModel->getId(),
            $availabilityModel->getUserId()
        );

        if (!$foundAvailability) {
            return null;
        }

        $updateModel = AvailabilityModelMapper::toEloquentUpdateModel($foundAvailability, $availabilityModel);
        $updateModel->save();

        return AvailabilityEloquentModelMapper::toModel($updateModel);
    }

    /**
     * @param AvailabilitySearchModel $availabilitySearchModel
     * @return Collection
     */
    public function get(AvailabilitySearchModel $availabilitySearchModel)
    {
        $availabilities = Availability::where([
            'date' => $availabilitySearchModel->getDate()->toDateString(),
            'is_present' => 1,
        ])->whereIn('availability_shift_id', $availabilitySearchModel->getAvailabilityShiftIds());

        if ($availabilitySearchModel->isDriver()) {
            $availabilities->whereHas('user', function ($query) {
                $query->where('has_drivers_license', true);
            });
        }

        return AvailabilityEloquentModelMapper::toAvailabilitySearchModelCollection($availabilities->get());
    }

    /**
     * @param AvailabilityCountModel $availabilityCountModel
     * @return Collection
     */
    public function count(AvailabilityCountModel $availabilityCountModel)
    {
        $userIds = $availabilityCountModel->getEmployees()->map(function (UserModel $item) {
            return $item->getId();
        });

        $availabilityShiftIds = $availabilityCountModel->getAvailabilityShiftIds()
            ->map(function (int $id) {
                return $id;
            });


        $availabilities = Availability::select(DB::raw("COUNT('id') AS count"))
            ->where([
                'date' => $availabilityCountModel->getDate()->toDateString(),
                'is_present' => 1,
            ])
            ->whereIn('user_id', $userIds)
            ->whereIn('availability_shift_id', $availabilityShiftIds);

        if ($availabilityCountModel->isDriver()) {
            $availabilities->whereHas('user', function ($query) {
                $query->where('has_drivers_license', true);
            });
        }

        $availabilities = $availabilities->first();

        return $availabilities->count;
    }
}
