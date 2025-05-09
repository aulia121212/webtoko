@extends('layouts.app')

@section('title', 'Profil Akun')

@section('contents')
    <hr />
    <div class="col-lg-8">
        <div class="card mb-4">
            <div class="card-body">
                {{-- Tampilkan Foto Toko --}}
                <div class="row mb-3">
                    <div class="col-sm-3">
                        <p class="mb-0">Foto Toko</p>
                    </div>
                    <div class="col-sm-9 text-center">
                        @if($shop->foto_toko)
                            <img src="{{ asset('storage/' . $shop->foto_toko) }}" class="rounded" width="150" alt="Foto Toko">
                        @else
                            <img src="{{ asset('default-profile.png') }}" class="rounded" width="150" alt="Foto Default">
                        @endif
                    </div>
                </div>
                <hr>

                {{-- Nama --}}
                <div class="row">
                    <div class="col-sm-3">
                        <p class="mb-0">Nama</p>
                    </div>
                    <div class="col-sm-9">
                        <p class="text-muted mb-0">{{ $user->name }}</p>
                    </div>
                </div>
                <hr>

                {{-- Email --}}
                <div class="row">
                    <div class="col-sm-3">
                        <p class="mb-0">Email</p>
                    </div>
                    <div class="col-sm-9">
                        <p class="text-muted mb-0">{{ $user->email }}</p>
                    </div>
                </div>
                <hr>

                {{-- Level --}}
                <div class="row">
                    <div class="col-sm-3">
                        <p class="mb-0">Level</p>
                    </div>
                    <div class="col-sm-9">
                        <p class="text-muted mb-0">{{ $user->level }}</p>
                    </div>
                </div>
                <hr>

                {{-- Form Upload Foto dan Link --}}
                <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT') <!-- Pastikan ini ada untuk mengubah metode menjadi PUT -->

                    {{-- Upload Foto Toko --}}
                    <div class="row mb-3">
                        <div class="col-sm-3">
                            <label for="foto_toko" class="mb-0">Ubah Foto Toko</label>
                        </div>
                        <div class="col-sm-9">
                            <input type="file" name="foto_toko" class="form-control mb-3">
                        </div>
                    </div>

                    {{-- Link WhatsApp --}}
                    <div class="row mb-3">
                        <div class="col-sm-3">
                            <label for="link_wa" class="mb-0">Link WhatsApp</label>
                        </div>
                        <div class="col-sm-9">
                            <input type="text" name="link_wa" class="form-control" value="{{ $shop->link_wa ?? '' }}" placeholder="Masukkan link WhatsApp">
                        </div>
                    </div>

                    {{-- Link Google Maps --}}
                    <div class="row mb-3">
                        <div class="col-sm-3">
                            <label for="link_gmaps" class="mb-0">Link Google Maps</label>
                        </div>
                        <div class="col-sm-9">
                            <input type="text" name="link_gmaps" class="form-control" value="{{ $shop->link_gmaps ?? '' }}" placeholder="Masukkan link Google Maps">
                        </div>
                    </div>

                   

                     {{-- Link Marketplace --}}
                     <div class="row mb-3">
                        <div class="col-sm-3">
                            <label for="link_marketplace" class="mb-0">Link Marketplace (Shopee/ Tokopedia/ Lazada) *pilih salah satu</label>
                        </div>
                        <div class="col-sm-9">
                            <input type="text" name="link_marketplace" class="form-control" value="{{ $shop->link_marketplace ?? '' }}" placeholder="Masukkan URL Marketplace">
                        </div>
                    </div>


                    {{-- Tombol Simpan --}}
                    <div class="row">
                        <div class="col-sm-9 offset-sm-3">
                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection