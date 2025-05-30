@extends('layouts.app')

@section('content')
    <main class="container-fluid h-[100dvh] p-4 flex flex-column">
        <div class="row gap-4 mb-4">

            <div class="col">
                <div class="card justify-content-between shadow-md h-100 border-0">
                  <div class="m-3 mb-0">
                    <div class="d-flex align-items-center mb-3">
                      <div class="bg-primary-subtle text-primary rounded px-3 py-2 me-3">
                        <i class="bi bi-cash-stack fs-4"></i>
                      </div>
                      <div>
                        <h5 class="card-title mb-0">Total Transaction</h5>
                        <small class="text-muted">From store transaction</small>
                      </div>
                    </div>
                    <hr />
                    <h2 class="fw-bold text-dark">{{ $paymentsCount }}</h2>
                  </div>
                  <div class="w-100 h-[40px] bg-light">
                  </div>
                </div>
              </div>

            <div class="col">
                <div class="card shadow-md h-100 border-0 justify-content-between">
                  <div class="m-3 mb-0">
                    <div class="d-flex align-items-center mb-3">
                      <div class="bg-danger-subtle text-danger rounded px-3 py-2 me-3">
                        <i class="bi bi-bank fs-4"></i>
                      </div>
                      <div>
                        <h5 class="card-title mb-0">Admin Transfers</h5>
                        <small class="text-muted">Total from admin transfer</small>
                      </div>
                    </div>
                    <hr />
                    <h2 class="fw-bold text-dark">Rp {{ number_format($totalPayment, 0, ',', '.') }}</h2>
                  </div>
                  <div class="w-100 h-[40px] bg-light">
                  </div>
                </div>
              </div>

            <div class="col">
                <div class="card shadow-md h-100 border-0 justify-content-between">
                  <div class="m-3 mb-0">
                    <div class="d-flex align-items-center mb-3">
                      <div class="bg-success-subtle text-success rounded px-3 py-2 me-3">
                        <i class="bi bi-person-fill fs-4"></i>
                      </div>
                      <div>
                        <h5 class="card-title mb-0">Total User</h5>
                        <small class="text-muted">Total user from user count</small>
                      </div>
                    </div>
                    <hr />
                    <h2 class="fw-bold text-dark">{{ $uniqueNamesCount }}</h2>
                  </div>
                  <div class="w-100 h-[40px] bg-light">
                  </div>
                </div>
              </div>
        </div>
        <div class="bg-white shadow-md rounded-3 grow-1 rounded-2 overflow-hidden">
          <div class="d-flex flex-column h-100">

            <!-- Header -->
            <div class="text-white d-flex flex-wrap justify-content-between align-items-center bg-primary p-3">
              <div>
                <h4 class="mb-1">Transaction</h4>
                <p class="mb-0">Latest transactions sales in time</p>
              </div>
              <div class="d-flex gap-2">
                <button type="button" class="btn btn-light text-primary d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#exampleModal">
                  <i class="bi bi-plus me-2"></i> Add
                </button>
                <form method="GET" action="{{ route('list') }}">
                    <div class="input-group">
                        <input type="text" name="keyword" class="form-control" placeholder="Search..." value="{{ request()->input('keyword') }}">
                        <button class="btn btn-outline-light" type="submit">
                            <i class="bi bi-search"></i>
                        </button>
                    </div>
                </form>
              </div>
            </div>

            <hr />

            <!-- Table -->
            <div class="mx-3 table-responsive flex-grow-1 overflow-auto mb-3">
              <table class="table table-hover align-middle">
                <thead class="">
                  <tr class="">
                    <th class="text-muted">Tanggal</th>
                    <th class="text-muted">Jenis Layanan</th>
                    <th class="text-muted">Lokasi Konter</th>
                    <th class="text-muted">Nama Bank</th>
                    <th class="text-muted">Nomor Rekening</th>
                    <th class="text-muted">Atas Nama</th>
                    <th class="text-muted">Jumlah Transfer</th>
                    <th class="text-muted">Admin Transfer</th>
                    <th class="text-muted text-center">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                @foreach ($payments as $payment)
                  <tr id="transaction-{{ $payment->id }}">
                    <td>{{ $payment->tanggal }}</td>
                    <td>{{ $payment->jenis_layanan }}</td>
                    <td>{{ $payment->lokasi_konter }}</td>
                    <td>{{ $payment->nama_bank }}</td>
                    <td>{{ $payment->nomor_rekening }}</td>
                    <td>{{ $payment->atas_nama }}</td>
                    <td>Rp {{ number_format($payment->jumlah_transfer, 0, ',', '.') }}</td>
                    <td>Rp {{ number_format($payment->admin_transfer, 0, ',', '.') }}</td>
                    <td class="text-center">
                      <div class="btn-group" role="group">
                        <button class="btn btn-sm btn-outline-primary" title="Edit" data-bs-toggle="modal" data-bs-target="#editModal" data-id="{{ $payment->id }}"
                            data-tanggal="{{ $payment->tanggal }}"
                            data-jenis_layanan="{{ $payment->jenis_layanan }}"
                            data-lokasi_konter="{{ $payment->lokasi_konter }}"
                            data-nama_bank="{{ $payment->nama_bank }}"
                            data-nomor_rekening="{{ $payment->nomor_rekening }}"
                            data-atas_nama="{{ $payment->atas_nama }}"
                            data-jumlah_transfer="{{ $payment->jumlah_transfer }}"
                            data-admin_transfer="{{ $payment->admin_transfer }}">
                          <i class="bi bi-pencil-square"></i>
                        </button>
                        <form action="{{ route('destroy', $payment->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this transaction?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger" title="Delete">
                              <i class="bi bi-trash"></i>
                            </button>
                        </form>
                        <button class="btn btn-sm btn-outline-secondary" title="Print" onclick="printTransaction({{ $payment->id }})">
                          <i class="bi bi-printer"></i>
                        </button>
                      </div>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
            <!-- Pagination Links -->
            <div class="m-3">
                {{ $payments->links() }}
            </div>
            <hr />
          </div>
        </div>
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

    <!-- Modal Edit -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Modal</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <form method="POST" action="{{ route('update') }}">
            @csrf
            @method('PUT')
            <div class="modal-body">

              <input type="hidden" name="id" id="editId">

              <div class="flex justify-content-between gap-3">
                <div class="mb-3">
                  <label for="editTanggal" class="form-label">Tanggal</label>
                  <input type="date" name="tanggal" class="form-control" id="editTanggal" required>
                </div>
                <div class="mb-3">
                  <label for="editJenisLayanan" class="form-label">Jenis Layanan</label>
                  <input type="text" name="jenis_layanan" class="form-control" id="editJenisLayanan" required>
                </div>
              </div>
              <div class="mb-3">
                <label for="editLokasiKonter" class="form-label">Lokasi Konter</label>
                <input type="text" name="lokasi_konter" class="form-control" id="editLokasiKonter" required>
              </div>
              <div class="flex justify-content-between gap-3">
                <div class="mb-3">
                  <label for="editNamaBank" class="form-label">Nama Bank</label>
                  <input type="text" name="nama_bank" class="form-control" id="editNamaBank" required>
                </div>
                <div class="mb-3">
                  <label for="editNomorRekening" class="form-label">Nomor Rekening</label>
                  <input type="number" name="nomor_rekening" class="form-control" id="editNomorRekening" required>
                </div>
              </div>
              <div class="mb-3">
                <label for="editAtasNama" class="form-label">Atas Nama</label>
                <input type="text" name="atas_nama" class="form-control" id="editAtasNama" required>
              </div>
              <div class="flex justify-content-between gap-3">
                <div class="mb-3">
                  <label for="editJumlahTransfer" class="form-label">Jumlah Transfer</label>
                  <input type="number" name="jumlah_transfer" class="form-control" id="editJumlahTransfer" required>
                </div>
                <div class="mb-3">
                  <label for="editAdminTransfer" class="form-label">Admin Transfer</label>
                  <input type="number" name="admin_transfer" class="form-control" id="editAdminTransfer" required>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Save Changes</button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <script>
      // Event listener untuk membuka modal dan mengisi data di dalam modal
      const editModal = document.getElementById('editModal');
      editModal.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget; // Tombol yang diklik
        const id = button.getAttribute('data-id');
        const tanggal = button.getAttribute('data-tanggal');
        const jenisLayanan = button.getAttribute('data-jenis_layanan');
        const lokasiKonter = button.getAttribute('data-lokasi_konter');
        const namaBank = button.getAttribute('data-nama_bank');
        const nomorRekening = button.getAttribute('data-nomor_rekening');
        const atasNama = button.getAttribute('data-atas_nama');
        const jumlahTransfer = button.getAttribute('data-jumlah_transfer');
        const adminTransfer = button.getAttribute('data-admin_transfer');

        // Mengisi data ke dalam modal
        document.getElementById('editId').value = id;
        document.getElementById('editTanggal').value = tanggal;
        document.getElementById('editJenisLayanan').value = jenisLayanan;
        document.getElementById('editLokasiKonter').value = lokasiKonter;
        document.getElementById('editNamaBank').value = namaBank;
        document.getElementById('editNomorRekening').value = nomorRekening;
        document.getElementById('editAtasNama').value = atasNama;
        document.getElementById('editJumlahTransfer').value = jumlahTransfer;
        document.getElementById('editAdminTransfer').value = adminTransfer;
      });

        function getDayName(dateString) {
            const date = new Date(dateString);
            const daysOfWeek = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
            return daysOfWeek[date.getDay()]; // Mengembalikan nama hari berdasarkan indeks
        }

        function printTransaction(paymentId) {
            // Cari elemen yang berisi data transaksi sesuai dengan ID
            var row = document.querySelector(`#transaction-${paymentId}`);

            // Ambil konten HTML dari baris transaksi yang dipilih
            var transactionContent = row.outerHTML;

            // Membuat window baru untuk mencetak
            var printWindow = window.open('', '', 'height=500, width=800');
            printWindow.document.write('<html><head><title>Transaction Print</title>');
            printWindow.document.write('<style>');

            // Gaya untuk struk termal
            printWindow.document.write('@page { size: 58mm 80mm; margin: 0; }'); // Menentukan ukuran kertas
            printWindow.document.write('body { font-family: "Courier New", monospace; width: 58mm; padding: 5mm; margin: 0; font-size: 14px; line-height: 1.5; }');
            printWindow.document.write('table { width: 100%; border: none; padding: 0; margin: 0; font-size: 14px; }');
            printWindow.document.write('th, td { padding: 2px; text-align: left; font-size: 10px; }');
            printWindow.document.write('hr { border: 0; border-top: 1px dashed #000; margin-top: 5px; margin-bottom: 5px; }');
            printWindow.document.write('h2 { font-size: 14px; text-align: center; margin-top: 0; margin-bottom: 5px; }');
            printWindow.document.write('h3 { font-size: 12px; text-align: center; margin-top: 0; }');
            printWindow.document.write('footer { font-size: 12px; text-align: center; margin-top: 10px; }');
            printWindow.document.write('</style></head><body>');

            // Tambahkan Judul
            printWindow.document.write('<h2>STRUK PEMBAYARAN</h2>');
            printWindow.document.write('<h3>AE CELL</h3>');
            printWindow.document.write('<hr>');

            var transactionDate = row.querySelector('td:nth-child(1)').innerText;
            var dayName = getDayName(transactionDate);

            // Tampilkan detail transaksi
            printWindow.document.write('<table>');
            //printWindow.document.write('<tr><td>Tanggal</td><td>:</td><td>' + row.querySelector('td:nth-child(1)').innerText + '</td></tr>');
            printWindow.document.write('<tr><td>' + dayName + ', ' + row.querySelector('td:nth-child(1)').innerText + '</td></tr>');
            printWindow.document.write('<tr><td>Jenis Layanan</td><td>:</td><td>' + row.querySelector('td:nth-child(2)').innerText + '</td></tr>');
            printWindow.document.write('<tr><td>Lokasi Konter</td><td>:</td><td>' + row.querySelector('td:nth-child(3)').innerText + '</td></tr>');
            printWindow.document.write('<tr><td>Nama Bank</td><td>:</td><td>' + row.querySelector('td:nth-child(4)').innerText + '</td></tr>');
            printWindow.document.write('<tr><td>Nomor Rekening</td><td>:</td><td>' + row.querySelector('td:nth-child(5)').innerText + '</td></tr>');
            printWindow.document.write('<tr><td>Atas Nama</td><td>:</td><td>' + row.querySelector('td:nth-child(6)').innerText + '</td></tr>');
            printWindow.document.write('<tr><td>Admin Transfer</td><td>:</td><td>' + row.querySelector('td:nth-child(8)').innerText + '</td></tr>');
            printWindow.document.write('</table>');
            printWindow.document.write('<hr>');

            printWindow.document.write('<h3 style="margin-top: 20px;">' + row.querySelector('td:nth-child(7)').innerText + '</h3>');
            printWindow.document.write('<h3 style="margin-top: 0px;">Terima Kasih</h3>');

            printWindow.document.write('<hr>');
            printWindow.document.write('<footer>SIMPAN TANDA TERIMA INI SEBAGAI TRANSAKSI YANG SAH</footer>');

            printWindow.document.write('<script>window.print(); window.close();</' + 'script>');
            printWindow.document.write('</body></html>');
            printWindow.document.close();
          }
    </script>

@endsection
