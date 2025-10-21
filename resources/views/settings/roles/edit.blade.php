@extends('layouts.base')

@section('title-head')
    <title>
        Sell Hub | Ubah Data Role
    </title>
@endsection

@section('breadcrumbs')
    <x-breadcrumb :items="[
        ['label' => 'Pengaturan', 'route' => route('settings.index')],
        ['label' => 'Manajemen Akses', 'route' => route('roles.index')],
        ['label' => 'Ubah Data Role', 'route' => route('roles.edit', $role)],
    ]" />
@endsection

@section('content')
    <div class="container-fluid py-2">
        <div class="row mt-4 d-flex justify-content-center">
            <div class="col-xl-8 col-md-12">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3">
                            <h6 class="text-white text-capitalize ps-3">Tambah Data Role</h6>
                        </div>
                    </div>
                    <form action="{{ route('roles.update', $role->uuid) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="card p-3">
                            <div class="mb-3">
                                <label for="name" class="form-label">Nama Role</label>
                                <input class="form-control border border-dark px-3" type="text" id="name"
                                    name="name" class="form-control" value="{{ old('name', $role->name) }}" required>
                                @error('name')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="code" class="form-label">Kode Role</label>
                                <input class="form-control border border-dark px-3" type="text" id="code" name="code" class="form-control"
                                    value="{{ old('code', $role->code) }}" required>
                                @error('code')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="text-end">
                                <a href="{{ route('roles.index') }}" class="btn btn-secondary">Batal</a>
                                <button type="submit" class="btn btn-success">Simpan Perubahan</button>
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
