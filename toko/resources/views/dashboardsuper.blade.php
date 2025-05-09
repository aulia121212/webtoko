@extends('layouts.app')

@section('title', 'Dashboard - UMKM XPLORE')

<?php
$items = [
    [
        'title' => 'Jumlah Toko Terdaftar',  // Menambahkan judul untuk jumlah toko
        'value' => $totalShops,  // Menampilkan jumlah toko
        'icon' => 'fa-store',  // Ikon untuk toko
    ],
    [
        'title' => 'Jumlah Produk',  // Menambahkan judul untuk jumlah produk
        'value' => $totalProduct,  // Menampilkan jumlah produk
        'icon' => 'fa-box-open',  // Ikon untuk produk
    ],
   
];
?>

@section('contents')
<hr />
<div class="col-lg-12">
<div class="row">
    @if(count($items) > 0)
        @foreach($items as $item)
        <div class="col-xl-4 col-md-6 mb-4">
          <div class="card border-left-success shadow h-100 py-2">
            <div class="card-body">
              <div class="row no-gutters align-items-center">
                <div class="col-8"> 
                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                        {{ $item['title'] }}
                    </div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                        {{ $item['value'] }}
                    </div>
                </div>
                <div class="col-4"> 
                    <i class="fas {{ $item['icon'] }} fa-2x text-gray-300"></i>
                </div>
              </div>
            </div>
          </div>
        </div>
        @endforeach
    @endif
</div>
</div>
@endsection
