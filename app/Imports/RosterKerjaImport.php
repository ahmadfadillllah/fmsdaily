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
        return new RosterKerja([
            'uuid' => (string) Uuid::uuid4()->toString(),
            'statusenabled' => true,
            'nik'     => $row[3],
            'unit_kerja'    => $row[2],
            'tahun'    => $this->tahun,
            'bulan'    => $this->bulan,
            '1'    => $row[5],
            '2'    => $row[6],
            '3'    => $row[7],
            '4'    => $row[8],
            '5'    => $row[9],
            '6'    => $row[10],
            '7'    => $row[11],
            '8'    => $row[12],
            '9'    => $row[13],
            '10'    => $row[14],
            '11'    => $row[15],
            '12'    => $row[16],
            '13'    => $row[17],
            '14'    => $row[18],
            '15'    => $row[19],
            '16'    => $row[20],
            '17'    => $row[21],
            '18'    => $row[22],
            '19'    => $row[23],
            '20'    => $row[24],
            '21'    => $row[25],
            '22'    => $row[26],
            '23'    => $row[27],
            '24'    => $row[28],
            '25'    => $row[29],
            '26'    => $row[30],
            '27'    => $row[31],
            '28'    => $row[32],
            '29'    => $row[33],
            '30'    => $row[34],
            '31'    => $row[35],
        ]);
    }
}
