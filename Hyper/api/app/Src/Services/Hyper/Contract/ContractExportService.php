<?php


namespace App\Src\Services\Hyper\Contract;

use App\Src\Services\Hyper\Export\IExportService;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Support\Str;

class ContractExportService implements IExportService
{
    public function exist(string $filePath)
    {
        $exist = file_exists($filePath);

        if (!$exist) {
            throw new FileNotFoundException();
        }
    }

    /**
     * @param string $file
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     * @throws FileNotFoundException
     */
    public function export(string $file)
    {
        $filePath = storage_path() . '/contracts/' . $file;

        $this->exist($filePath);

        return \response()->download($filePath, $file, [
            'Content-Length: ' . filesize($filePath)
        ]);
    }
}
