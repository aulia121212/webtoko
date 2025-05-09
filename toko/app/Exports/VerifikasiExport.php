<?php

namespace App\Exports;

use App\Models\Verifikasi;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Facades\Http;

class VerifikasiExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Verifikasi::select(
            'id',
            'nama_toko',
            'nama_pemilik',
            'jenis_usaha',
            'alamat_usaha',
            'no_hp_wa',
            'status',
            'created_at'
        )->get();
        
    }

    public function headings(): array
{
    return [
        'ID',
        'Nama Toko',
        'Nama Pemilik',
        'Jenis Usaha',
        'Alamat Usaha',
        'No HP/WA',
        'Status',
        'Tanggal Dibuat'
    ];
    
}

}