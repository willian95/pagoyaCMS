<?php

namespace App\Exports;

use App\Models\Prospect;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ProspectExport implements FromQuery, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function query()
    {
        return Prospect::query()->select(["name", "email", "phone", "cargo", "question"]);
    }

    public function headings(): array
    {
        return [
            'Nombre',
            'Email',
            'Teléfono',
            'Cargo',
            'Pregunta'
        ];
    }
}
