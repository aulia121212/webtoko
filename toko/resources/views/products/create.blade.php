@extends('layouts.app')

@section('title', 'Tambah Produk')

@section('contents')
    <hr />
    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row mb-3">
            <div class="col">
                <label class="form-label" for="name">Nama</label>
                <input type="text" name="name" class="form-control" placeholder="Nama Produk">
                @error('name')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="col">
                <label class="form-label" for="price">Harga</label>
                <input type="number" name="price" class="form-control" placeholder="Harga">
                @error('price')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="row mb-3">
            <div class="col">
                <label class="form-label" for="description">Deskripsi</label>
                <textarea class="form-control" name="description" placeholder="Deskripsi"></textarea>
                @error('description')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="row mb-3">
            <div class="col">
                <label class="form-label" for="image">Gambar</label>
                <input type="file" name="image" class="form-control" placeholder="Gambar">
                @error('image')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="row">
            <div class="d-grid">
                <button type="submit" class="btn btn-success">Tambah</button>
            </div>
        </div>
    </form>
@endsection
