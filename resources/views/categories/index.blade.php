@extends('layouts.base')

@section('title-head')
    <title>
        Sell Hub | Kategori Produk
    </title>
@endsection

@section('breadcrumbs')
    <x-breadcrumb :items="[['label' => 'Produk', 'route' => route('products.index')]]" />
    <x-breadcrumb :items="[['label' => 'Manajemen Kategori', 'route' => route('categories.index')]]" />
@endsection

@section('content')
    <div class="container-fluid py-2">
        <div class="row mb-4">
            <div class="ms-3">
                <h3 class="mb-0 h4 font-weight-bolder">Manajemen Kategori</h3>
                <p class="mb-4">
                    Data & Manajemen Kategori
                </p>
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
                                <a href="{{ route('categories.create') }}" class="btn btn-success btn-sm me-2">
                                    <i class="fas fa-plus"></i> Tambah Kategori
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
                                        <th scope="col" class="text-center">Nama Kategori</th>
                                        <th scope="col" class="text-center">Kode</th>
                                        <th scope="col" class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($categories as $index => $category)
                                        <tr>
                                            <td class="text-center">{{ $index + 1 }}</td>
                                            <td class="text-center">{{ $category->name }}</td>
                                            <td class="text-center">{{ $category->code }}</td>
                                            <td class="text-center">
                                                <a href="{{ route('categories.edit', $category->uuid) }}"
                                                    class="btn btn-sm btn-secondary me-1">
                                                    <i class="fas fa-edit"></i> Edit
                                                </a>

                                                <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                                    data-bs-target="#delete-confirmation-modal"
                                                    data-url="{{ route('categories.destroy', $category->uuid ?? $category->id) }}"
                                                    data-name="{{ $category->name }}">
                                                    <i class="fas fa-trash"></i> Hapus
                                                </button>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center text-muted py-3">Belum ada kategori</td>
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
                const url = button.getAttribute('data-url');
                const name = button.getAttribute('data-name') || '';

                this.querySelector('#modal-item-name').textContent = name ? ('Kategori: ' + name) : '';
                this.querySelector('#delete-form').setAttribute('action', url);
            });
    </script>
@endsection
