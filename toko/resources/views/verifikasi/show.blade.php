@extends('layouts.app')

@section('title', 'Detail Verifikasi')

@section('contents')  {{-- Make sure this matches your yield in the layout --}}
    <hr />
    <div class="container">
        <h2>Detail Verifikasi</h2>
        <table class="table table-bordered">
            <tbody>
                <tr>
                    <th>Nama Toko</th>
                    <td>{{ $verifikasi->nama_toko }}</td>
                </tr>
                <tr>
                    <th>Nama Pemilik</th>
                    <td>{{ $verifikasi->nama_pemilik }}</td>
                </tr>
                <tr>
                    <th>Jenis Usaha</th>
                    <td>{{ $verifikasi->jenis_usaha }}</td>
                </tr>
                <tr>
                    <th>Alamat Usaha</th>
                    <td>{{ $verifikasi->alamat_usaha }}</td>
                </tr>
                <!-- <tr>
                    <th>NIB</th>
                    <td>{{ $verifikasi->nib }}</td>
                </tr> -->
                <tr>
                    <th>No HP/WA</th>
                    <td>{{ $verifikasi->no_hp_wa }}</td>
                </tr>
                <tr>
                    <th>Created At</th>
                    <td>{{ $verifikasi->created_at->format('d-m-Y H:i:s') }}</td>
                </tr>
                <tr>
                    <th>Updated At</th>
                    <td>{{ $verifikasi->updated_at->format('d-m-Y H:i:s') }}</td>
                </tr>
            </tbody>
        </table>
        <div>
            <a href="{{ route('verifikasi.edit', $verifikasi->id) }}" class="btn btn-sm btn-primary">Edit</a>
            <a href="{{ route('verifikasi.index') }}" class="btn btn-sm btn-secondary">Kembali</a>
        </div>
    </div>
@endsection
