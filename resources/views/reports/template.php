<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<style>
    body{
        font-family: Arial, sans-serif;
        font-size: 10px;
    }

    table{
        border-collapse: collapse;
    }

    th, td{
        border: 1px solid black;
        padding: 4px;
        vertical-align: top;
    }

    .center{
        text-align:center;
    }

    .title{
        font-size: 16px;
        font-weight: bold;
        text-align:center;
        margin-bottom:10px;
    }
</style>
</head>

<body>

<div class="title">
SURAT PERINTAH KERJA MOLD / JIG
</div>

<table width="30%">
<tr>
    <td width="40%">NO ORDER</td>
    <td><?= $data['no_order'] ?></td>
</tr>
</table>
<br>
<table width="100%">
    <tr>
        <td>
            <table width="100%">
            
            <tr>
                <td>TANGGAL DIBUAT</td>
                <td>DIBUAT OLEH</td>
                <td>DIPERIKSA GL PEMESAN</td>
                <td>DISETUJUI SM / DM PEMESAN</td>
                <td>DISETUJUI SM / DM KONTROL KUALITAS</td>
                <td>PERMINTAAN SELESAI</td>
            </tr>
            
            <tr>
                <td><?= $data['date_create'] ?></td>
                <td rowspan="2"></td>
                <td rowspan="2"></td>
                <td rowspan="2"></td>
                <td rowspan="2"></td>
                <td rowspan="2"></td>
            </tr>
            
            <tr>
                <td>DEPT / SEKSI</td>
            </tr>
            <tr>
                <td><?= \Bpjs\Framework\Helpers\Session::user()->section ?></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            </table>
        </td>
        <td>
            <table width="100%">
                <tr>
                    <td>TGL DITERIMA</td>
                    <td>RENCANA SELESAI</td>
                    <td>DISETUJUI SM/DM MOLD SECTION</td>
                </tr>
                <tr>
                    <td>2025-01-10</td>
                    <td rowspan="2"></td>
                    <td rowspan="2"></td>
                </tr>
                <tr>
                    <td>DITERIMA OLEH</td>
                </tr>
                <tr>
                    <td>Fervian</td>
                    <td></td>
                    <td></td>
                </tr>
            </table>
        </td>
    </tr>
</table>

<br>

<table width="100%">
<tr class="center">
    <th>TINDAKAN</th>
    <th>NO MOLD</th>
    <th>MODEL / TIPE</th>
    <th>NAMA LAMPU</th>
    <th>NAMA MOLD / JIG</th>
    <th>LOT SHOT</th>
    <th>TOTAL SHOT</th>
</tr>

<tr>
    <td><?= $data['model'] ?></td>
    <td><?= $data['mold_name'] ?></td>
    <td><?= $data['lot_shot'] ?></td>
    <td><?= $data['total_shot'] ?></td>
    <td></td>
    <td></td>
    <td></td>
</tr>
</table>

<br>
<table width="100%">
    <tr>
        <th align="left">Sketsa Item Yang diperbaiki</th>
    </tr>
    <tr>
        <td height="200px"></td>
    </tr>
</table>
<br>
<table width="100%">
    <tr>
        <td>
            <table>
            <tr>
                <th>DETAIL ITEM YANG DIPERBAIKI</th>
                <th>PERMINTAAN PERBAIKAN</th>
                <th>TGL / OLEH</th>
                <th>RENCANA TOTAL JAM</th>
            </tr>
            
            <tr>
                <td><?= $data['detail'] ?></td>
                <td height="250px"></td>
                <td></td>
                <td></td>
            </tr>
            </table>
        </td>
        <td>
            <table>
            <tr>
                <th>ACTUAL ITEM YANG DIPERBAIKI</th>
                <th>TGL / OLEH</th>
                <th>ACTUAL TOTAL JAM</th>
            </tr>
            
            <tr>
                <td><?= $data['detail'] ?></td>
                <td height="250px"></td>
                <td></td>
            </tr>
            </table>
        </td>
    </tr>
</table>

<br>

<table width="100%">
<tr>
    <td width="50%">
        <table>
            <tr>
                <th width="50px"></th>
                <th width="270px">PERLU 4M</th>
            </tr>
        </table>
    </td>
    <td>
        <table>
            <tr>
                <th width="50px"></th>
                <th width="270px">TIDAK PERLU 4M</th>
            </tr>
        </table>
    </td>
</tr>
</table>
<br>
<table width="100%">
    <tr>
        <th>
            <table>
                <tr>
                    <td colspan="4"></td>
                    <td>DIBUAT</td>
                    <td>-></td>
                    <td>DIKETAHUI</td>
                    <td>-></td>
                    <td>DITERIMA</td>
                    <td>-></td>
                    <td>LEMBAR COPY SETELAH SELESAI PROSES MOLD SECTION</td>
                </tr>
            </table>            
        </th>
        <th>
            <table>
                <tr>
                    <td>SERAH TERIMA
                        SETELAH TRIAL HASIL INJECT
                    </td>
                    <td colspan="2">HASIL</td>
                    <td>TGL SERAH TERIMA</td>
                    <td>SM MOLD SECTION</td>
                    <td>SM SEKSI PEMESAN</td>
                    <td>SM KONTROL KUALITAS</td>
                </tr>
                <tr>
                    <td height="50px"></td>
                    <td><br><br>OK</td>
                    <td><br><br>NG</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            </table>
        </th>
    </tr>
</table>

</body>
</html>
