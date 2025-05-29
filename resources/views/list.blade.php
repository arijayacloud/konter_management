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
                      <div class="bg-primary-subtle text-primary rounded px-3 py-2 me-3">
                        <i class="bi bi-bank fs-4"></i>
                      </div>
                      <div>
                        <h5 class="card-title mb-0">Admin Transfers</h5>
                        <small class="text-muted">Total from admin transfer</small>
                      </div>
                    </div>
                    <hr />
                    <h2 class="fw-bold text-dark">Rp {{ $totalPayment }}</h2>
                  </div>
                  <div class="w-100 h-[40px] bg-light">
                  </div>
                </div>
              </div>

            <div class="col">
                <div class="card shadow-md h-100 border-0 justify-content-between">
                  <div class="m-3 mb-0">
                    <div class="d-flex align-items-center mb-3">
                      <div class="bg-primary-subtle text-primary rounded px-3 py-2 me-3">
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
            <div class="table-responsive flex-grow-1 overflow-auto mb-3">
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
                  <tr>
                    <td>{{ $payment->tanggal }}</td>
                    <td>Tarik Tunai</td>
                    <td>AE CELL</td>
                    <td>BRI</td>
                    <td>6660001222</td>
                    <td>Dodi</td>
                    <td>Rp 1.000.000</td>
                    <td>Rp 10.000</td>
                    <td class="text-center">
                      <div class="btn-group" role="group">
                        <button class="btn btn-sm btn-outline-primary" title="Edit" data-bs-toggle="modal" data-bs-target="#exampleModal">
                          <i class="bi bi-pencil-square"></i>
                        </button>
                        <form action="{{ route('destroy', $payment->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this transaction?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger" title="Delete">
                              <i class="bi bi-trash"></i>
                            </button>
                        </form>
                        <button class="btn btn-sm btn-outline-secondary" title="Print">
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

          </div>
        </div>
    </main>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
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
