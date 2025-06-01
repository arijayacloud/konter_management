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
        <form method="POST" action="{{ route('create') }}" autocomplete="off">
            @csrf
          <div class="modal-body">
                <div class="flex justify-content-between gap-3">
                  <div class="mb-3">
                    <label for="tanggal" class="form-label">Tanggal</label>
                    <input type="date" name="tanggal" class="form-control" id="tanggal" required>
                  </div>
                  <div class="mb-3">
                      <label for="jenisLayanan" class="form-label">Jenis Layanan</label>
                      <select name="jenis_layanan" class="form-select" id="jenisLayanan" required>
                        <option value="" selected disabled>Pilih jenis layanan</option>
                        <option value="TRANSFER">TRANSFER</option>
                        <option value="TARIK TUNAI">TARIK TUNAI</option>
                        <option value="EWALET">EWALET</option>
                        <option value="TRANSFER KARTU">TRANSFER KARTU</option>
                      </select>
                  </div>
                </div>
                <div class="flex justify-content-between gap-3">
                    <div class="mb-3">
                        <label for="namaBank">Nama Bank</label>
                        <input list="bankList" id="namaBank" name="nama_bank" class="form-control" placeholder="Pilih atau ketik nama bank" required>
                        <datalist id="bankList">
                          <option value="BRI">
                          <option value="BCA">
                          <option value="BNI">
                          <option value="MANDIRI">
                          <option value="DANA">
                          <option value="OVO">
                          <option value="GOJEK">
                        </datalist>
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
