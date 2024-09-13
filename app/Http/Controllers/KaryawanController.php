<?php

namespace App\Http\Controllers;

use App\Http\Requests\KaryawanStoreRequest;
use App\Http\Requests\KaryawanUpdateRequest;
use App\Http\Resources\KaryawanResource;
use App\Models\Karyawan;

class KaryawanController extends Controller
{
    public function index()
    {
        $daftarKaryawan = Karyawan::get();

        return KaryawanResource::collection($daftarKaryawan);
    }

    public function store(KaryawanStoreRequest $request)
    {
        $karyawan = Karyawan::create([
            'nama'=>$request->nama,
            'divisi'=>$request->divisi,
            'kelamin'=>$request->kelamin,
        ]);

        return (new KaryawanResource($karyawan))->additional([
            'message' => 'Data Berhasil di Masukkan',
        ]);
    }

    public function update(KaryawanUpdateRequest $request, Karyawan $karyawan)
    {
        $karyawan->update([
            'nama'=>$request->nama,
            'divisi'=>$request->divisi,
            'kelamin'=>$request->kelamin,
        ]);

        return (new KaryawanResource($karyawan))->additional([
            'message' => 'Data Berhasil di Edit',
        ]);
    }

    public function show($karyawan)
    {
        $karyawan = Karyawan::findOrFail($karyawan);

        return (new KaryawanResource($karyawan))->additional([
            'message' => 'Data Berhasil di Ambil'
        ]);
    }

    public function destroy(Karyawan $karyawan)
    {
        $karyawan->delete();

        return response()->json([
            'message' => 'Data Berhasil di Hapus'
        ]);
    }
}
