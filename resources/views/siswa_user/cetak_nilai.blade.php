<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Nilai - {{ $siswa->nama_siswa ?? $siswa->nama }}</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 20px; color: #333; }
        .header { text-align: center; margin-bottom: 30px; border-bottom: 2px solid #333; padding-bottom: 15px; }
        .header h1 { margin: 0; font-size: 24px; text-transform: uppercase; }
        .header p { margin: 5px 0 0; font-size: 14px; }
        .info { margin-bottom: 20px; display: flex; justify-content: space-between; }
        .info div { font-size: 14px; }
        .info strong { display: inline-block; width: 100px; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 30px; }
        table, th, td { border: 1px solid #000; }
        th, td { padding: 10px; text-align: left; font-size: 14px; }
        th { background-color: #f2f2f2; text-align: center; }
        td.text-center { text-align: center; }
        .footer { text-align: right; font-size: 14px; margin-top: 50px; }
        .footer p { margin-bottom: 60px; }
        @media print {
            .no-print { display: none; }
            body { padding: 0; }
        }
        .btn-print {
            padding: 10px 20px;
            background: #4f46e5;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
            display: inline-block;
            margin-bottom: 20px;
            cursor: pointer;
            border: none;
        }
    </style>
</head>
<body onload="window.print()">

    <button class="no-print btn-print" onclick="window.print()">🖨️ Cetak Sekarang</button>
    <a href="/siswa/nilai" class="no-print btn-print" style="background: #6b7280; margin-left:10px;">Kembali</a>

    <div class="header">
        <h1>Bimbel Mentari</h1>
        <p>Laporan Rekapitulasi Nilai Akademik Siswa</p>
    </div>

    <div class="info">
        <div>
            <p><strong>Nama Siswa</strong> : {{ $siswa->nama_siswa ?? $siswa->nama }}</p>
            <p><strong>ID/NIS</strong> : {{ $siswa->id }}</p>
        </div>
        <div>
            <p><strong>Kelas</strong> : {{ $siswa->kelas->nama_kelas ?? '-' }}</p>
            <p><strong>Tanggal Cetak</strong> : {{ date('d F Y') }}</p>
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th width="5%">No</th>
                <th width="20%">Tanggal</th>
                <th width="25%">Mata Pelajaran</th>
                <th width="20%">Jenis Nilai</th>
                <th width="10%">Nilai</th>
                <th width="20%">Keterangan</th>
            </tr>
        </thead>
        <tbody>
            @forelse($nilai as $index => $n)
            <tr>
                <td class="text-center">{{ $index + 1 }}</td>
                <td class="text-center">{{ date('d/m/Y', strtotime($n->created_at)) }}</td>
                <td>{{ $n->mapel->nama_mapel ?? '-' }}</td>
                <td>{{ $n->jenis_nilai }}</td>
                <td class="text-center"><strong>{{ $n->nilai }}</strong></td>
                <td>{{ $n->keterangan ?? '-' }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="text-center">Belum ada data nilai.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">
        <p>Mengetahui,</p>
        <p><strong>Admin Akademik</strong></p>
    </div>

</body>
</html>
