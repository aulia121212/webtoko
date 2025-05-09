@extends('layouts.app')

@section('title', 'Edit Verifikasi')

@section('contents')
    <h1>Edit Verifikasi</h1>

     <form action="{{ route('verifikasi.update', $verifikasi->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="nama_toko">Nama Toko</label>
            <input type="text" name="nama_toko" id="nama_toko" class="form-control" value="{{ $verifikasi->nama_toko }}" required>
        </div>


          <div class="form-group">
            <label for="nama_pemilik">Nama Pemilik</label>
            <input type="text" name="nama_pemilik" id="nama_pemilik" class="form-control" value="{{ $verifikasi->nama_pemilik }}" required>
        </div>
        <div class="form-group">
            <label for="jenis_usaha">Jenis Usaha</label>
            <input type="text" name="jenis_usaha" id="jenis_usaha" class="form-control" value="{{ $verifikasi->jenis_usaha }}" required>
        </div>
        <div class="form-group">
            <label for="alamat_usaha">Alamat Usaha</label>
            <textarea name="alamat_usaha" id="alamat_usaha" class="form-control" required>{{ $verifikasi->alamat_usaha }}</textarea>
        </div>
        <!-- <div class="form-group">
            <label for="nib">NIB</label>
            <input type="text" name="nib" id="nib" class="form-control" value="{{ $verifikasi->nib }}" required>
        </div> -->
        <div class="form-group">
            <label for="no_hp_wa">No. HP/WA</label>
            <input type="text" name="no_hp_wa" id="no_hp_wa" class="form-control" value="{{ $verifikasi->no_hp_wa }}" required>
        </div>

        <div class="form-group">
    <label for="status">Status</label>
    <select name="status" id="status" class="form-control" required>
        <option value="Diterima" {{ $verifikasi->status == 'Diterima' ? 'selected' : '' }}>Diterima</option>
        <option value="Ditolak" {{ $verifikasi->status == 'Ditolak' ? 'selected' : '' }}>Ditolak</option>
    </select>
</div>

        

        <button type="submit" class="btn btn-primary">Perbarui</button>
    </form>
@endsection
