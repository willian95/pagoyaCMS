<?php

namespace App\Exports;

use App\Models\Prospect;
use Maatwebsite\Excel\Concerns\FromQuery;

class ProspectExport implements FromQuery
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function query()
    {
        return Prospect::query()->select(["name", "email", "phone", "cargo", "question"]);
    }
}
