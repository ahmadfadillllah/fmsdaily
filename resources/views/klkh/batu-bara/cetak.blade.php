<!DOCTYPE html>
<html lang="id">
@php
    use Carbon\Carbon;
@endphp
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pemeriksaan KKH & KLKH Area Batu Bara</title>
    <style>
        @page {
            size: A4;
            margin: 5mm;
        }

        body {
            font-family: Arial, sans-serif;
            /* line-height: 1.6; */
            font-size: 12px;
        }

        .container {
            width: 100%;
        }

        h1 {
            text-align: center;
            font-size: 20px;
            margin-bottom: 20px;
        }

        h2 {
            text-align: center;
            font-size: 20px;
            margin-bottom: 15px;
        }

        h5 {
            margin: 1px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th,
        td {
            border: 1px solid #000;
            padding: 3px;
            /*text-align: center;*/
        }

        th {
            background-color: #D0CECE;
            text-align: center;
        }



        h3 {
            font-size: 18px;
            margin-bottom: 10px;
        }

        .point-table {
            margin-top: 20px;
        }

        tr th {
            text-align: left;
        }

        .noborder {
            border-top-color: white;
            border-bottom: none;
            border-left: none;
            border-right: none;
        }

        .nobg{
            background-color: white;
        }

        .center {
            text-align: center;
        }

        .box {
            display: flex;
            justify-content: space-between;
        }

        .box-vcenter {
            display: flex;
            justify-content: space-between;
            align-items: center;
            align-content: center;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="box-vcenter">
            <img src="{{ asset('dashboard/assets') }}/images/logo-full.png" width="240px">
            <P>FM-PRD-72/00/12/03/24</P>
        </div>
        <hr>
        <h1>Pemeriksaan Kesiapan Kerja Harian & Kelayakan Lingkungan Kerja Harian (KLKH) Area Batubara</h1>
        <table class="point-table">
            <thead>
                <tr>
                    <th class="noborder nobg">PIT</th>
                    <th class="noborder nobg">: {{ $bb->pit }}</th>
                    <th colspan="" class="noborder nobg">Shift</th>
                    <th colspan="3" class="noborder nobg">: {{ $bb->shift }}</th>
                </tr>
                <tr>
                    <th class="noborder nobg">Hari/Tanggal</th>
                    <th class="noborder nobg">: {{ Carbon::parse($bb->date)->locale('id')->isoFormat('dddd, D MMMM YYYY') }}</th>
                    <th class="noborder nobg" colspan="">Jam</th>
                    <th class="noborder nobg" colspan="3">: {{ Carbon::parse($bb->time)->locale('id')->isoFormat('HH:mm') }}</th>
                </tr>
                <tr>
                    <th class="center" rowspan="2">No</th>
                    <th class="center" rowspan="2">Point Yang Diperiksa</th>
                    <th class="center" colspan="3" style="text-align: center;">Cek</th>
                    <th class="center" rowspan="2">Keterangan</th>
                </tr>
                <tr>
                    <th class="center">Ya</th>
                    <th class="center">Tidak</th>
                    <th class="center">N/A</th>
                </tr>
                <tr>
                    <th class="center">A</th>
                    <th>Coal Loading Point</th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="center">1</td>
                    <td>Lokasi loading point tidak dibawah batuan menggantung</td>
                    <td>{{ $bb->loading_point_check == 'true' ? "✔️" : "" }}</td>
                    <td>{{ $bb->loading_point_check == 'false' ? "✔️" : "" }}</td>
                    <td>{{ $bb->loading_point_check == 'n/a' ? "✔️" : "" }}</td>
                    <td>{{ $bb->loading_point_note }}</td>
                </tr>
                <tr>
                    <td class="center">2</td>
                    <td>Permukaan front aman dari bahaya terjatuh atau terperosok</td>
                    <td>{{ $bb->permukaan_front_check == 'true' ? "✔️" : "" }}</td>
                    <td>{{ $bb->permukaan_front_check == 'false' ? "✔️" : "" }}</td>
                    <td>{{ $bb->permukaan_front_check == 'n/a' ? "✔️" : "" }}</td>
                    <td>{{ $bb->permukaan_front_note }}</td>
                </tr>
                <tr>
                    <td class="center">3</td>
                    <td>Tinggi dan lebar bench kerja sesuai dengan standar</td>
                    <td>{{ $bb->tinggi_bench_check == 'true' ? "✔️" : "" }}</td>
                    <td>{{ $bb->tinggi_bench_check == 'false' ? "✔️" : "" }}</td>
                    <td>{{ $bb->tinggi_bench_check == 'n/a' ? "✔️" : "" }}</td>
                    <td>{{ $bb->tinggi_bench_note }}</td>
                <tr>
                    <td class="center">4</td>
                    <td>Lebar loading point sesuai dengan standar pada spesifikasi unit loading</td>
                    <td>{{ $bb->lebar_loading_check == 'true' ? "✔️" : "" }}</td>
                    <td>{{ $bb->lebar_loading_check == 'false' ? "✔️" : "" }}</td>
                    <td>{{ $bb->lebar_loading_check == 'n/a' ? "✔️" : "" }}</td>
                    <td>{{ $bb->lebar_loading_note }}</td>
                </tr>
                <tr>
                    <td class="center">5</td>
                    <td>Terdapat drainase atau paritan ke arah sump</td>
                    <td>{{ $bb->drainase_check == 'true' ? "✔️" : "" }}</td>
                    <td>{{ $bb->drainase_check == 'false' ? "✔️" : "" }}</td>
                    <td>{{ $bb->drainase_check == 'n/a' ? "✔️" : "" }}</td>
                    <td>{{ $bb->drainase_note }}</td>
                </tr>
                <tr>
                    <td class="center">6</td>
                    <td>Penempatan unit loading sesuai dengan volume Batubara</td>
                    <td>{{ $bb->penempatan_unit_check == 'true' ? "✔️" : "" }}</td>
                    <td>{{ $bb->penempatan_unit_check == 'false' ? "✔️" : "" }}</td>
                    <td>{{ $bb->penempatan_unit_check == 'n/a' ? "✔️" : "" }}</td>
                    <td>{{ $bb->penempatan_unit_note }}</td>
                </tr>
                <tr>
                    <td class="center">7</td>
                    <td>Terdapat pelabelan seam batubara di unit (hauler dan loader)</td>
                    <td>{{ $bb->pelabelan_seam_check == 'true' ? "✔️" : "" }}</td>
                    <td>{{ $bb->pelabelan_seam_check == 'false' ? "✔️" : "" }}</td>
                    <td>{{ $bb->pelabelan_seam_check == 'n/a' ? "✔️" : "" }}</td>
                    <td>{{ $bb->pelabelan_seam_note }}</td>
                </tr>
                <tr>
                    <td class="center">8</td>
                    <td>Unit yang bekerja memiliki lampu dengan intensitas cahaya yang tinggi
                    </td>
                    <td>{{ $bb->lampu_unit_check == 'true' ? "✔️" : "" }}</td>
                    <td>{{ $bb->lampu_unit_check == 'false' ? "✔️" : "" }}</td>
                    <td>{{ $bb->lampu_unit_check == 'n/a' ? "✔️" : "" }}</td>
                    <td>{{ $bb->lampu_unit_note }}</td>
                </tr>
                <tr>
                    <td class="center">9</td>
                    <td>Unit yang bekerja bersih dan sudah dicuci</td>
                    <td>{{ $bb->unit_bersih_check == 'true' ? "✔️" : "" }}</td>
                    <td>{{ $bb->unit_bersih_check == 'false' ? "✔️" : "" }}</td>
                    <td>{{ $bb->unit_bersih_check == 'n/a' ? "✔️" : "" }}</td>
                    <td>{{ $bb->unit_bersih_note }}</td>
                </tr>
                <tr>
                    <td class="center">10</td>
                    <td>Penerangan area kerja mencukupi dan terarah untuk pekerjaan malam hari (20-50 lux)</td>
                    <td>{{ $bb->penerangan_area_check == 'true' ? "✔️" : "" }}</td>
                    <td>{{ $bb->penerangan_area_check == 'false' ? "✔️" : "" }}</td>
                    <td>{{ $bb->penerangan_area_check == 'n/a' ? "✔️" : "" }}</td>
                    <td>{{ $bb->penerangan_area_note }}</td>
                </tr>
                <tr>
                    <td class="center">11</td>
                    <td>Housekeeping baik (bebas sampah)</td>
                    <td>{{ $bb->housekeeping_check == 'true' ? "✔️" : "" }}</td>
                    <td>{{ $bb->housekeeping_check == 'false' ? "✔️" : "" }}</td>
                    <td>{{ $bb->housekeeping_check == 'n/a' ? "✔️" : "" }}</td>
                    <td>{{ $bb->housekeeping_note }}</td>
                </tr>
                <tr>
                    <td class="center">12</td>
                    <td>Telah dilakukan pengukuran roof Batubara oleh survey</td>
                    <td>{{ $bb->pengukuran_roof_check == 'true' ? "✔️" : "" }}</td>
                    <td>{{ $bb->pengukuran_roof_check == 'false' ? "✔️" : "" }}</td>
                    <td>{{ $bb->pengukuran_roof_check == 'n/a' ? "✔️" : "" }}</td>
                    <td>{{ $bb->pengukuran_roof_note }}</td>
                </tr>
                <tr>
                    <td class="center">13</td>
                    <td>Telah dilakukan cleaning pada Batubara dan Batubara bebas kontaminan</td>
                    <td>{{ $bb->cleaning_batubara_check == 'true' ? "✔️" : "" }}</td>
                    <td>{{ $bb->cleaning_batubara_check == 'false' ? "✔️" : "" }}</td>
                    <td>{{ $bb->cleaning_batubara_check == 'n/a' ? "✔️" : "" }}</td>
                    <td>{{ $bb->cleaning_batubara_note }}</td>
                </tr>
                <tr>
                    <td class="center">14</td>
                    <td>Tidak terdapat genangan air pada Batubara</td>
                    <td>{{ $bb->genangan_air_check == 'true' ? "✔️" : "" }}</td>
                    <td>{{ $bb->genangan_air_check == 'false' ? "✔️" : "" }}</td>
                    <td>{{ $bb->genangan_air_check == 'n/a' ? "✔️" : "" }}</td>
                    <td>{{ $bb->genangan_air_note }}</td>
                </tr>
                <tr>
                    <td class="center">15</td>
                    <td>Tidak terdapat big coal</td>
                    <td>{{ $bb->big_coal_check == 'true' ? "✔️" : "" }}</td>
                    <td>{{ $bb->big_coal_check == 'false' ? "✔️" : "" }}</td>
                    <td>{{ $bb->big_coal_check == 'n/a' ? "✔️" : "" }}</td>
                    <td>{{ $bb->big_coal_note }}</td>
                </tr>
                <tr>
                    <td class="center">16</td>
                    <td>Stock material cukup</td>
                    <td>{{ $bb->stock_material_check == 'true' ? "✔️" : "" }}</td>
                    <td>{{ $bb->stock_material_check == 'false' ? "✔️" : "" }}</td>
                    <td>{{ $bb->stock_material_check == 'n/a' ? "✔️" : "" }}</td>
                    <td>{{ $bb->stock_material_note }}</td>
                </tr>
                <th class="center">B</th>
                <th>Jalan Tambang</th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                </tr>
                <tr>
                    <td class="center">1</td>
                    <td>Lebar jalan angkut 3.5 x lebar unit terbesar</td>
                    <td>{{ $bb->lebar_jalan_angkut_check == 'true' ? "✔️" : "" }}</td>
                    <td>{{ $bb->lebar_jalan_angkut_check == 'false' ? "✔️" : "" }}</td>
                    <td>{{ $bb->lebar_jalan_angkut_check == 'n/a' ? "✔️" : "" }}</td>
                    <td>{{ $bb->lebar_jalan_angkut_note }}</td>
                </tr>
                <tr>
                    <td class="center">2</td>
                    <td>Lebar jalan tikungan 4 x lebar unit terbesar</td>
                    <td>{{ $bb->lebar_jalan_tikungan_check == 'true' ? "✔️" : "" }}</td>
                    <td>{{ $bb->lebar_jalan_tikungan_check == 'false' ? "✔️" : "" }}</td>
                    <td>{{ $bb->lebar_jalan_tikungan_check == 'n/a' ? "✔️" : "" }}</td>
                    <td>{{ $bb->lebar_jalan_tikungan_note }}</td>
                </tr>
                <tr>
                    <td class="center">3</td>
                    <td>Super elevasi sesuai standar</td>
                    <td>{{ $bb->super_elevasi_check == 'true' ? "✔️" : "" }}</td>
                    <td>{{ $bb->super_elevasi_check == 'false' ? "✔️" : "" }}</td>
                    <td>{{ $bb->super_elevasi_check == 'n/a' ? "✔️" : "" }}</td>
                    <td>{{ $bb->super_elevasi_note }}</td>
                </tr>
                <tr>
                    <td class="center">4</td>
                    <td>Tersedia safety berm pada areal yang mempunyai beda tinggi lebih dari 1 meter</td>
                    <td>{{ $bb->safety_berm_check == 'true' ? "✔️" : "" }}</td>
                    <td>{{ $bb->safety_berm_check == 'false' ? "✔️" : "" }}</td>
                    <td>{{ $bb->safety_berm_check == 'n/a' ? "✔️" : "" }}</td>
                    <td>{{ $bb->safety_berm_note }}</td>
                </tr>
                <tr>
                    <td class="center">5</td>
                    <td>Tinggi tanggul minimal 2/3 tinggi ban unit terbesar</td>
                    <td>{{ $bb->tinggi_tanggul_check == 'true' ? "✔️" : "" }}</td>
                    <td>{{ $bb->tinggi_tanggul_check == 'false' ? "✔️" : "" }}</td>
                    <td>{{ $bb->tinggi_tanggul_check == 'n/a' ? "✔️" : "" }}</td>
                    <td>{{ $bb->tinggi_tanggul_note }}</td>
                </tr>
                <tr>
                    <td class="center">6</td>
                    <td>Terdapat safety post pada tanggul jalan</td>
                    <td>{{ $bb->safety_post_check == 'true' ? "✔️" : "" }}</td>
                    <td>{{ $bb->safety_post_check == 'false' ? "✔️" : "" }}</td>
                    <td>{{ $bb->safety_post_check == 'n/a' ? "✔️" : "" }}</td>
                    <td>{{ $bb->safety_post_note }}</td>
                </tr>
                <tr>
                    <td class="center">7</td>
                    <td>Tersedia drainase dan tidak ada genangan air di jalan angkut</td>
                    <td>{{ $bb->drainase_genangan_air_check == 'true' ? "✔️" : "" }}</td>
                    <td>{{ $bb->drainase_genangan_air_check == 'false' ? "✔️" : "" }}</td>
                    <td>{{ $bb->drainase_genangan_air_check == 'n/a' ? "✔️" : "" }}</td>
                    <td>{{ $bb->drainase_genangan_air_note }}</td>
                </tr>
                <tr>
                    <td class="center">8</td>
                    <td>Terdapat median jalan pada tikungan yang sudutnya lebih besar dari 60°</td>
                    <td>{{ $bb->median_jalan_check == 'true' ? "✔️" : "" }}</td>
                    <td>{{ $bb->median_jalan_check == 'false' ? "✔️" : "" }}</td>
                    <td>{{ $bb->median_jalan_check == 'n/a' ? "✔️" : "" }}</td>
                    <td>{{ $bb->median_jalan_note }}</td>
                </tr>
            </tbody>
        </table>
        Catatan:
        <p class="mb-0">{!! $bb->additional_notes !!}</p>
        <div class="box">
            <div class="sign">
                <p>Foremen</p>
                @if ($bb->verified_foreman != null)
                    <h5>{!! $bb->verified_foreman !!}</h5>
                    <h5>{{ $bb->nama_foreman ? $bb->nama_foreman : '.......................' }}</h5>
                @endif
            </div>
            <div class="sign">
                <p>Supervisor</p>
                @if ($bb->verified_supervisor != null)
                    <h5>{!! $bb->verified_supervisor !!}</h5>
                    <h5>{{ $bb->nama_supervisor ? $bb->nama_supervisor : '.......................' }}</h5>
                @endif
            </div>
            <div class="sign">
                <p>Superintendent</p>
                @if ($bb->verified_superintendent != null)
                    <h5>{!! $bb->verified_superintendent !!}</h5>
                    <h5>{{ $bb->nama_superintendent ? $bb->nama_superintendent : '.......................' }}</h5>
                @endif
            </div>
        </div>
    </div>
</body>
<script>
    window.print();
</script>

</html>
