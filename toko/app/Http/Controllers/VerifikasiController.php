<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Verifikasi;
use Illuminate\Http\JsonResponse;
use App\Exports\VerifikasiExport;
use Maatwebsite\Excel\Facades\Excel;


class VerifikasiController extends Controller
{
    // Menampilkan daftar data verifikasi
    public function index(Request $request)
    {
        $search = $request->input('search');

        $verifikasiData = Verifikasi::query();

        if ($search) {
            $verifikasiData->where('nama_toko', 'like', "%$search%")
                ->orWhere('nama_pemilik', 'like', "%$search%")
                ->orWhere('jenis_usaha', 'like', "%$search%");
        }

        return view('verifikasi.index', ['verifikasiData' => $verifikasiData->get()]);
    }

    public function export()
{
    return Excel::download(new VerifikasiExport, 'data-verifikasi.xlsx');
}

    public function destroy($id)
{
    $verifikasi = Verifikasi::findOrFail($id);
    $verifikasi->delete();

    return redirect()->route('verifikasi.index')->with('success', 'Data berhasil dihapus.');
}

public function edit($id)
{
    $verifikasi = Verifikasi::findOrFail($id);
    return view('verifikasi.edit', compact('verifikasi'));
}

public function update(Request $request, $id)
{
    $verifikasi = Verifikasi::findOrFail($id);

    // Validasi data
    $request->validate([
        'nama_toko' => 'required|string|max:255',
        'nama_pemilik' => 'required|string|max:255',
        'jenis_usaha' => 'required|string|max:255',
        'alamat_usaha' => 'required|string',
        'no_hp_wa' => 'required|string',
        'status' => 'required|in:Pending,Diterima,Ditolak',
    ]);

    // Update data
    $verifikasi->update([
        'nama_toko' => $request->nama_toko,
        'nama_pemilik' => $request->nama_pemilik,
        'jenis_usaha' => $request->jenis_usaha,
        'alamat_usaha' => $request->alamat_usaha,
        'no_hp_wa' => $request->no_hp_wa,
        'status' => $request->status,
    ]);

    return redirect()->route('verifikasi.index')->with('success', 'Data berhasil diperbarui.');
}

public function show($id)
{
    $verifikasi = Verifikasi::findOrFail($id);
    return view('verifikasi.show', compact('verifikasi'));
}



// Menampilkan form tambah data verifikasi
public function create()
{
    return view('verifikasi.create');
}


    // Menyimpan data baru ke database
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama_toko' => 'required|string|max:255',
            'nama_pemilik' => 'required|string|max:255',
            'jenis_usaha' => 'required|string|max:255',
            'alamat_usaha' => 'required|string',
            'no_hp_wa' => 'required|string|max:55',
            'status' => 'required|in:Pending,Diterima,Ditolak',
        ]);

        $validatedData['nib'] = '-';


        Verifikasi::create($validatedData);

        return redirect()->route('verifikasi.index')->with('success', 'Data verifikasi berhasil ditambahkan!');
    }

    // Mengupdate status data verifikasi
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:Pending,Diterima,Ditolak',
        ]);

        $verifikasi = Verifikasi::findOrFail($id);
        $verifikasi->update(['status' => $request->input('status')]);

        return redirect()->route('verifikasi.index')->with('success', 'Status berhasil diperbarui!');
    }

    // API untuk mobile app (JSON Response)
    public function storeFromMobile(Request $request): JsonResponse
    {
        try {
            $validatedData = $request->validate([
                'nama_toko' => 'required|string|max:255',
                'nama_pemilik' => 'required|string|max:255',
                'jenis_usaha' => 'required|string|max:255',
                'alamat_usaha' => 'required|string',
                'no_hp_wa' => 'required|string|max:50',
            ]);

            $validatedData['nib'] = '-'; // agar tetap valid


            $verifikasi = Verifikasi::create($validatedData);

            return response()->json([
                'success' => true,
                'message' => 'Data verifikasi berhasil disimpan',
                'data' => $verifikasi,
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
            ], 500);
        }
    }
}