@extends('layouts.app')

@section('content')
    <main class="container-fluid">
        <div class="row gap-4 mb-4">
            <div class="col">
                <div class="card shadow-sm h-100 border-0">
                  <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                      <div class="bg-primary-subtle text-primary rounded-circle px-3 py-2 me-3">
                        <i class="bi bi-cash-stack fs-4"></i>
                      </div>
                      <div>
                        <h5 class="card-title mb-0">Total Transaction</h5>
                        <small class="text-muted">From store transaction</small>
                      </div>
                    </div>
                    <h2 class="fw-bold text-dark">20</h2>
                  </div>
                </div>
              </div>

              <!-- Card 2 -->
              <div class="col">
                <div class="card shadow-sm h-100 border-0">
                  <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                      <div class="bg-success-subtle text-success rounded-circle px-3 py-2 me-3">
                        <i class="bi bi-bank fs-4"></i>
                      </div>
                      <div>
                        <h5 class="card-title mb-0">Admin Transfers</h5>
                        <small class="text-muted">Total from admin transfer</small>
                      </div>
                    </div>
                    <h2 class="fw-bold text-dark">Rp 1,000,000</h2>
                  </div>
                </div>
              </div>
        </div>
        <div class="row bg-white shadow-sm rounded-3 p-4 h-[75dvh]">
          <div class="col d-flex flex-column h-100">

            <!-- Header -->
            <div class="d-flex flex-wrap justify-content-between align-items-center mb-3">
              <div>
                <h4 class="mb-1">Transaction</h4>
                <p class="text-muted mb-0">Latest transactions sales in time</p>
              </div>
              <div class="d-flex gap-2">
                <button type="button" class="btn btn-primary d-flex align-items-center">
                  <i class="bi bi-plus me-2"></i> Add
                </button>
                <div class="input-group">
                  <input type="text" class="form-control" placeholder="Search...">
                  <button class="btn btn-outline-primary" type="button">
                    <i class="bi bi-search"></i>
                  </button>
                </div>
              </div>
            </div>

            <!-- Table -->
            <div class="table-responsive flex-grow-1 overflow-auto mb-3">
              <table class="table table-hover align-middle">
                <thead class="table-light sticky-top">
                  <tr>
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
                        <button class="btn btn-sm btn-outline-primary" title="Edit">
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
            <div class="d-flex justify-content-end">
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
@endsection
