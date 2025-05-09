@extends('layouts.app')

@section('title', 'Verifikasi')

@section('contents')
    <table class="table">
        <thead>
            <tr>
                <th>Nama Toko</th>
                <th>Nama Pemilik</th>
                <th>Jenis Usaha</th>
                <th>Alamat Usaha</th>
                <!-- <th>NIB</th> -->
                <th>No HP/WA</th>
                <th>Aksi</th> <!-- Tambahkan kolom Aksi -->
            </tr>
        </thead>
        <tbody>
            @foreach ($verifikasiData as $verifikasi)
                <tr>
                    <td>{{ $verifikasi->nama_toko }}</td>
                    <td>{{ $verifikasi->nama_pemilik }}</td>
                    <td>{{ $verifikasi->jenis_usaha }}</td>
                    <td>{{ $verifikasi->alamat_usaha }}</td>
                  <!-- //  <td>{{ $verifikasi->nib }}</td> -->
                    <td>{{ $verifikasi->no_hp_wa }}</td>
                    <td>
                        <!-- Tambahkan tombol edit dan delete -->
                        <a href="{{ route('verifikasi.edit', $verifikasi->id) }}" class="btn btn-sm btn-primary">Edit</a>
                        <form action="{{ route('verifikasi.destroy', $verifikasi->id) }}" method="POST" style="display:inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Anda yakin ingin menghapus data ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <a href="{{ route('verifikasi.create') }}" class="btn btn-success">Tambah Data</a>
@endsection

