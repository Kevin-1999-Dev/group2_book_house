<?php

namespace App\Exports;
use App\Models\User;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;

class UserExport implements FromCollection, WithHeadings,WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return User::all();
    }
    public function map($user): array
    {
        return [
            $user->id,
            $user->name,
            $user->email,
            ($user->role)? "admin":"user",
            ($user->active)? "enable":"disable",
        ];
    }
    public function headings(): array
    {
        return [
            'Id',
            'Name',
            'Email',
            'Role',
            'Active',
        ];
    }
}