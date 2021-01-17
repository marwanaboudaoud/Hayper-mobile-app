<?php


namespace App\Src\Services\Hyper\AvailabilityShift;

use App\Exceptions\AvailabilityShift\AvailabilityShiftNotFoundException;
use App\Src\Models\Hyper\AvailabilityShift\AvailabilityShiftModel;
use App\Src\Repositories\Hyper\AvailabilityShift\IAvailabilityShiftRepository;
use Illuminate\Support\Collection;

class AvailabilityShiftService implements IAvailabilityShiftService
{
    /**
     * @var IAvailabilityShiftRepository
     */
    private $availabilityShiftRepository;

    const FULL_TIME = 1;

    const PART_TIME = 2;

    public function __construct(IAvailabilityShiftRepository $availabilityShiftRepository)
    {
        $this->availabilityShiftRepository = $availabilityShiftRepository;
    }

    /**
     * @param int $id
     * @return AvailabilityShiftModel
     * @throws AvailabilityShiftNotFoundException
     */
    public function find(int $id)
    {
        $result = $this->availabilityShiftRepository->find($id);

        if (!$result) {
            throw new AvailabilityShiftNotFoundException();
        }

        return $result;
    }

    /**
     * Returns shift fulltime and partime when id fulltime
     * Returns shift partime when id partime
     * @param Collection $ids
     */
    public static function rules(Collection $ids)
    {
        if ($ids->first() === self::PART_TIME) {
            $ids->add(self::FULL_TIME);
        }
    }
}
