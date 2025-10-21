@extends('layouts.base')

@section('title-head')
    <title>
        Sell Hub | Produk
    </title>
@endsection

@section('breadcrumbs')
    <x-breadcrumb :items="[['label' => 'Produk', 'route' => route('products.index')]]" />
@endsection

@section('content')
    <div class="container-fluid py-2">
        <div class="row mb-4">
            <div class="ms-3">
                <h3 class="mb-0 h4 font-weight-bolder">Manajemen Produk</h3>
                <p class="mb-4">
                    Data & Detail Informasi Produk
                </p>
            </div>
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-header p-2 ps-3">
                        <div class="d-flex justify-content-between">
                            <div>
                                <p class="text-sm mb-0 text-capitalize">Total Kategori Produk</p>
                                <h4 class="mb-0">1</h4>
                            </div>
                            <div
                                class="icon icon-md icon-shape bg-gradient-dark shadow-dark shadow text-center border-radius-lg">
                                <i class="material-symbols-rounded opacity-10">weekend</i>
                            </div>
                        </div>
                    </div>
                    <hr class="dark horizontal my-0">
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-header p-2 ps-3">
                        <div class="d-flex justify-content-between">
                            <div>
                                <p class="text-sm mb-0 text-capitalize">Produk Low Stock</p>
                                <h4 class="mb-0">2300</h4>
                            </div>
                            <div
                                class="icon icon-md icon-shape bg-gradient-dark shadow-dark shadow text-center border-radius-lg">
                                <i class="material-symbols-rounded opacity-10">person</i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-header p-2 ps-3">
                        <div class="d-flex justify-content-between">
                            <div>
                                <p class="text-sm mb-0 text-capitalize">Produk Statistik</p>
                                <h4 class="mb-0">1</h4>
                            </div>
                            <div
                                class="icon icon-md icon-shape bg-gradient-dark shadow-dark shadow text-center border-radius-lg">
                                <i class="material-symbols-rounded opacity-10">leaderboard</i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6">
                <div class="card">
                    <div class="card-header p-2 ps-3">
                        <div class="d-flex justify-content-between">
                            <div>
                                <p class="text-sm mb-0 text-capitalize">Tren Penjualan</p>
                                <h4 class="mb-0">10</h4>
                            </div>
                            <div
                                class="icon icon-md icon-shape bg-gradient-dark shadow-dark shadow text-center border-radius-lg">
                                <i class="material-symbols-rounded opacity-10">weekend</i>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-lg-12 col-md-12 mb-md-0 mb-4">
                <div class="card">
                    <div class="card-header pb-0">
                        <div class="row align-items-center">
                            <div class="col-lg-6 col-md-6 col-12">
                                <h6>Data Produk</h6>
                                <p class="text-sm mb-0">
                                    <span class="font-weight-bold">Update Produk Per</span> 21 Oktober 2025
                                </p>
                            </div>

                            <div class="col-lg-6 col-md-6 col-12 text-end">
                                <a href="{{ route('products.create') }}" class="btn btn-success btn-sm me-2">
                                    <i class="fas fa-plus"></i> Tambah Produk
                                </a>
                                <a href="{{ route('categories.index') }}" class="btn btn-primary btn-sm me-2">
                                    <i class="fas fa-tags"> </i>Manajemen Kategori
                                </a>
                            </div>
                        </div>
                    </div>


                    <div class="card-body px-0 pb-2">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped align-middle">
                                <thead class="table-dark">
                                    <tr>
                                        <th scope="col" class="text-center">No</th>
                                        <th scope="col" class="text-center">Nama Produk</th>
                                        <th scope="col" class="text-center">Kode</th>
                                        <th scope="col" class="text-center">Merk</th>
                                        <th scope="col" class="text-center">Foto</th>
                                        <th scope="col" class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($products as $index => $product)
                                        <tr>
                                            <td class="text-center">{{ $index + 1 }}</td>
                                            <td class="text-center">{{ $product->name }}</td>
                                            <td class="text-center">{{ $product->code }}</td>
                                            <td class="text-center">{{ $product->merk }}</td>
                                            <td class="text-center">
                                                @if ($product->photo)
                                                    <img src="{{ asset('storage/' . $product->photo) }}"
                                                        alt="{{ $product->name }}"
                                                        style="width: 60px; height: 60px; object-fit: cover; border-radius: 8px;">
                                                @else
                                                    <span class="text-muted">Tidak ada</span>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                <a href="{{ route('products.edit', $product->uuid) }}"
                                                    class="btn btn-sm btn-secondary me-1">
                                                    <i class="fas fa-edit"></i> Edit
                                                </a>

                                                <button type="button" class="btn btn-sm btn-danger btn-open-delete-modal"
                                                    data-bs-toggle="modal" data-bs-target="#delete-confirmation-modal"
                                                    data-url="{{ route('products.destroy', $product->uuid ?? $product->id) }}"
                                                    data-name="{{ $product->name }}">
                                                    <i class="fas fa-trash"></i> Hapus
                                                </button>

                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center text-muted py-3">Belum ada produk</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- BEGIN: Delete Confirmation Modal -->
    <div id="delete-confirmation-modal" class="modal fade" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body text-center p-4">
                    <h5 class="mb-2">Apakah Anda yakin?</h5>
                    <p class="text-muted mb-2">Peringatan: Data ini akan dihapus secara permanen.</p>
                    <p class="fw-semibold" id="modal-item-name"></p>

                    <div class="d-flex justify-content-center gap-2 mt-3">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>

                        <form id="delete-form" action="#" method="POST" class="m-0 p-0">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Hapus</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- END: Delete Confirmation Modal -->
@endsection

@section('javascript')
    <script>
        document.getElementById('delete-confirmation-modal')
            .addEventListener('show.bs.modal', function(event) {
                const button = event.relatedTarget;
                if (!button) return;

                const url = button.getAttribute('data-url');
                const name = button.getAttribute('data-name') || '';

                this.querySelector('#modal-item-name').textContent = name ? ('Produk: ' + name) : '';
                this.querySelector('#delete-form').setAttribute('action', url);
            });
    </script>
@endsection
