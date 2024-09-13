<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PresensiResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this -> id,
            'waktu_presensi' => $this -> waktu_presensi,
            'keterangan' => $this -> keterangan,
            'karyawan_id' => $this -> karyawan_id,
            'created_at' => $this -> created_at,
            'updated_at' => $this -> updated_at,

            'karyawan' => new KaryawanResource($this->whenLoaded('karyawan'))
        ];
    }
}
