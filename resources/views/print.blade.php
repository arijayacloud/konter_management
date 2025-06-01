<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Struk Pembayaran</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 10px; /* Ukuran kecil untuk muat di 58mm */
            margin: 0;
            padding: 0;
            width: 58mm;
        }

        .wrapper {
            padding: 15px 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        td {
            padding: 2px 0;
        }

        h2, h3, p {
            margin: 0;
            text-align: center;
        }

        hr {
            border: none;
            border-top: 1px dashed #000;
            margin: 5px 0;
        }

        .total {
            font-size: 14px;
            font-weight: bold;
            margin: 10px 0;
        }

        .center {
            text-align: center;
        }
    </style>
</head>
<body >

<div class="wrapper">
    <div style="margin: 5px 0px;">
        <h2 style="margin-bottom: 5px; ">{{ $nama_konter }}</h2>
        <p>{{ $lokasi }}</p>
    </div>

    <hr>

    <table>
        <tr >
            <td class="center" colspan="2" style="padding: 5px 0px;" >
                {{ \Carbon\Carbon::now()->translatedFormat('l, d M Y') }}
                {{ \Carbon\Carbon::now()->format('H:i') }}
            </td>
        </tr>
        <tr><td>Serial Number</td><td>: {{ $payment->serial_number }}</td></tr>
        <tr><td>Jenis</td><td>: {{ $payment->jenis_layanan }}</td></tr>
        <tr><td>Bank</td><td>: {{ $payment->nama_bank }}</td></tr>
        <tr><td>No Rek</td><td>: {{ $payment->nomor_rekening }}</td></tr>
        <tr><td>Atas Nama</td><td>: {{ $payment->atas_nama }}</td></tr>
        <tr><td>Admin</td><td>: Rp {{ number_format($payment->admin_transfer, 0, ',', '.') }}</td></tr>
        <tr><td>STATUS</td><td>: SUKSES</td></tr>
    </table>

    <hr>

    <h2 style="margin-top: 10px;" class="total">Rp {{ number_format($payment->jumlah_transfer, 0, ',', '.') }}</h2>
    <p class="center" style="margin-top: 10px;">TERIMA KASIH</p>
    <hr>
    <p class="center">SIMPAN STRUK INI SEBAGAI BUKTI TRANSAKSI SAH</p>
</div>

</body>
</html>
