<?php

namespace App\Exports;

use App\Models\WaitingList;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class WaitingListExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        // Adjust the fields as needed
        return WaitingList::select('id', 'name', 'email', 'phone', 'signup_source', 'created_at')->get();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Name',
            'Email',
            'Phone',
            'Signup Source',
            'Created At',
        ];
    }
}