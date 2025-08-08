@extends('layouts.app')

@section('content')
    <main class="container-fluid flex flex-column" >
        <!--<div id="rowInfo" class="gap-4 mb-4">-->
        <!--    <div class="col">-->
        <!--        <div class="border-start border-primary border-5 card justify-content-between shadow-md h-100 border-0">-->
        <!--          <div class="m-3 mb-0">-->
        <!--            <div class="d-flex align-items-center mb-3">-->
        <!--              <div class="bg-primary-subtle text-primary rounded px-3 py-2 me-3">-->
        <!--                <i class="bi bi-cash-stack fs-4"></i>-->
        <!--              </div>-->
        <!--              <div class="">-->
        <!--                <h5 class="card-title mb-0">Total Transaction</h5>-->
        <!--                <small class="text-muted">Calculated from the total number of transactions</small>-->
        <!--              </div>-->
        <!--            </div>-->
        <!--            <hr />-->
        <!--            <h2 class="fw-bold text-dark">{{ $paymentsCount }}</h2>-->
        <!--          </div>-->
        <!--          <div class="w-100 h-[40px] bg-light">-->
        <!--          </div>-->
        <!--        </div>-->
        <!--      </div>-->

        <!--    <div class="col">-->
        <!--        <div class="border-start border-primary border-5 card shadow-md h-100 border-0 justify-content-between">-->
        <!--          <div class="m-3 mb-0">-->
        <!--            <div class="d-flex align-items-center mb-3">-->
        <!--              <div class="bg-primary-subtle text-primary rounded px-3 py-2 me-3">-->
        <!--                <i class="bi bi-bank fs-4"></i>-->
        <!--              </div>-->
        <!--              <div class="">-->
        <!--                <h5 class="card-title mb-0">Admin Transfers</h5>-->
        <!--                <small class="text-muted">Calculated from the total cost of the transfer admin</small>-->
        <!--              </div>-->
        <!--            </div>-->
        <!--            <hr />-->
        <!--            <h2 class="fw-bold text-dark">Rp {{ number_format($totalPayment, 0, ',', '.') }}</h2>-->
        <!--          </div>-->
        <!--          <div class="w-100 h-[40px] bg-light">-->
        <!--          </div>-->
        <!--        </div>-->
        <!--      </div>-->
        <!--</div>-->

        <div class="bg-white shadow-md rounded-3 grow-1 rounded-2 overflow-hidden">
          <div class="d-flex flex-column h-100">

            <!-- Header -->
            <div class="row text-white bg-primary align-items-center py-3 px-4">
              <div class="col-12 col-sm-6">
                <h4 class="mb-1">Transaction</h4>
                <p class="mb-0">Latest transactions sales in time</p>
              </div>
              <div id="formWrapper" class="col-12 col-sm-6 d-flex gap-2 bg-white rounded p-1">
                <button type="button" id="addButton" class="btn btn-primary align-items-center" data-bs-toggle="modal" data-bs-target="#exampleModal">
                  <i class="bi bi-plus me-2"></i> Add
                </button>
                <form method="GET" action="{{ route('list') }}" class="grow-1" autocomplete="off">
                    <div class="input-group">
                        <input type="text" name="keyword" class="form-control" placeholder="Search..." value="{{ request()->input('keyword') }}">
                        <button class="btn btn-outline-primary" type="submit">
                            <i class="bi bi-search"></i>
                        </button>
                    </div>
                </form>
              </div>
            </div>

            <form class="d-flex justify-content-center gap-2 mt-4 px-3" onchange="filter();">
                        <div class="">
                            <select class="form-select" id="filter_type" aria-label="Default select example" onchange="toggleDateFields();">
                              <option selected disabled>Filter</option>
                              <option value="semua">Semua</option>
                              <option value="harian">Harian</option>
                              <option value="bulanan">Bulanan</option>
                            </select>
                        </div>
                        <div id="harian-fields" class="form-group " style="display: none;">
                            <input type="date" name="tanggal" id="tanggal" class="form-control">
                        </div>
                        <div id="bulanan-fields" class="form-group gap-2" style="display: none;">
                            <select name="bulan" id="bulan" class="form-control" required>
                                <option selected disabled>
                                    Bulan
                                </option>
                                @foreach ($bulanan["bulan"] as $item)
                                    @php
                                        $bulan = (int) $item;
                                    @endphp
                                    <option value="{{ $bulan }}">
                                        {{ \Carbon\Carbon::create()->month($bulan)->translatedFormat('F') }}
                                    </option>
                                @endforeach
                            </select>
                            <!-- Dropdown Tahun -->
                            <select name="tahun" id="tahun" class="form-control" required>
                                <option selected disabled>
                                    Tahun
                                </option>
                                @foreach ($bulanan["tahun"]->pluck('tahun')->unique() as $tahun)
                                    <option value="{{ $tahun }}">{{ $tahun }}</option>More actions
                                @endforeach
                            </select>
                        </div>
                        <div class="grow d-flex justify-content-end">
                            <a href="{{ route('export', request()->all()) }}" class="btn btn-primary" >Export</a>
                        </div>
            </form>

            <hr />

            <!-- Table -->
            <div class="mx-3 table-responsive flex-grow-1 overflow-auto mb-3">
              <table class="table table-hover align-middle">
                <thead class="">
                  <tr class="">
                    <th class="text-muted">Tanggal</th>
                    <th class="text-muted text-center">Aksi</th>
                    <th class="text-muted">Jenis Layanan</th>
                    <th class="text-muted">Lokasi Konter</th>
                    <th class="text-muted">Nama Bank</th>
                    <th class="text-muted">Nomor Rekening</th>
                    <th class="text-muted">Atas Nama</th>
                    <th class="text-muted">Jumlah Transfer</th>
                    <th class="text-muted">Admin Transfer</th>
                  </tr>
                </thead>
                <tbody>
                @foreach ($payments as $payment)
                  <tr id="transaction-{{ $payment->id }}">
                    <td>{{ $payment->tanggal }}</td>
                    <td class="text-center">
                      <div class="btn-group" role="group">
                        <button class="btn btn-sm btn-outline-primary" title="Edit" data-bs-toggle="modal" data-bs-target="#editModal" data-id="{{ $payment->id }}"
                            data-tanggal="{{ $payment->tanggal }}"
                            data-jenis_layanan="{{ $payment->jenis_layanan }}"
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
                        <a class="btn btn-sm btn-outline-warning" href="{{ route('payment.createFromId', $payment->id) }}" 
                           class="btn btn-primary rounded-circle" 
                           style="width:40px; height:40px; display:flex; align-items:center; justify-content:center;" 
                           target="_blank" 
                           title="Salin">
                            <i class="bi bi-plus-lg"></i>
                        </a>
                      </div>
                    </td>
                    <td>{{ $payment->jenis_layanan }}</td>
                    <td>{{ strtoupper($nama_konter) }}</td>
                    <td>{{ $payment->nama_bank }}</td>
                    <td>{{ $payment->nomor_rekening }}</td>
                    <td>{{ $payment->atas_nama }}</td>
                    <td>Rp {{ number_format($payment->jumlah_transfer, 0, ',', '.') }}</td>
                    <td>Rp {{ number_format($payment->admin_transfer, 0, ',', '.') }}</td>
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

    <!-- Modal Edit -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Modal</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <form method="POST" action="{{ route('update') }}" autocomplete="off">
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
                      <label for="jenisLayanan" class="form-label">Jenis Layanan</label>
                      <select name="jenis_layanan" class="form-select" id="editJenisLayanan" required>
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
                    <input list="bankList" id="editNamaBank" name="nama_bank" class="form-control" placeholder="Pilih atau ketik nama bank" required>
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
        document.getElementById('editNamaBank').value = namaBank;
        document.getElementById('editNomorRekening').value = nomorRekening;
        document.getElementById('editAtasNama').value = atasNama;
        document.getElementById('editJumlahTransfer').value = jumlahTransfer;
        document.getElementById('editAdminTransfer').value = adminTransfer;
      });

        function toggleDateFields() {
            const filterType = document.getElementById('filter_type').value;
            const harianFields = document.getElementById('harian-fields');
            const bulananFields = document.getElementById('bulanan-fields');

            const tanggalInput = document.getElementById('tanggal');
            const bulanSelect = document.getElementById('bulan');

            if (filterType === 'semua') {
                harianFields.style.display = 'none';
                bulananFields.style.display = 'none';
            } else if (filterType === 'harian') {
                harianFields.style.display = 'block';
                bulananFields.style.display = 'none';

                // Set required atribut sesuai aktif
                //tanggalInput.required = true;
                //bulanSelect.required = false;
                //tahunSelect.required = false;
            } else {
                harianFields.style.display = 'none';
                bulananFields.style.display = 'flex';

                // Set required atribut sesuai aktif
                //tanggalInput.required = false;
                //bulanSelect.required = true;
                //tahunSelect.required = true;
            }
        }

        function getDayName(dateString) {
            const date = new Date(dateString);
            const daysOfWeek = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
            return daysOfWeek[date.getDay()]; // Mengembalikan nama hari berdasarkan indeks
        }

        function printTransaction(paymentId) {
            window.open('{{ route("print", ":id") }}'.replace(':id', paymentId), '_blank');
        }

        function filter(){
            const filterType = document.getElementById('filter_type').value;
            const tanggalInput = document.getElementById('tanggal').value;
            const bulanSelect = document.getElementById('bulan').value;
            const tahunSelect = document.getElementById('tahun').value;

            if(filterType === "semua"){
                    window.open('{{ route("list") }}', "_self");
            } else if (filterType == "harian"){
                if (tanggalInput !== ""){
                    let url = `/list?type=${filterType}&tanggal=${tanggalInput}`;
                    window.open(url, '_self');
                }
            } else {
                if(bulanSelect !== "Bulan" && tahunSelect !== "Tahun"){
                    let url = `/list?type=${filterType}&bulan=${bulanSelect}&tahun=${tahunSelect}`;
                    window.open(url, '_self');
                }
            }
        }
    </script>

@endsection
