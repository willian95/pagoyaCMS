<?php

namespace App\Exports;

use App\Models\RegisteredUser;
use Maatwebsite\Excel\Concerns\FromQuery;

class RegisteredUserExport implements FromQuery
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function query()
    {
        return RegisteredUser::query()->select(["name", "email", "phone", "cargo"]);
    }
}
