<?php

namespace App\Exports;

use App\Models\User;
use Illuminate\Contracts\Support\Responsable;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UsersExport implements FromCollection, WithHeadings, Responsable, ShouldAutoSize
{
    use Exportable;

    public int $userId = 0;
    private string $fileName = 'users.xlsx';

    public function __construct()
    {
        $this->fileName = date('Y-m-d H:i:s_') . $this->fileName;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        if ($this->userId === 0) {
            $users = USER::get(['id', 'firstName', 'secondName', 'middleName', 'debt', 'stateFee']);
            return $users;
        } else {
            $user = USER::where('id', $this->userId)->get(['id', 'firstName', 'secondName', 'middleName', 'debt', 'stateFee']);
            return $user;
        }

    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return ['ID', 'First Name', 'Second Name', 'Middle Name', 'Debt', 'State Fee'];
    }
}
