<?php


namespace App\Src\Services\Hyper\Export\Employee;

use App\Exports\Employee\EmployeeExport;
use App\Src\Mappers\Hyper\Pagination\PaginationModelMapper;
use App\Src\Mappers\Hyper\User\UserModelMapper;
use App\Src\Models\Hyper\Pagination\PaginationModel;
use App\Src\Repositories\Hyper\User\IUserRepository;
use App\Src\Services\Hyper\Employee\IEmployeeService;
use App\Src\Services\Hyper\Export\IExportService;


use App\Src\Services\Hyper\Export\IGenerateService;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Excel;
use PhpOffice\PhpSpreadsheet\Writer\Exception;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class EmployeeExportCsvService implements IExportService, IGenerateService
{
    /**
     * @var IEmployeeService
     */
    private $employeeService;

    /**
     * @var Excel
     */
    private $excel;

    public function __construct(IEmployeeService $employeeService, Excel $excel)
    {
        $this->employeeService = $employeeService;
        $this->excel = $excel;
    }

    /**
     * @param  string $file
     * @return BinaryFileResponse
     * @throws FileNotFoundException
     */
    public function export(string $file)
    {
        $exist = file_exists($file);

        if (!$exist) {
            throw new FileNotFoundException();
        }

        return response()->download($file)->deleteFileAfterSend(true);
    }

    public function generate(PaginationModel $paginationModel)
    {
        $paginationEmployeeModel = PaginationModelMapper::toPaginationEmployeeModel($paginationModel);

        $users = $this->employeeService->get($paginationEmployeeModel);

        $users = UserModelMapper::toEloquentExportCollectionModel($users->getItems());

        try {
            $dir = 'public/';
            $randomString = Str::random('16');
            $fileName = $dir . $randomString;

            $this->excel->store(new EmployeeExport($users), $fileName . '.csv');

            return $randomString;
        } catch (Exception $e) {
        } catch (\PhpOffice\PhpSpreadsheet\Exception $e) {
            return false;
        }
    }
}
