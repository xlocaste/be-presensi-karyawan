<?php

namespace App\Http\Controllers;

use App\Http\Requests\PresensiStoreRequest;
use App\Http\Requests\PresensiUpdateRequest;
use App\Http\Resources\PresensiResource;
use App\Models\Presensi;
use Carbon\Carbon;

class PresensiController extends Controller
{
    public function index()
    {
        $daftarPresensi = Presensi::with('karyawan')->get();

        return PresensiResource::collection($daftarPresensi);
    }

    public function store(PresensiStoreRequest $request)
    {
        $isKaryawanPresenced = Presensi::whereDate('waktu_presensi', Carbon::today())
             ->where('karyawan_id', $request->karyawan_id)
             ->count() > 0;

        if($isKaryawanPresenced) {
            return response()->json([
                'message' => 'Karyawan ini sudah dipresensi'
            ]);
        }

        $waktuPresensi = Carbon::createFromFormat('d/m/Y H:i:s', $request->waktu_presensi);

        $presensi = Presensi::create([
            'waktu_presensi'=>$waktuPresensi,
            'keterangan'=>$request->keterangan,
            'karyawan_id'=>$request->karyawan_id,
        ]);

        return (new PresensiResource($presensi))->additional([
            'message' => 'Data Berhasil di Masukkan',
        ]);
    }

    public function update(PresensiUpdateRequest $request, Presensi $presensi)
    {
        $presensi->update([
            'waktu_presensi'=>$request->waktu_presensi,
            'keterangan'=>$request->keterangan,
            'karyawan_id'=>$request->karyawan_id,
        ]);

        return (new PresensiResource($presensi))->additional([
            'message' => 'Data Berhasil di Edit',
        ]);
    }

    public function show($presensi)
    {
        $presensi = Presensi::findOrFail($presensi);

        return (new PresensiResource($presensi))->additional([
            'message' => 'Data Berhasil di Ambil'
        ]);
    }

    public function destroy(Presensi $presensi)
    {
        $presensi->delete();

        return response()->json([
            'message' => 'Data Berhasil di Hapus'
        ]);
    }
}
