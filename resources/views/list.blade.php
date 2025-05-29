@extends('layouts.app')

@section('content')
    <main class="container-fluid h-[100dvh] p-4 flex flex-column">
        <div class="row gap-4 mb-4">

            <div class="col">
                <div class="card shadow-md h-100 border-0">
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
                    <h2 class="fw-bold text-dark">20</h2>
                  </div>
                  <div class="w-100 h-[40px] bg-light">
                  </div>
                </div>
              </div>

            <div class="col">
                <div class="card shadow-md h-100 border-0">
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
                    <h2 class="fw-bold text-dark">Rp 1,000,000</h2>
                  </div>
                  <div class="w-100 h-[40px] bg-light">
                  </div>
                </div>
              </div>

            <div class="col">
                <div class="card shadow-md h-100 border-0">
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
                    <h2 class="fw-bold text-dark">40</h2>
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
                <div class="input-group">
                  <input type="text" class="form-control" placeholder="Search...">
                  <button class="btn btn-outline-light" type="button">
                    <i class="bi bi-search"></i>
                  </button>
                </div>
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
                  <tr>
                    <td>5/25/2025</td>
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
                        <button class="btn btn-sm btn-outline-danger" title="Delete">
                          <i class="bi bi-trash"></i>
                        </button>
                        <button class="btn btn-sm btn-outline-secondary" title="Print">
                          <i class="bi bi-printer"></i>
                        </button>
                      </div>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-end m-3">
              <nav aria-label="Page navigation">
                <ul class="pagination pagination-sm mb-0">
                  <li class="page-item"><a class="page-link" href="#">Previous</a></li>
                  <li class="page-item"><a class="page-link" href="#">1</a></li>
                  <li class="page-item active"><a class="page-link" href="#">2</a></li>
                  <li class="page-item"><a class="page-link" href="#">3</a></li>
                  <li class="page-item"><a class="page-link" href="#">Next</a></li>
                </ul>
              </nav>
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
        <form>
          <div class="modal-body">

                <div class="flex justify-content-between gap-3">
                  <div class="mb-3">
                    <label for="tanggal" class="form-label">Tanggal</label>
                    <input type="date" name="tanggal" class="form-control" id="tanggal">
                  </div>
                  <div class="mb-3">
                    <label for="jenisLayanan" class="form-label">Jenis Layanan</label>
                    <input type="text" name="jenisLayanan" class="form-control" id="jenisLayanan">
                  </div>
                </div>
                <div class="mb-3">
                    <label for="lokasiKonter" class="form-label">Lokasi Konter</label>
                    <input type="text" name="lokasiKonter" class="form-control" id="lokasiKonter">
                </div>
                <div class="flex justify-content-between gap-3">
                  <div class="mb-3">
                    <label for="namaBank" class="form-label">Nama Bank</label>
                    <input type="text" name="namaBank" class="form-control" id="namaBank">
                  </div>
                  <div class="mb-3">
                    <label for="nomorRekening" class="form-label">Nomor Rekening</label>
                    <input type="text" name="nomorRekening" class="form-control" id="nomorRekening">
                  </div>
                </div>
                <div class="mb-3">
                    <label for="atasNama" class="form-label">Atas Nama</label>
                    <input type="text" name="atasNama" class="form-control" id="atasNama">
                </div>
                <div class="flex justify-content-between gap-3">
                  <div class="mb-3">
                    <label for="jumlahTransfer" class="form-label">Jumlah Transfer</label>
                    <input type="text" name="jumlahTransfer" class="form-control" id="jumlahTransfer">
                  </div>
                  <div class="mb-3">
                    <label for="adminTransfer" class="form-label">Admin Transfer</label>
                    <input type="text" name="adminTransfer" class="form-control" id="adminTransfer">
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
