<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;

class UsersExport implements FromCollection
{
    public function collection()
    {
        return \App\Models\User::all();
    }

    public function headings(): array
    {
        return [
            trans('users.id') => 'ID',
            trans('users.name') => 'Name',
            trans('users.email') => 'Email',
            trans('users.is_admin') => 'IsAdmin',
            trans('users.created_at') => 'Created At'
        ];
    }
}