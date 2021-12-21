<?php

namespace App\Exports;

use App\Models\RegisteredUser;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;

class RegisteredUserExport implements FromQuery, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function query()
    {
        return RegisteredUser::query()->select(["name", "email", "phone", "cargo"]);
    }

    public function headings(): array
    {
        return [
            'Nombre',
            'Email',
            'Telefono',
            'Cargo'
        ];
    }
}
