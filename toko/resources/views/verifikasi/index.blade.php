@extends('layouts.app')

@section('title', 'Verifikasi Data')

@section('contents')
    <div class="d-flex align-items-center justify-content-between">
        <form action="{{ route('verifikasi.index') }}" method="GET" class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
            <div class="input-group">
                <input name="search" type="text" placeholder="Cari Verifikasi..." value="{{ request('search') }}" class="form-control bg-light border-0 small">
                <div class="input-group-append">
                    <button class="btn btn-primary" type="submit">
                        <i class="fas fa-search fa-sm"></i>
                    </button>
                </div>
            </div>
        </form>
        <a href="{{ route('verifikasi.create') }}" class="btn btn-primary">Tambah Data</a>
    </div>

    <hr />

    <a href="{{ route('verifikasi.export') }}" class="btn btn-success mb-3">Download Excel</a>


    @if(session('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-hover">
        <thead class="table-primary">
            <tr>
                <th>No</th>
                <th>Nama Toko</th>
                <th>Nama Pemilik</th>
                <th>Jenis Usaha</th>
                <th>Alamat Usaha</th>
                <!-- <th>NIB</th> -->
                <th>No HP/WA</th>
                <th>Aksi</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($verifikasiData as $verifikasi)
                <tr>
                    <td class="align-middle">{{ $loop->iteration }}</td>
                    <td class="align-middle">{{ $verifikasi->nama_toko }}</td>
                    <td class="align-middle">{{ $verifikasi->nama_pemilik }}</td>
                    <td class="align-middle">{{ $verifikasi->jenis_usaha }}</td>
                    <td class="align-middle">{{ $verifikasi->alamat_usaha }}</td>
                    <!-- <td class="align-middle">{{ $verifikasi->nib }}</td> -->
                    <td class="align-middle">{{ $verifikasi->no_hp_wa }}</td>
                    <td class="align-middle">
                        <a href="{{ route('verifikasi.show', $verifikasi->id) }}" class="btn btn-sm btn-secondary">Detail</a>
                        <a href="{{ route('verifikasi.edit', $verifikasi->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('verifikasi.destroy', $verifikasi->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Anda yakin ingin menghapus data ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                        </form>
                    </td>
                    <td class="align-middle">
                        <form action="{{ route('verifikasi.updateStatus', $verifikasi->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <select name="status" onchange="this.form.submit()" class="form-control" style="min-width: 130px;">
                            <option value="Diterima" {{ $verifikasi->status == 'Diterima' ? 'selected' : '' }}>Diverifikasi</option>
                                <option value="Ditolak" {{ $verifikasi->status == 'Ditolak' ? 'selected' : '' }}>Ditolak</option>
                            </select>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td class="text-center" colspan="9">Data verifikasi tidak ditemukan</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection

