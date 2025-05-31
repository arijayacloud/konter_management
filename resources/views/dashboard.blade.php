@extends('layouts.app')

@section('content')
    <main class="container-fluid">
        <h1 class="text-center text-primary">Welcome in dashboard</h1>
    </main>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Add Modal</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
        <form method="POST" action="{{ route('create') }}">
            @csrf
          <div class="modal-body">

                <div class="flex justify-content-between gap-3">
                  <div class="mb-3">
                    <label for="tanggal" class="form-label">Tanggal</label>
                    <input type="date" name="tanggal" class="form-control" id="tanggal" required>
                  </div>
                  <div class="mb-3">
                    <label for="jenisLayanan" class="form-label">Jenis Layanan</label>
                    <input type="text" name="jenis_layanan" class="form-control" id="jenisLayanan" required>
                  </div>
                </div>
                <div class="mb-3">
                    <label for="lokasiKonter" class="form-label">Lokasi Konter</label>
                    <input type="text" name="lokasi_konter" class="form-control" id="lokasiKonter" required>
                </div>
                <div class="flex justify-content-between gap-3">
                  <div class="mb-3">
                    <label for="namaBank" class="form-label">Nama Bank</label>
                    <input type="text" name="nama_bank" class="form-control" id="namaBank" required>
                  </div>
                  <div class="mb-3">
                    <label for="nomorRekening" class="form-label">Nomor Rekening</label>
                    <input type="number" name="nomor_rekening" class="form-control" id="nomorRekening" required>
                  </div>
                </div>
                <div class="mb-3">
                    <label for="atasNama" class="form-label">Atas Nama</label>
                    <input type="text" name="atas_nama" class="form-control" id="atasNama" required>
                </div>
                <div class="flex justify-content-between gap-3">
                  <div class="mb-3">
                    <label for="jumlahTransfer" class="form-label">Jumlah Transfer</label>
                    <input type="number" name="jumlah_transfer" class="form-control" id="jumlahTransfer" required>
                  </div>
                  <div class="mb-3">
                    <label for="adminTransfer" class="form-label">Admin Transfer</label>
                    <input type="number" name="admin_transfer" class="form-control" id="adminTransfer" required>
                  </div>
                </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Add</button>
          </div>
        </form>
        </div>
      </div>
    </div>
@endsection
