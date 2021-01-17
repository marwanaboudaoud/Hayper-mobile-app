<?php


namespace App\Src\Repositories\Hyper\Schedule;

use App\Availability;
use App\Exceptions\Schedule\ScheduledEmployeeException;
use App\Http\Requests\Schedule\EmployeeScheduleRequest;
use App\Project;
use App\Schedule;
use App\Src\Mappers\Hyper\Employee\EmployeeScheduleEloquentMapper;
use App\Src\Mappers\Hyper\Project\ProjectEloquentMapper;
use App\Src\Mappers\Hyper\Schedule\EmployeeScheduleModel;
use App\Src\Mappers\Hyper\Schedule\ScheduleEloquentMapper;
use App\Src\Mappers\Hyper\Schedule\ScheduleModelMapper;
use App\Src\Models\Hyper\Pagination\PaginationEmployeeScheduleModel;
use App\Src\Models\Hyper\Schedule\ScheduleModel;
use App\Src\Models\Hyper\User\UserModel;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use phpDocumentor\Reflection\DocBlockFactory;
use \Illuminate\Support\Facades\DB as DB;

class ScheduleRepository implements IScheduleRepository
{
    /**
     * @param Carbon $startDate
     * @param Carbon $endDate
     * @return Collection
     */
    public function get(Carbon $startDate, Carbon $endDate)
    {
        $schedulesPerProject = Project::with(
            ['schedules' => function ($query) use ($startDate, $endDate) {
                $query->with('employeeSchedules')->whereBetween(
                    'date',
                    [
                        $startDate->toDateString(),
                        $endDate->toDateString()
                    ]
                );
            }]
        )->get();

        return ProjectEloquentMapper::toCollectionModel($schedulesPerProject);
    }

    public function store(ScheduleModel $scheduleModel)
    {
        $model = ScheduleModelMapper::toEloquentModel($scheduleModel);
        $model->save();


        $model->employeeSchedules()->sync(
            $scheduleModel->getEmployees()->map(
                function ($item) {
                    return $item->getId();
                }
            )->toArray()
        );

        return ScheduleEloquentMapper::toModel($model);
    }


    public function update(ScheduleModel $updatedModel)
    {
        $oldModel = $this->findById($updatedModel->getId());

        if (!$oldModel) {
            return false;
        }

        $model = ScheduleModelMapper::toEloquentUpdateModel($oldModel, $updatedModel);
        $model->save();

        $model->employeeSchedules()
            ->sync(
                $updatedModel->getEmployees()->map(
                    function ($item) {
                        return $item->getId();
                    }
                )->toArray()
            );

        return ScheduleEloquentMapper::toModel($model);
    }

    public function findById(?int $id)
    {
        if (!$id) {
            return null;
        }

        $eloquentModel = Schedule::find($id);

        if (!$eloquentModel) {
            return null;
        }

        return ScheduleEloquentMapper::toModel($eloquentModel);
    }

    /**
     * @param int $id
     * @return bool
     */
    public function delete(int $id)
    {
        $foundSchedule = Schedule::find($id);

        if (!$foundSchedule) {
            return false;
        }

        $foundSchedule->delete();

        return true;
    }

    /**
     * @param ScheduleModel $scheduleModel
     * @return Schedule[]|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function scheduledEmployees(ScheduleModel $scheduleModel)
    {
        return Schedule::with(['employeeSchedules' => function ($query) use ($scheduleModel) {
            $scheduleModel->getEmployees()->each(function (UserModel $employee) use ($query) {
                if ($query->where('user_id', $employee->getId())->get()) {
                    throw new ScheduledEmployeeException();
                }
            });
        }])
            ->where([
                'date' => $scheduleModel->getDate()->toDateString(),
            ])
            ->get();
    }
}
