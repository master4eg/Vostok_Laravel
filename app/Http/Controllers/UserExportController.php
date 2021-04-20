<?php

namespace App\Http\Controllers;

use App\Exports\UsersExport;


class UserExportController extends Controller
{
    public function export(int $id = 0)
    {
        if ($id === 0) {
            return new UsersExport;
        } else {
            $excel = new UsersExport;
            $excel->userId = $id;
            return $excel;
        }
    }
}
