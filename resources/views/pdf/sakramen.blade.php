<!-- filepath: c:\laragon\www\pelayanan-gereja\resources\views\pdf\sakramen.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Surat Bukti Penerimaan Sakramen</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .content {
            margin: 20px;
        }
        .footer {
            text-align: center;
            margin-top: 30px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Sertifikat Sakramen</h1>
        <h2>{{ $pendaftar->jenis_sakramen }}</h2>
    </div>
    <div class="content">
        <p><strong>Sakramen ID:</strong> {{ $pendaftar->sakramen_event_id }}</p>
        <p><strong>Nama Lengkap:</strong> {{ $pendaftar->nama_lengkap }}</p>
        <p><strong>Tempat, Tanggal Lahir:</strong> {{ $pendaftar->tempat_lahir }}, {{ $pendaftar->tanggal_lahir }}</p>
        <p><strong>Alamat:</strong> {{ $pendaftar->alamat_lengkap }}</p>
        <p><strong>Lingkungan:</strong> {{ $pendaftar->lingkungan }}</p>
        <hr>
        <p><strong>Nama Event:</strong> {{ $sakramenEvent->nama_event }}</p>
        <p><strong>Jenis Sakramen:</strong> {{ $pendaftar->jenis_sakramen }}</p>
        <p><strong>Tanggal Pelaksanaan:</strong> {{ $sakramenEvent->tanggal_pelaksanaan }}</p>
        <p><strong>Tempat Pelaksanaan:</strong> {{ $sakramenEvent->tempat_pelaksanaan }}</p>
    </div>
    <div class="footer">
        <p>Pastor Paroki</p>
        <p>________________________</p>
    </div>
</body>
</html>