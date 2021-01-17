<?php

namespace App\Exports\Employee;

use App\Src\Mappers\Hyper\Employee\EmployeeExportMapper;
use App\Src\Services\Hyper\Employee\EmployeeService;
use App\User;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class EmployeeExport implements FromCollection, WithHeadings, WithMapping
{
    /**
     * @var Collection
     */
    private $collection;

    public function __construct(Collection $collection)
    {
        $this->collection = $collection;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return $this->collection;
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'Persnr.',
            'Alias',
            'Voornaam',
            'Achternaam',
            'Emailadres',
            'Functie',
            'Plaats',
            'Rijbewijs',
            'Datum in dienst',
            'Einddatum contract'
        ];
    }


    /**
     * @param mixed $row
     *
     * @return array
     */
    public function map($row): array
    {
        return EmployeeExportMapper::toArray($row);
    }
}
