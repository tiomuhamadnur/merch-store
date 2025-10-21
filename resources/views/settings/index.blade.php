@extends('layouts.base')

@section('title-head')
    <title>
        Sell Hub | Pengaturan
    </title>
@endsection

@section('breadcrumbs')
    <x-breadcrumb :items="[['label' => 'Pengaturan', 'route' => route('settings.index')]]" />
@endsection

@section('content')
    <div class="container-fluid py-2">
        <div class="row">
            <div class="ms-3">
                <h3 class="mb-0 h4 font-weight-bolder">Pengaturan</h3>
                <p class="mb-4">
                    Manajemen User, Otorisasi Akses Web
                </p>
            </div>
            <div class="col-xl-12 mb-4">
                <div class="row">
                    <div class="col-md-6 col-6">
                        <a href="{{ route('users.index') }}">
                            <div class="card">
                                <div class="card-header mx-4 p-3 text-center">
                                    <div
                                        class="icon icon-shape icon-lg bg-gradient-dark shadow text-center border-radius-lg">
                                        <i class="material-symbols-rounded opacity-10">account_circle</i>
                                    </div>
                                </div>
                                <div class="card-body pt-0 p-3 text-center">
                                    <h6 class="text-center mb-0">Manajemen Pengguna</h6>
                                    <hr class="horizontal dark my-3">
                                    <h5 class="mb-0">12 Pengguna</h5>
                                    <span class="text-xs">Total Pengguna</span>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-6 col-6">
                        <a href="{{ route('roles.index') }}">
                            <div class="card">
                                <div class="card-header mx-4 p-3 text-center">
                                    <div
                                        class="icon icon-shape icon-lg bg-gradient-dark shadow text-center border-radius-lg">
                                        <i class="material-symbols-rounded opacity-10">quick_reference_all</i>
                                    </div>
                                </div>
                                <div class="card-body pt-0 p-3 text-center">
                                    <h6 class="text-center mb-0">Data Role</h6>
                                    <hr class="horizontal dark my-3">
                                    <h5 class="mb-0">Role & Pembatasan</h5>
                                    <span class="text-xs">Masterdat Role</span>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
