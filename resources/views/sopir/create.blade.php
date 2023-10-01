@extends('template.main')

@section('content')
    <div class="content">
        <div class="row">
            <div class="col-12">
                @if (session()->has('success'))
                    <div class="alert alert-success mb-4" role="alert">
                        {{ session('success') }}
                    </div>
                @elseif(session()->has('failed'))
                    <div class="alert alert-danger mb-4" role="alert">
                        {{ session('failed') }}
                    </div>
                @endif
            </div>
        </div>
        <div class="row" style="margin-bottom: 32px">
            <div class="col-12 d-flex justify-content-between align-items-center">
                <h5 class="subtitle">Tambah Sopir</h5>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <form class="form d-inline-block w-100" method="POST" action="{{ route('sopir.store') }}"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 col-lg-4 col-xl-3 mb-5">
                            <div class="input-wrapper">
                                <div class="wrapper d-flex gap-3 align-items-end">
                                    <img src="{{ asset('assets/img/default/image-notfound.svg') }}"
                                        class="img-fluid tag-create-ktp" alt="KTP Image" width="80">
                                    <div class="wrapper-image w-100">
                                        <input type="file" id="image" class="input-create-ktp" name="foto_ktp"
                                            style="opacity: 0;">
                                        <button type="button" class="button-reverse button-create-ktp">Pilih Foto
                                            KTP</button>
                                    </div>
                                </div>
                                @error('foto_ktp')
                                    <p class="caption-error mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4 col-xl-3 mb-5">
                            <div class="input-wrapper">
                                <div class="wrapper d-flex gap-3 align-items-end">
                                    <img src="{{ asset('assets/img/default/image-notfound.svg') }}"
                                        class="img-fluid tag-create-sim" alt="SIM Image" width="80">
                                    <div class="wrapper-image w-100">
                                        <input type="file" id="image" class="input-create-sim" name="foto_sim"
                                            style="opacity: 0;">
                                        <button type="button" class="button-reverse button-create-sim">Pilih Foto
                                            SIM</button>
                                    </div>
                                </div>
                                @error('foto_sim')
                                    <p class="caption-error mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <div class="input-wrapper">
                                    <label for="nama">Nama</label>
                                    <input type="text" id="nama" class="input" autocomplete="off" name="nama">
                                    @error('nama')
                                        <p class="caption-error mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <div class="input-wrapper">
                                    <label for="nik">NIK</label>
                                    <input type="number" id="nik" class="input" autocomplete="off" name="nik">
                                    @error('nik')
                                        <p class="caption-error mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <div class="input-wrapper">
                                    <label for="nomor_telepon">Nomor Telepon</label>
                                    <input type="number" id="nomor_telepon" class="input" autocomplete="off"
                                        name="nomor_telepon">
                                    @error('nomor_telepon')
                                        <p class="caption-error mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <div class="input-wrapper">
                                    <label for="nomor_ktp">Nomor KTP</label>
                                    <input type="number" id="nomor_ktp" class="input" autocomplete="off" name="nomor_ktp">
                                    @error('nomor_ktp')
                                        <p class="caption-error mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <div class="input-wrapper">
                                    <label for="nomor_sim">Nomor SIM</label>
                                    <input type="number" id="nomor_sim" class="input" autocomplete="off" name="nomor_sim">
                                    @error('nomor_sim')
                                        <p class="caption-error mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 row-button">
                                <div class="input-wrapper">
                                    <label for="alamat">Alamat</label>
                                    <input type="text" id="alamat" class="input" autocomplete="off"
                                        name="alamat">
                                    @error('alamat')
                                        <p class="caption-error mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="button-wrapper d-flex">
                                    <button type="submit" class="button-primary">Tambah Sopir</button>
                                    <a href="{{ route('sopir') }}" class="button-reverse">Batal
                                        Tambah</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        const tagCreateKTP = document.querySelector('.tag-create-ktp');
        const inputCreateKTP = document.querySelector('.input-create-ktp');
        const buttonCreateKTP = document.querySelector('.button-create-ktp');

        const tagCreateSIM = document.querySelector('.tag-create-sim');
        const inputCreateSIM = document.querySelector('.input-create-sim');
        const buttonCreateSIM = document.querySelector('.button-create-sim');

        buttonCreateKTP.addEventListener('click', function() {
            inputCreateKTP.click();
        });

        inputCreateKTP.addEventListener('change', function() {
            tagCreateKTP.src = URL.createObjectURL(inputCreateKTP.files[0]);
        });

        buttonCreateSIM.addEventListener('click', function() {
            inputCreateSIM.click();
        });

        inputCreateSIM.addEventListener('change', function() {
            tagCreateSIM.src = URL.createObjectURL(inputCreateSIM.files[0]);
        });
    </script>
@endsection
