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
                <h5 class="subtitle">Tambah Pelanggan</h5>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <form class="form d-inline-block w-100">
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
                                {{-- @error('image')
                                    <p class="caption-error mt-2">{{ $message }}</p>
                                @enderror --}}
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-4 col-xl-3 mb-5">
                            <div class="input-wrapper">
                                <div class="wrapper d-flex gap-3 align-items-end">
                                    <img src="{{ asset('assets/img/default/image-notfound.svg') }}"
                                        class="img-fluid tag-create-kk" alt="KK Image" width="80">
                                    <div class="wrapper-image w-100">
                                        <input type="file" id="image" class="input-create-kk" name="foto_kk"
                                            style="opacity: 0;">
                                        <button type="button" class="button-reverse button-create-kk">Pilih Foto
                                            KK</button>
                                    </div>
                                </div>
                                {{-- @error('image')
                                    <p class="caption-error mt-2">{{ $message }}</p>
                                @enderror --}}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-4">
                                <div class="input-wrapper">
                                    <label for="nama">Nama</label>
                                    <input type="text" id="nama" class="input" autocomplete="off">
                                </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <div class="input-wrapper">
                                    <label for="nik">NIK</label>
                                    <input type="text" id="nik" class="input" autocomplete="off">
                                </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <div class="input-wrapper">
                                    <label for="nomor_telepon">Nomor Telepon</label>
                                    <input type="text" id="nomor_telepon" class="input" autocomplete="off">
                                </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <div class="input-wrapper">
                                    <label for="nomor_ktp">Nomor KTP</label>
                                    <input type="text" id="nomor_ktp" class="input" autocomplete="off">
                                </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <div class="input-wrapper">
                                    <label for="nomor_kk">Nomor KK</label>
                                    <input type="text" id="nomor_kk" class="input" autocomplete="off">
                                </div>
                            </div>
                            <div class="col-md-6 row-button">
                                <div class="input-wrapper">
                                    <label for="alamat">Alamat</label>
                                    <input type="text" id="alamat" class="input" autocomplete="off">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="button-wrapper d-flex">
                                    <button type="submit" class="button-primary">Tambah Pelanggan</button>
                                    <a href="{{ route('pelanggan') }}" class="button-reverse">Batal
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

        const tagCreateKK = document.querySelector('.tag-create-kk');
        const inputCreateKK = document.querySelector('.input-create-kk');
        const buttonCreateKK = document.querySelector('.button-create-kk');

        buttonCreateKTP.addEventListener('click', function() {
            inputCreateKTP.click();
        });

        inputCreateKTP.addEventListener('change', function() {
            tagCreateKTP.src = URL.createObjectURL(inputCreateKTP.files[0]);
        });

        buttonCreateKK.addEventListener('click', function() {
            inputCreateKK.click();
        });

        inputCreateKK.addEventListener('change', function() {
            tagCreateKK.src = URL.createObjectURL(inputCreateKK.files[0]);
        });
    </script>
@endsection