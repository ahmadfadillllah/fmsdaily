<!DOCTYPE html>
<html lang="id">
@php
    use Carbon\Carbon;
@endphp
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pemeriksaan KKH & KLKH Area Disposal/Dumping Point</title>
    <link rel="stylesheet" href="{{ asset('dashboard/assets') }}/fonts/fontawesome.css">
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
            margin-bottom: 5px;
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
            margin-top: 5px;
        }

        tr th {
            text-align: left;
        }

        .kanan {
            text-align: right;
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

@foreach ($dp as $disposal)
<body>
    <div class="container">
        <table class="point-table">
            <thead>
                <tr>
                    <th class="noborder nobg" style="padding: 0px'margin-bttom:0px"><img src="{{ public_path('dashboard/assets/images/logo-full.png') }}" width="240px"></th>
                    <th colspan="5" class="noborder nobg kanan"><p style="margin: 0;">FM-PRD-52/01/18/10/22</p></th>
                </tr>
            </thead>
        </table>
        <div class="box-vcenter" style="display: flex; align-items: center; justify-content: space-between;">


        </div>
        <hr>
        <h1>Pemeriksaan Kesiapan Kerja Harian & Kelayakan Lingkungan Kerja Harian (KLKH) Departemen Produksi Area Disposal/Dumping Point</h1>
        <table class="point-table">
            <thead>
                <tr>
                    <th class="noborder nobg">PIT</th>
                    <th class="noborder nobg">: {{ $disposal->pit }}</th>
                    <th colspan="" class="noborder nobg">Shift</th>
                    <th colspan="3" class="noborder nobg">: {{ $disposal->shift }}</th>
                </tr>
                <tr>
                    <th class="noborder nobg">Hari/Tanggal</th>
                    <th class="noborder nobg">: {{ Carbon::parse($disposal->date)->locale('id')->isoFormat('dddd, D MMMM YYYY') }}</th>
                    <th class="noborder nobg" colspan="">Jam</th>
                    <th class="noborder nobg" colspan="3">: {{ Carbon::parse($disposal->time)->locale('id')->isoFormat('HH:mm') }}</th>
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
            </thead>
            <tbody>
                <tr>
                    <td class="center">1</td>
                    <td>Lebar dumping point 2x (lebar unit terbesar + turn radius) x N Load</td>
                    <td class="center">{!! $disposal->dumping_point_1 == 'true' ? '<img src="' . public_path('check.png') . '">' : '' !!}</td>
                    <td class="center">{!! $disposal->dumping_point_1 == 'false' ? '<img src="' . public_path('check.png') . '">' : "" !!}</td>
                    <td class="center">{!! $disposal->dumping_point_1 == 'n/a' ? '<img src="' . public_path('check.png') . '">' : "" !!}</td>
                    <td>{!! $disposal->dumping_point_1_note !!}</td>
                </tr>
                <tr>
                    <td class="center">2</td>
                    <td>Adanya patok cek elevasi</td>
                    <td class="center">{!! $disposal->dumping_point_2 == 'true' ? '<img src="' . public_path('check.png') . '">' : "" !!}</td>
                    <td class="center">{!! $disposal->dumping_point_2 == 'false' ? '<img src="' . public_path('check.png') . '">' : "" !!}</td>
                    <td class="center">{!! $disposal->dumping_point_2 == 'n/a' ? '<img src="' . public_path('check.png') . '">' : "" !!}</td>
                    <td>{!! $disposal->dumping_point_2_note !!}</td>
                </tr>
                <tr>
                    <td class="center">3</td>
                    <td>Tinggi tanggul dumpingan atau dump/bud wall 3/4 tinggi ban unit terbesar</td>
                    <td class="center">{!! $disposal->dumping_point_3 == 'true' ? '<img src="' . public_path('check.png') . '">' : "" !!}</td>
                    <td class="center">{!! $disposal->dumping_point_3 == 'false' ? '<img src="' . public_path('check.png') . '">' : "" !!}</td>
                    <td class="center">{!! $disposal->dumping_point_3 == 'n/a' ? '<img src="' . public_path('check.png') . '">' : "" !!}</td>
                    <td>{!! $disposal->dumping_point_3_note !!}</td>
                <tr>
                    <td class="center">4</td>
                    <td>Kondisi permukaan lantai dumping rata dan permukaan tanah tidak lembek dan tidak bergelombang</td>
                    <td class="center">{!! $disposal->dumping_point_4 == 'true' ? '<img src="' . public_path('check.png') . '">' : "" !!}</td>
                    <td class="center">{!! $disposal->dumping_point_4 == 'false' ? '<img src="' . public_path('check.png') . '">' : "" !!}</td>
                    <td class="center">{!! $disposal->dumping_point_4 == 'n/a' ? '<img src="' . public_path('check.png') . '">' : "" !!}</td>
                    <td>{!! $disposal->dumping_point_4_note !!}</td>
                </tr>
                <tr>
                    <td class="center">5</td>
                    <td>Tidak ada genangan air di lokasi dumping</td>
                    <td class="center">{!! $disposal->dumping_point_5 == 'true' ? '<img src="' . public_path('check.png') . '">' : "" !!}</td>
                    <td class="center">{!! $disposal->dumping_point_5 == 'false' ? '<img src="' . public_path('check.png') . '">' : "" !!}</td>
                    <td class="center">{!! $disposal->dumping_point_5 == 'n/a' ? '<img src="' . public_path('check.png') . '">' : "" !!}</td>
                    <td>{!! $disposal->dumping_point_5_note !!}</td>
                </tr>
                <tr>
                    <td class="center">6</td>
                    <td>Terdapat unit support bulldozer di lokasi dumping</td>
                    <td class="center">{!! $disposal->dumping_point_6 == 'true' ? '<img src="' . public_path('check.png') . '">' : "" !!}</td>
                    <td class="center">{!! $disposal->dumping_point_6 == 'false' ? '<img src="' . public_path('check.png') . '">' : "" !!}</td>
                    <td class="center">{!! $disposal->dumping_point_6 == 'n/a' ? '<img src="' . public_path('check.png') . '">' : "" !!}</td>
                    <td>{!! $disposal->dumping_point_6_note !!}</td>
                </tr>
                <tr>
                    <td class="center">7</td>
                    <td>Rambu atau papan informasi memadai</td>
                    <td class="center">{!! $disposal->dumping_point_7 == 'true' ? '<img src="' . public_path('check.png') . '">' : "" !!}</td>
                    <td class="center">{!! $disposal->dumping_point_7 == 'false' ? '<img src="' . public_path('check.png') . '">' : "" !!}</td>
                    <td class="center">{!! $disposal->dumping_point_7 == 'n/a' ? '<img src="' . public_path('check.png') . '">' : "" !!}</td>
                    <td>{!! $disposal->dumping_point_7_note !!}</td>
                </tr>
                <tr>
                    <td class="center">8</td>
                    <td>Tersedia lampu penerangan untuk pekerjaan malam hari</td>
                    <td class="center">{!! $disposal->dumping_point_8 == 'true' ? '<img src="' . public_path('check.png') . '">' : "" !!}</td>
                    <td class="center">{!! $disposal->dumping_point_8 == 'false' ? '<img src="' . public_path('check.png') . '">' : "" !!}</td>
                    <td class="center">{!! $disposal->dumping_point_8 == 'n/a' ? '<img src="' . public_path('check.png') . '">' : "" !!}</td>
                    <td>{!! $disposal->dumping_point_8_note !!}</td>
                </tr>
                <tr>
                    <td class="center">9</td>
                    <td>Pengendalian debu sudah dilakukan dengan baik (penyiraman terjadwal dan jumlahnya mencukupi)</td>
                    <td class="center">{!! $disposal->dumping_point_9 == 'true' ? '<img src="' . public_path('check.png') . '">' : "" !!}</td>
                    <td class="center">{!! $disposal->dumping_point_9 == 'false' ? '<img src="' . public_path('check.png') . '">' : "" !!}</td>
                    <td class="center">{!! $disposal->dumping_point_9 == 'n/a' ? '<img src="' . public_path('check.png') . '">' : "" !!}</td>
                    <td>{!! $disposal->dumping_point_9_note !!}</td>
                </tr>
                <tr>
                    <td class="center">10</td>
                    <td>Frame final disposal rapi dan sesuai desain (dimensi slope sesuai dengan standar)</td>
                    <td class="center">{!! $disposal->dumping_point_10 == 'true' ? '<img src="' . public_path('check.png') . '">' : "" !!}</td>
                    <td class="center">{!! $disposal->dumping_point_10 == 'false' ? '<img src="' . public_path('check.png') . '">' : "" !!}</td>
                    <td class="center">{!! $disposal->dumping_point_10 == 'n/a' ? '<img src="' . public_path('check.png') . '">' : "" !!}</td>
                    <td>{!! $disposal->dumping_point_10_note !!}</td>
                </tr>
                <tr>
                    <td class="center">11</td>
                    <td>Terdapat pondok dump man</td>
                    <td class="center">{!! $disposal->dumping_point_11 == 'true' ? '<img src="' . public_path('check.png') . '">' : "" !!}</td>
                    <td class="center">{!! $disposal->dumping_point_11 == 'false' ? '<img src="' . public_path('check.png') . '">' : "" !!}</td>
                    <td class="center">{!! $disposal->dumping_point_11 == 'n/a' ? '<img src="' . public_path('check.png') . '">' : "" !!}</td>
                    <td>{!! $disposal->dumping_point_11_note !!}</td>
                </tr>
                <tr>
                    <td class="center">12</td>
                    <td>Terdapat bendera merah dan hijau untuk penunjuk dumping dan informasi lokasi bahaya untuk dumping</td>
                    <td class="center">{!! $disposal->dumping_point_12 == 'true' ? '<img src="' . public_path('check.png') . '">' : "" !!}</td>
                    <td class="center">{!! $disposal->dumping_point_12 == 'false' ? '<img src="' . public_path('check.png') . '">' : "" !!}</td>
                    <td class="center">{!! $disposal->dumping_point_12 == 'n/a' ? '<img src="' . public_path('check.png') . '">' : "" !!}</td>
                    <td>{!! $disposal->dumping_point_12_note !!}</td>
                </tr>
                <tr>
                    <td class="center">13</td>
                    <td>Housekeeping terjaga (disposal rapi dari tumpukan material yang belum di- spreading)</td>
                    <td class="center">{!! $disposal->dumping_point_13 == 'true' ? '<img src="' . public_path('check.png') . '">' : "" !!}</td>
                    <td class="center">{!! $disposal->dumping_point_13 == 'false' ? '<img src="' . public_path('check.png') . '">' : "" !!}</td>
                    <td class="center">{!! $disposal->dumping_point_13 == 'n/a' ? '<img src="' . public_path('check.png') . '">' : "" !!}</td>
                    <td>{!! $disposal->dumping_point_13_note !!}</td>
                </tr>
                <tr>
                    <td class="center">14</td>
                    <td>Alokasi material di disposal sesuai dengan rencana</td>
                    <td class="center">{!! $disposal->dumping_point_14 == 'true' ? '<img src="' . public_path('check.png') . '">' : "" !!}</td>
                    <td class="center">{!! $disposal->dumping_point_14 == 'false' ? '<img src="' . public_path('check.png') . '">' : "" !!}</td>
                    <td class="center">{!! $disposal->dumping_point_14 == 'n/a' ? '<img src="' . public_path('check.png') . '">' : "" !!}</td>
                    <td>{!! $disposal->dumping_point_14_note !!}</td>
                </tr>
                <tr>
                    <td class="center">15</td>
                    <td>Operator melakukan metode dumping sesuai dengan prosedur</td>
                    <td class="center">{!! $disposal->dumping_point_15 == 'true' ? '<img src="' . public_path('check.png') . '">' : "" !!}</td>
                    <td class="center">{!! $disposal->dumping_point_15 == 'false' ? '<img src="' . public_path('check.png') . '">' : "" !!}</td>
                    <td class="center">{!! $disposal->dumping_point_15 == 'n/a' ? '<img src="' . public_path('check.png') . '">' : "" !!}</td>
                    <td>{!! $disposal->dumping_point_15_note !!}</td>
                </tr>
                <tr>
                    <td class="center">16</td>
                    <td>Terdapat petugas pemandu HD untuk mundur (Stopper/Pengawas)</td>
                    <td class="center">{!! $disposal->dumping_point_16 == 'true' ? '<img src="' . public_path('check.png') . '">' : "" !!}</td>
                    <td class="center">{!! $disposal->dumping_point_16 == 'false' ? '<img src="' . public_path('check.png') . '">' : "" !!}</td>
                    <td class="center">{!! $disposal->dumping_point_16 == 'n/a' ? '<img src="' . public_path('check.png') . '">' : "" !!}</td>
                    <td>{!! $disposal->dumping_point_16_note !!}</td>
                </tr>
                <tr>
                    <td class="center">17</td>
                    <td>Petugas memiliki radio komunikasi (HT)</td>
                    <td class="center">{!! $disposal->dumping_point_17 == 'true' ? '<img src="' . public_path('check.png') . '">' : "" !!}</td>
                    <td class="center">{!! $disposal->dumping_point_17 == 'false' ? '<img src="' . public_path('check.png') . '">' : "" !!}</td>
                    <td class="center">{!! $disposal->dumping_point_17 == 'n/a' ? '<img src="' . public_path('check.png') . '">' : "" !!}</td>
                    <td>{!! $disposal->dumping_point_17_note !!}</td>
                </tr>
                <tr>
                    <td class="center">18</td>
                    <td>Terdapat median pemisah ruas jalan akses masuk & keluar area pembuangan</td>
                    <td class="center">{!! $disposal->dumping_point_18 == 'true' ? '<img src="' . public_path('check.png') . '">' : "" !!}</td>
                    <td class="center">{!! $disposal->dumping_point_18 == 'false' ? '<img src="' . public_path('check.png') . '">' : "" !!}</td>
                    <td class="center">{!! $disposal->dumping_point_18 == 'n/a' ? '<img src="' . public_path('check.png') . '">' : "" !!}</td>
                    <td>{!! $disposal->dumping_point_18_note !!}</td>
                </tr>
                <tr>
                    <td class="center">19</td>
                    <td>Tersedia tanggul  (pipa Gorong-gorong) untuk dumping lumpur cair</td>
                    <td class="center">{!! $disposal->dumping_point_19 == 'true' ? '<img src="' . public_path('check.png') . '">' : "" !!}</td>
                    <td class="center">{!! $disposal->dumping_point_19 == 'false' ? '<img src="' . public_path('check.png') . '">' : "" !!}</td>
                    <td class="center">{!! $disposal->dumping_point_19 == 'n/a' ? '<img src="' . public_path('check.png') . '">' : "" !!}</td>
                    <td>{!! $disposal->dumping_point_19_note !!}</td>
                </tr>
                <tr>
                    <td class="center">20</td>
                    <td>Kondisi pasak penahan gorong-gorong kuat tidak goyah</td>
                    <td class="center">{!! $disposal->dumping_point_20 == 'true' ? '<img src="' . public_path('check.png') . '">' : "" !!}</td>
                    <td class="center">{!! $disposal->dumping_point_20 == 'false' ? '<img src="' . public_path('check.png') . '">' : "" !!}</td>
                    <td class="center">{!! $disposal->dumping_point_20 == 'n/a' ? '<img src="' . public_path('check.png') . '">' : "" !!}</td>
                    <td>{!! $disposal->dumping_point_20_note !!}</td>
                </tr>
                <tr>
                    <td class="center">21</td>
                    <td>Kondisi apron masih baik tidak tergerus lumpur cair</td>
                    <td class="center">{!! $disposal->dumping_point_21 == 'true' ? '<img src="' . public_path('check.png') . '">' : "" !!}</td>
                    <td class="center">{!! $disposal->dumping_point_21 == 'false' ? '<img src="' . public_path('check.png') . '">' : "" !!}</td>
                    <td class="center">{!! $disposal->dumping_point_21 == 'n/a' ? '<img src="' . public_path('check.png') . '">' : "" !!}</td>
                    <td>{!! $disposal->dumping_point_21_note !!}</td>
                </tr>
                <tr>
                    <td class="center">22</td>
                    <td>Material Top Soil di tempatkan khusus dan tidak tercampur material OB</td>
                    <td class="center">{!! $disposal->dumping_point_22 == 'true' ? '<img src="' . public_path('check.png') . '">' : "" !!}</td>
                    <td class="center">{!! $disposal->dumping_point_22 == 'false' ? '<img src="' . public_path('check.png') . '">' : "" !!}</td>
                    <td class="center">{!! $disposal->dumping_point_22 == 'n/a' ? '<img src="' . public_path('check.png') . '">' : "" !!}</td>
                    <td>{!! $disposal->dumping_point_22_note !!}</td>
                </tr>
            </tbody>
        </table>
        Catatan:
        <p class="mb-0">{!! $disposal->additional_notes !!}</p>

        <table style="width: 100%; text-align: center; border-spacing: 10px;">
            <tbody>
                <tr>
                    <td class="noborder nobg">Foremen</td>
                    <td class="noborder nobg">Supervisor</td>
                    <td class="noborder nobg">Superintendent</td>
                </tr>
                <tr>
                    <td class="noborder nobg">@if ($disposal->verified_foreman != null)<img src="data:image/png;base64, {!! $disposal->verified_foreman !!} " style="max-width: 100px;">@endif</td>
                    <td class="noborder nobg">@if ($disposal->verified_supervisor != null)<img src="data:image/png;base64, {!! $disposal->verified_supervisor !!} " style="max-width: 100px;">@endif</td>
                    <td class="noborder nobg">@if ($disposal->verified_superintendent != null)<img src="data:image/png;base64, {!! $disposal->verified_superintendent !!} " style="max-width: 100px;">@endif</td>
                </tr>
                <tr>
                    <td class="noborder nobg">{{ $disposal->nama_foreman ? $disposal->nama_foreman : '.......................' }}</td>
                    <td class="noborder nobg">{{ $disposal->nama_supervisor ? $disposal->nama_supervisor : '.......................' }}</td>
                    <td class="noborder nobg">{{ $disposal->nama_superintendent ? $disposal->nama_superintendent : '.......................' }}</td>
                </tr>
            </tbody>
        </table>

    </div>
</body>
@endforeach
</html>
