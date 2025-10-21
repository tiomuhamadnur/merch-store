@extends('layouts.base')

@section('title-head')
    <title>
        Sell Hub | Tambah Produk
    </title>
@endsection

@section('breadcrumbs')
    <x-breadcrumb :items="[
        ['label' => 'Produk', 'route' => route('products.index')],
        ['label' => 'Manajemen Produk', 'route' => route('products.create')],
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
                    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('POST')
                        <div class="card-body px-4 pb-4">
                            <div class="mb-3">
                                <label for="category_id" class="form-label fw-semibold">
                                    Kategori Produk
                                    <small class="text-muted"></small>
                                </label>
                                <select class="form-select border border-dark px-3" id="category_id" name="category_id"
                                    required>
                                    <option value="" selected>-- Pilih Kategori --</option>
                                    @foreach ($categories as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                                <div class="mt-2">
                                    <button type="button"
                                        class="btn btn-dark btn-sm w-100 d-flex align-items-center justify-content-center gap-2"
                                        data-bs-toggle="modal" data-bs-target="#addCategoryModal">
                                        <i class="fas fa-plus"></i> Tambah Kategori
                                    </button>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="address" class="form-label">Nama Produk</label>
                                <input class="form-control border border-dark px-3" id="name" name="name"
                                    rows="1" placeholder="Masukkan Nama Produk" required></input>
                                @error('name')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="address" class="form-label">Kode Produk</label>
                                <input class="form-control border border-dark px-3" id="code" name="code"
                                    rows="1" placeholder="Masukkan Kode Produk" required></input>
                                @error('code')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="name" class="form-label">Merk Produk</label>
                                <input class="form-control border border-dark px-3" id="merk" name="merk"
                                    rows="1" placeholder="Masukkan Merk Produk" required></input>
                                @error('merk')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="photo" class="form-label">Dokumentasi (Photo)</label>
                                <input type="file" class="form-control border border-dark px-3" id="photo"
                                    name="photo" accept="image/*">
                                @error('photo')
                                    <div class="text-danger small">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="text-end">
                                <a class="btn btn-primary" href="{{ route('products.index') }}">
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

    <div class="modal fade" id="addCategoryModal" tabindex="-1" aria-labelledby="addCategoryLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <form id="addCategoryForm" action="{{ route('categories.store') }}" method="POST"
                class="modal-content border-0 shadow-sm rounded-3">
                @csrf
                <div class="modal-header rounded-top" style="bg-white">
                    <h5 class="modal-title d-flex align-items-center" id="addCategoryLabel">
                        <i class="fas fa-plus-circle me-2 text-dark"></i> Tambah Kategori Baru
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"
                        style="filter:invert(1) brightness(1.8);"></button>
                </div>

                <div class="modal-body">
                    <div id="addCategoryAlert" class="alert d-none mb-3" role="alert" aria-live="polite"></div>

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="category_name" class="form-label fw-semibold">Nama Kategori</label>
                            <input type="text" name="name" id="name"
                                class="form-control border border-dark rounded-2 px-3 py-2"
                                placeholder="Masukkan Nama kategori" required>
                            <div id="category_name_error" class="invalid-feedback d-none"></div>
                        </div>

                        <div class="col-md-6">
                            <label for="category_code" class="form-label fw-semibold">Kode Kategori</label>
                            <input type="text" name="code" id="code"
                                class="form-control border border-dark rounded-2 px-3 py-2"
                                placeholder="Masukkan Kode kategori" required>
                            <div id="category_code_error" class="invalid-feedback d-none"></div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button id="addCategorySubmit" type="submit"
                        class="btn btn-success d-flex align-items-center gap-2">
                        <span id="addCategorySpinner" class="spinner-border spinner-border-sm d-none" role="status"
                            aria-hidden="true"></span>
                        <span id="addCategoryText">Simpan</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('javascript')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const form = document.querySelector('#addCategoryForm');
            const modal = document.querySelector('#addCategoryModal');
            const alertBox = document.querySelector('#addCategoryAlert');
            const btn = document.querySelector('#addCategorySubmit');
            const spinner = document.querySelector('#addCategorySpinner');
            const text = document.querySelector('#addCategoryText');

            const showAlert = (type, message) => {
                alertBox.className = `alert alert-${type}`;
                alertBox.textContent = message;
                alertBox.classList.remove('d-none');
            };

            const setLoading = (state) => {
                btn.disabled = state;
                spinner.classList.toggle('d-none', !state);
                text.textContent = state ? 'Menyimpan...' : 'Simpan';
            };

            form.addEventListener('submit', async (e) => {
                e.preventDefault();
                showAlert('info', '');
                setLoading(true);

                const formData = new FormData(form);
                const csrf = document.querySelector('meta[name="csrf-token"]')?.content || '';

                try {
                    const res = await fetch(form.action, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': csrf,
                            'Accept': 'application/json'
                        },
                        body: formData,
                        credentials: 'same-origin'
                    });

                    let data = null;
                    const textResp = await res.text();
                    try {
                        data = JSON.parse(textResp);
                    } catch (err) {}

                    if (res.ok) {
                        showAlert('success', (data && data.message) ? data.message :
                            'Kategori berhasil disimpan.');
                        form.reset();

                        const redirectURL = data && data.redirect ? data.redirect : null;

                        const bsModal = (window.bootstrap && bootstrap.Modal) ? bootstrap.Modal
                            .getInstance(modal) || new bootstrap.Modal(modal) : null;

                        const doRedirectOrReload = () => {
                            if (redirectURL) {
                                window.location.href = redirectURL;
                            } else {
                                window.location.reload();
                            }
                        };

                        if (bsModal) {
                            const onHidden = () => {
                                modal.removeEventListener('hidden.bs.modal', onHidden);
                                doRedirectOrReload();
                            };
                            modal.addEventListener('hidden.bs.modal', onHidden);
                            bsModal.hide();
                        } else {
                            modal.classList.remove('show');
                            modal.style.display = 'none';
                            document.querySelectorAll('.modal-backdrop').forEach(b => b.remove());
                            document.body.classList.remove('modal-open');
                            setTimeout(doRedirectOrReload, 200);
                        }

                        if (window.onCategoryCreated) window.onCategoryCreated(data?.category ?? null);

                    } else if (res.status === 422 && data) {
                        const errors = data.errors || {};
                        showAlert('danger', Object.values(errors).flat().join(' ') || data.message ||
                            'Validasi gagal');
                    } else {
                        showAlert('danger', (data && data.message) ? data.message :
                            'Terjadi kesalahan.');
                    }
                } catch (err) {
                    console.error(err);
                    showAlert('danger', 'Gagal menghubungi server.');
                } finally {
                    setLoading(false);
                }
            });
        });
    </script>
@endsection
