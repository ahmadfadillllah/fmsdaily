<?php

namespace App\Imports;

use App\Models\RosterKerja;
use Maatwebsite\Excel\Concerns\ToModel;
use Ramsey\Uuid\Uuid;

class RosterKerjaImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */

    protected $tahun;
    protected $bulan;

    // Konstruktor untuk menerima tahun dan bulan
    public function __construct($tahun, $bulan)
    {
        $this->tahun = $tahun;
        $this->bulan = $bulan;
    }
    public function model(array $row)
    {
        return RosterKerja::updateOrCreate(
            [
                'nik' => $row[3], // Kondisi pencarian berdasarkan 'nik'
                'tahun' => (string)$this->tahun, // Kondisi pencarian berdasarkan 'tahun'
                'bulan' => (string)$this->bulan // Kondisi pencarian berdasarkan 'tahun'
            ],
            [
            'uuid' => (string) Uuid::uuid4()->toString(),
            'statusenabled' => true,
            'nik'     => $row[3],
            'unit_kerja'    => $row[2],
            'tahun'    => (string)$this->tahun,
            'bulan'    => (string)$this->bulan,
            '1'    => isset($row[5]) ? $row[5] : null,
            '2'    => isset($row[6]) ? $row[6] : null,
            '3'    => isset($row[7]) ? $row[7] : null,
            '4'    => isset($row[8]) ? $row[8] : null,
            '5'    => isset($row[9]) ? $row[9] : null,
            '6'    => isset($row[10]) ? $row[10] : null,
            '7'    => isset($row[11]) ? $row[11] : null,
            '8'    => isset($row[12]) ? $row[12] : null,
            '9'    => isset($row[13]) ? $row[13] : null,
            '10'    => isset($row[14]) ? $row[14] : null,
            '11'    => isset($row[15]) ? $row[15] : null,
            '12'    => isset($row[16]) ? $row[16] : null,
            '13'    => isset($row[17]) ? $row[17] : null,
            '14'    => isset($row[18]) ? $row[18] : null,
            '15'    => isset($row[19]) ? $row[19] : null,
            '16'    => isset($row[20]) ? $row[20] : null,
            '17'    => isset($row[21]) ? $row[21] : null,
            '18'    => isset($row[22]) ? $row[22] : null,
            '19'    => isset($row[23]) ? $row[23] : null,
            '20'    => isset($row[24]) ? $row[24] : null,
            '21'    => isset($row[25]) ? $row[25] : null,
            '22'    => isset($row[26]) ? $row[26] : null,
            '23'    => isset($row[27]) ? $row[27] : null,
            '24'    => isset($row[28]) ? $row[28] : null,
            '25'    => isset($row[29]) ? $row[29] : null,
            '26'    => isset($row[30]) ? $row[30] : null,
            '27'    => isset($row[31]) ? $row[31] : null,
            '28'    => isset($row[32]) ? $row[32] : null,
            '29'    => isset($row[33]) ? $row[33] : null,
            '30'    => isset($row[34]) ? $row[34] : null,
            '31'    => isset($row[35]) ? $row[35] : null,
        ]);
    }
}
