<html>

<head>
    <title>
        Laporan Harian Foreman Produksi
    </title>
    <style>
        @media print {
            @page {
                size: A4;
                margin: 20mm;
            }

            body {
                margin: 0;
                padding: 0;
            }

            .container {
                width: 100%;
                margin: 0;
                border: none;
                padding: 0;
            }
        }

        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }
        /* table{
            width: 100%;
            table-layout: fixed;
        }
        table, tr, td, th{
            border-collapse: collapse;
        }
        tr, td, th{
            width:20pt;
        } */
        table{
            page-break-inside:auto
        }
		table {
            -fs-table-paginate: paginate;
        }
        tr{
            page-break-inside:avoid;
            page-break-after:auto
        }
        table{
            /* border:1px solid #000; */
            border-collapse:collapse;
            table-layout:fixed;
        }
        tr td{
            /* border:1px solid #000; */
            border-collapse:collapse;
			/* padding:.1rem; */
        }
        table tr td, table tr th{
            font-size: xx-small;
        }
        .header {
            margin-bottom: 20px;
            display: flex;
            justify-content: space-between;
            border-bottom: 2px solid #000;
            padding: .3rem;
        }

        .header img {
            vertical-align: middle;
        }

        .header .title {
            display: inline-block;
            margin-left: 10px;
            text-align: left;
        }

        .header .title h1 {
            margin: 0;
            font-size: 18px;
            color: #0000FF;
        }

        .header .title p {
            margin: 0;
            font-size: 12px;
        }

        .header .doc-number {
            text-align: right;
            font-size: 12px;
        }

        .info-table,
        .data-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table.inf-table{
            border:none;
        }

        .info-table td {
            padding: 5px;
            width: 20pt;
        }

        .info-table td:first-child {
            width: 15%;
        }

        .info-table td:nth-child(2) {
            width: .2%;
            /* border-bottom: 1px dotted #000; */
        }

        .info-table td:nth-child(3) {
            width: 30%;
            vertical-align: bottom;
        }

        .info-table td:nth-child(4) {
            width: 10%;
            /* background-color: white; */
            /* border-bottom: 1px dotted #000; */
        }
        .info-table td:nth-child(5) {
            width: 15%;
            vertical-align: bottom;
        }
        .info-table td:nth-child(6) {
            width: .2%;
            /* border-bottom: 1px dotted #000; */
        }
        .info-table td:nth-child(7) {
            width: 30%;
            /* border-bottom: 1px dotted #000; */
        }
        .data-table th,
        .data-table td {
            border: 1px solid #000;
            text-align: center;
        }

        .data-table th {
            background-color: #f2f2f2;
        }

        .data-table th[colspan] {
            text-align: center;
        }

        .data-table td[colspan] {
            text-align: left;
        }

        .footer {
            font-size: 10px;
        }

        .flex {
            display: flex;
        }
        table.data_table{
            width: 100%;
            border: 1px solid #000;
            table-layout: fixed;
        }
        table.data_table tr td, table.data_table tr th{
            border:1px solid #000;
        }
        table.data_table tbody tr td{
            height: 15pt;
        }

        table.table_close{
            width: 100%;
            /* border: 1px solid #000; */
            table-layout: fixed;
        }
        table.table_close tr td, table.table_close tr th{
            /* border:1px solid #000; */
        }
        table.table_close tr th{
            height: 15pt;
            padding:.2rem;
        }
        th.noborder{
            border:none;
            /* border-bottom: none; */
        }
        hr{
            margin-bottom:1rem;
        }
        .flex{
            display: flex;
            justify-content: space-between;
        }
        .hor{
            display: flex;
            flex-direction: column;
        }
    </style>
</head>

<body>
    <div class="header">
        <div class="flex">
            <img alt="Company Logo" height="35"
                src="{{ asset('dashboard/assets/images/logo-full.png') }}"
                alt="logo disini" />
            {{-- <div class="title">
                <h1>
                    PT. SIMS JAYA KALTIM
                </h1>
                <p>
                    Trusted Partner For Your SAFE and GREEN Mining
                </p>
            </div> --}}
        </div>
        <div class="doc-number">
            <p>
                FM-PRD-03/03/06/02/24
            </p>
        </div>
    </div>
    <h2 style="text-align: center;">
        LAPORAN HARIAN FOREMAN PRODUKSI
    </h2>
    <table class="info-table">
        <tr>
            <td colspan="14">Tanggal</td>
            <td>:</td>
            <td>........................................................</td>
            <td colspan="7"></td>
            <td colspan="3">Nama Foreman</td>
            <td>:</td>
            <td colspan="7">........................................................</td>
        </tr>
        <tr>
            <td colspan="14">Shift</td>
            <td>:</td>
            <td>........................................................</td>
            <td colspan="7"></td>
            <td colspan="3">NIK Foreman</td>
            <td>:</td>
            <td colspan="7">........................................................</td>
        </tr>
        <tr>
            <td colspan="14">Lokasi</td>
            <td>:</td>
            <td>........................................................</td>
            <td colspan="7"></td>
            <td colspan="3">Nama Supervisor</td>
            <td>:</td>
            <td colspan="7">........................................................</td>
        </tr>
        <tr>
            <td colspan="14">Jam Kerja</td>
            <td>:</td>
            <td>........................................................</td>
            <td colspan="7"></td>
            <td colspan="3"></td>
            <td></td>
            <td colspan="7"></td>
        </tr>
    </table>
    <h3>
        A. FRONT LOADING
    </h3>
    <table class="data-table">
        <tr>
            <th rowspan="3">Brand</th>
            <th rowspan="3">Type</th>
            <th rowspan="3">No Unit</th>
            <th>Shift</th>
            <th colspan="12">Jam</th>
        </tr>
        <tr>
            <th>Siang</th>
            <th>07-08</th>
            <th>08-09</th>
            <th>09-10</th>
            <th>10-11</th>
            <th>11-12</th>
            <th>12-13</th>
            <th>13-14</th>
            <th>14-15</th>
            <th>15-16</th>
            <th>16-17</th>
            <th>17-18</th>
            <th>18-19</th>
        </tr>
        <tr>
            <th>Malam</th>
            <th>19-20</th>
            <th>20-21</th>
            <th>21-22</th>
            <th>22-23</th>
            <th>23-24</th>
            <th>24-01</th>
            <th>01-02</th>
            <th>02-03</th>
            <th>03-04</th>
            <th>04-05</th>
            <th>05-06</th>
            <th>06-07</th>
        </tr>
        <tr>
            <td rowspan="12">Hitachi</td>
            <td>HT2600</td>
            <td colspan="2">EX5279</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td rowspan="8">HT2500</td>
            <td colspan="2">EX265</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td colspan="2">EX266</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td colspan="2">EX267</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td colspan="2">EX268</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td colspan="2">EX269</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td colspan="2">EX272</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td colspan="2">EX273</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td colspan="2">EX274</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>HT1900</td>
            <td colspan="2">EX264</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td rowspan="2">HT1200</td>
            <td colspan="2">EX2701</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td colspan="2">EX2702</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td rowspan="4">Komatsu</td>
            <td rowspan="4">PC2000</td>
            <td colspan="2">EX275</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td colspan="2">EX276</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td colspan="2">EX277</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td colspan="2">EX278</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
    </table>
    <div class="footer">
        Keterangan: beri tanda centang (√) pada unit excavator yang diawasi
    </div>
    <h3>
        B.  ALAT SUPPORT ( SIANG / MALAM ) TANGGAL :
    </h3>
    <table class="data_table">
        <thead>
            <tr>
                <th rowspan="2">No</th>
                <th rowspan="2">No. Unit</th>
                <th rowspan="2">Nama Operator</th>
                <th colspan="2">HM Unit</th>
                <th rowspan="2">Total</th>
                <th rowspan="2">Cash Pengawas</th>
                <th rowspan="2">Ket.</th>
            </tr>
            <tr>
                <th>Awal</th>
                <th>Akhir</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>

        </tbody>
    </table>
    <br>
    <div style="font-size: 12pt;">Ket</div>
    <hr>
    <hr>
    <hr>
    <hr>
    <div>
        <table class="table_close">
            <tr>
                <th style="border-bottom: 1px solid #000; border-top: 1px solid #000;"></th>
                <th style="border-bottom: 1px solid #000; border-top: 1px solid #000;"></th>
                <th style="border-bottom: 1px solid #000; border-top: 1px solid #000;"></th>
                <th style="border-bottom: 1px solid #000; border-top: 1px solid #000;"></th>
                <th style="border-bottom: 1px solid #000; border-top: 1px solid #000;"></th>
                <th style="border-bottom: 1px solid #000; border-top: 1px solid #000;"></th>
                <th style="border-bottom: 1px solid #000; border-top: 1px solid #000;"></th>
                <th style="border-bottom: 1px solid #000; border-top: 1px solid #000;"></th>
                <th style="border-bottom: 1px solid #000; border-top: 1px solid #000;"></th>
                <th style="border-bottom: 1px solid #000; border-top: 1px solid #000;"></th>
                <th style="border-bottom: 1px solid #000; border-top: 1px solid #000;"></th>
                <th style="border-bottom: 1px solid #000; border-top: 1px solid #000;"></th>
                <th style="border-bottom: 1px solid #000; border-top: 1px solid #000;"></th>
                <th style="border-bottom: 1px solid #000; border-top: 1px solid #000;"></th>
                <th style="border-bottom: 1px solid #000; border-top: 1px solid #000;"></th>
                <th style="border-bottom: 1px solid #000; border-top: 1px solid #000;"></th>
                <th style="border-bottom: 1px solid #000; border-top: 1px solid #000;"></th>
                <th style="border-bottom: 1px solid #000; border-top: 1px solid #000;"></th>
                <th style="border-bottom: 1px solid #000; border-top: 1px solid #000;"></th>
                <th style="border-bottom: 1px solid #000; border-top: 1px solid #000;"></th>
                <th style="border-bottom: 1px solid #000; border-top: 1px solid #000;"></th>
                <th style="border-bottom: 1px solid #000; border-top: 1px solid #000;"></th>
                <th style="border-bottom: 1px solid #000; border-top: 1px solid #000;"></th>
                <th class="noborder" width="5px"></th>
                <th style="border:1px solid #000;" colspan="3">Dibuat</th>
                <th style="border:1px solid #000;" colspan="3">Diperiksa</th>

            </tr>
            <tr>
                <th style="border-bottom: 1px solid #000; border-top: 1px solid #000;"></th>
                <th style="border-bottom: 1px solid #000; border-top: 1px solid #000;"></th>
                <th style="border-bottom: 1px solid #000; border-top: 1px solid #000;"></th>
                <th style="border-bottom: 1px solid #000; border-top: 1px solid #000;"></th>
                <th style="border-bottom: 1px solid #000; border-top: 1px solid #000;"></th>
                <th style="border-bottom: 1px solid #000; border-top: 1px solid #000;"></th>
                <th style="border-bottom: 1px solid #000; border-top: 1px solid #000;"></th>
                <th style="border-bottom: 1px solid #000; border-top: 1px solid #000;"></th>
                <th style="border-bottom: 1px solid #000; border-top: 1px solid #000;"></th>
                <th style="border-bottom: 1px solid #000; border-top: 1px solid #000;"></th>
                <th style="border-bottom: 1px solid #000; border-top: 1px solid #000;"></th>
                <th style="border-bottom: 1px solid #000; border-top: 1px solid #000;"></th>
                <th style="border-bottom: 1px solid #000; border-top: 1px solid #000;"></th>
                <th style="border-bottom: 1px solid #000; border-top: 1px solid #000;"></th>
                <th style="border-bottom: 1px solid #000; border-top: 1px solid #000;"></th>
                <th style="border-bottom: 1px solid #000; border-top: 1px solid #000;"></th>
                <th style="border-bottom: 1px solid #000; border-top: 1px solid #000;"></th>
                <th style="border-bottom: 1px solid #000; border-top: 1px solid #000;"></th>
                <th style="border-bottom: 1px solid #000; border-top: 1px solid #000;"></th>
                <th style="border-bottom: 1px solid #000; border-top: 1px solid #000;"></th>
                <th style="border-bottom: 1px solid #000; border-top: 1px solid #000;"></th>
                <th style="border-bottom: 1px solid #000; border-top: 1px solid #000;"></th>
                <th style="border-bottom: 1px solid #000; border-top: 1px solid #000;"></th>
                <th class="noborder" width="5px"></th>
                <th style="border:1px solid #000;" rowspan="2" colspan="3"></th>
                <th style="border:1px solid #000;" rowspan="2" colspan="3"></th>
            </tr>
            <tr>
                <th style="border-bottom: 1px solid #000; border-top: 1px solid #000;"></th>
                <th style="border-bottom: 1px solid #000; border-top: 1px solid #000;"></th>
                <th style="border-bottom: 1px solid #000; border-top: 1px solid #000;"></th>
                <th style="border-bottom: 1px solid #000; border-top: 1px solid #000;"></th>
                <th style="border-bottom: 1px solid #000; border-top: 1px solid #000;"></th>
                <th style="border-bottom: 1px solid #000; border-top: 1px solid #000;"></th>
                <th style="border-bottom: 1px solid #000; border-top: 1px solid #000;"></th>
                <th style="border-bottom: 1px solid #000; border-top: 1px solid #000;"></th>
                <th style="border-bottom: 1px solid #000; border-top: 1px solid #000;"></th>
                <th style="border-bottom: 1px solid #000; border-top: 1px solid #000;"></th>
                <th style="border-bottom: 1px solid #000; border-top: 1px solid #000;"></th>
                <th style="border-bottom: 1px solid #000; border-top: 1px solid #000;"></th>
                <th style="border-bottom: 1px solid #000; border-top: 1px solid #000;"></th>
                <th style="border-bottom: 1px solid #000; border-top: 1px solid #000;"></th>
                <th style="border-bottom: 1px solid #000; border-top: 1px solid #000;"></th>
                <th style="border-bottom: 1px solid #000; border-top: 1px solid #000;"></th>
                <th style="border-bottom: 1px solid #000; border-top: 1px solid #000;"></th>
                <th style="border-bottom: 1px solid #000; border-top: 1px solid #000;"></th>
                <th style="border-bottom: 1px solid #000; border-top: 1px solid #000;"></th>
                <th style="border-bottom: 1px solid #000; border-top: 1px solid #000;"></th>
                <th style="border-bottom: 1px solid #000; border-top: 1px solid #000;"></th>
                <th style="border-bottom: 1px solid #000; border-top: 1px solid #000;"></th>
                <th style="border-bottom: 1px solid #000; border-top: 1px solid #000;"></th>
                <th class="noborder" width="5px"></th>
                <th></th>
                <th></th>
            </tr>
            <tr>
                <th style="border-bottom: 1px solid #000; border-top: 1px solid #000;"></th>
                <th style="border-bottom: 1px solid #000; border-top: 1px solid #000;"></th>
                <th style="border-bottom: 1px solid #000; border-top: 1px solid #000;"></th>
                <th style="border-bottom: 1px solid #000; border-top: 1px solid #000;"></th>
                <th style="border-bottom: 1px solid #000; border-top: 1px solid #000;"></th>
                <th style="border-bottom: 1px solid #000; border-top: 1px solid #000;"></th>
                <th style="border-bottom: 1px solid #000; border-top: 1px solid #000;"></th>
                <th style="border-bottom: 1px solid #000; border-top: 1px solid #000;"></th>
                <th style="border-bottom: 1px solid #000; border-top: 1px solid #000;"></th>
                <th style="border-bottom: 1px solid #000; border-top: 1px solid #000;"></th>
                <th style="border-bottom: 1px solid #000; border-top: 1px solid #000;"></th>
                <th style="border-bottom: 1px solid #000; border-top: 1px solid #000;"></th>
                <th style="border-bottom: 1px solid #000; border-top: 1px solid #000;"></th>
                <th style="border-bottom: 1px solid #000; border-top: 1px solid #000;"></th>
                <th style="border-bottom: 1px solid #000; border-top: 1px solid #000;"></th>
                <th style="border-bottom: 1px solid #000; border-top: 1px solid #000;"></th>
                <th style="border-bottom: 1px solid #000; border-top: 1px solid #000;"></th>
                <th style="border-bottom: 1px solid #000; border-top: 1px solid #000;"></th>
                <th style="border-bottom: 1px solid #000; border-top: 1px solid #000;"></th>
                <th style="border-bottom: 1px solid #000; border-top: 1px solid #000;"></th>
                <th style="border-bottom: 1px solid #000; border-top: 1px solid #000;"></th>
                <th style="border-bottom: 1px solid #000; border-top: 1px solid #000;"></th>
                <th style="border-bottom: 1px solid #000; border-top: 1px solid #000;"></th>
                <th class="noborder" width="5px"></th>
                <th style="border:1px solid #000;" colspan="3">Foreman</th>
                <th style="border:1px solid #000;" colspan="3">SV/SI</th>
            </tr>

        </table>
    </div>
</body>

</html>
