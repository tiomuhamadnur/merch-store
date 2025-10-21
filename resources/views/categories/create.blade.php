@extends('layouts.base')

@section('title-head')
    <title>
        Sell Hub | Tambah Role
    </title>
@endsection

@section('breadcrumbs')
    <x-breadcrumb :items="[
        ['label' => 'Produk', 'route' => route('products.index')],
        ['label' => 'Manajemen Kategori', 'route' => route('categories.index')],
        ['label' => 'Tambah Data Kategori', 'route' => route('categories.create')],
    ]" />
@endsection

@section('content')
    <div class="container-fluid py-2">
        <div class="row mt-4 d-flex justify-content-center">
            <div class="col-xl-8 col-md-12">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3">
                            <h6 class="text-white text-capitalize ps-3">Tambah Data Kategori</h6>
                        </div>
                    </div>
                    <form action="{{ route('roles.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('POST')
                        <div class="card-body px-4 pb-4">
                            <div class="mb-3">
                                <label for="address" class="form-label">Nama Kategori</label>
                                <input class="form-control border border-dark px-3" id="name" name="name"
                                    rows="1" placeholder="Masukkan Nama Kategori" required></input>
                                @error('name')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="address" class="form-label">Kode Role</label>
                                <input class="form-control border border-dark px-3" id="code" name="code"
                                    rows="1" placeholder="Masukkan Kode Kategori" required></input>
                                @error('code')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="text-end">
                                <a class="btn btn-secondary" href="{{ route('categories.index') }}">
                                    <i class="fas fa-times me-1"></i> Batal
                                </a>
                                <button type="submit" class="btn btn-success">
                                    <i class="fas fa-save me-1"></i> Simpan
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('javascript')
@endsection
