<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Struk Pembayaran</title>
    <style>
        @media print {
          /* sembunyikan elemen yang tidak perlu */
          .no-print {
            display: none !important;
          }
        }
        @page {
            size: 58mm 80mm;
            margin: 0;
        }
        body {
            font-family: "Courier New", monospace;
            width: 58mm;
            height: 80mm;
            padding: 5mm;
            margin: 0 auto;
            font-size: 12px;
        }
        table {
            width: 100%;
            font-size: 12px;
        }
        td {
            padding: 2px 0;
        }
        h2, h3, footer {
            text-align: center;
            margin: 5px 0;
        }
        hr {
            border: none;
            border-top: 1px dashed #000;
            margin: 8px 0;
        }
    </style>
</head>
<body >

    <h2>STRUK PEMBAYARAN</h2>
    <h3>...</h3>
    <hr>

    <table>
        <tr>{{ \Carbon\Carbon::parse($payment->tanggal)->translatedFormat('l, d M Y') }}</tr>
        <tr><td>Jenis</td><td>: {{ $payment->jenis_layanan }}</td></tr>
        <tr><td>Lokasi</td><td>: {{ $payment->lokasi_konter }}</td></tr>
        <tr><td>Bank</td><td>: {{ $payment->nama_bank }}</td></tr>
        <tr><td>No Rek</td><td>: {{ $payment->nomor_rekening }}</td></tr>
        <tr><td>Atas Nama</td><td>: {{ $payment->atas_nama }}</td></tr>
        <tr><td>Admin</td><td>: Rp {{ number_format($payment->admin_transfer, 0, ',', '.') }}</td></tr>
    </table>

    <hr>
    <h2 style="text-align: center; margin: 20px 0px;">Rp {{ number_format($payment->jumlah_transfer, 0, ',', '.') }}</h2>
    <h3>TERIMA KASIH</h3>
    <hr>
    <footer>SIMPAN STRUK INI SEBAGAI BUKTI TRANSAKSI SAH</footer>

    <script>
        window.onload = function() {
            window.print();
            window.onafterprint = function(){
                window.history.back();
            }
        }
    </script>
</body>
</html>
