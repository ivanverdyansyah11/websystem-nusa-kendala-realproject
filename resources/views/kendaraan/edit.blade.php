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
                <h5 class="subtitle">Edit Kendaraan</h5>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <form class="form d-inline-block w-100" method="POST"
                    action="{{ route('kendaraan.update', $kendaraan->id) }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 mb-5">
                            <div class="input-wrapper">
                                <div class="wrapper d-flex gap-3 align-items-end">
                                    <img src="{{ asset('assets/img/kendaraan-images/' . $kendaraan->foto_kendaraan) }}"
                                        class="img-fluid tag-edit-image" alt="Kendaraan Image" width="80">
                                    <div class="wrapper-image w-100">
                                        <input type="file" id="image" class="input-edit-image" name="foto_kendaraan"
                                            style="opacity: 0;">
                                        <button type="button" class="button-reverse button-edit-image">Pilih Foto
                                            Kendaraan</button>
                                    </div>
                                </div>
                                @error('foto_kendaraan')
                                    <p class="caption-error mt-2">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <div class="input-wrapper">
                                        <label for="stnk_nama">STNK Atas Nama</label>
                                        <input type="text" required id="stnk_nama" class="input" autocomplete="off"
                                            value="{{ $kendaraan->stnk_nama }}" name="stnk_nama">
                                    </div>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <div class="input-wrapper">
                                        <label for="nomor_plat">Nomor Plat</label>
                                        <input type="text" required id="nomor_plat" class="input" autocomplete="off"
                                            value="{{ $kendaraan->nomor_plat }}" name="nomor_plat">
                                    </div>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <div class="input-wrapper">
                                        <label for="jenis_kendaraan">Jenis Kendaraan</label>
                                        <select id="jenis_kendaraan" class="input">
                                            @foreach ($jenises as $jenis)
                                                <option value="{{ $jenis->id }}"
                                                    {{ $kendaraan->jenis_kendaraan->id == $jenis->id ? 'selected' : '' }}>
                                                    {{ $jenis->nama }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <div class="input-wrapper">
                                        <label for="brand_kendaraan">Brand Kendaraan</label>
                                        <select id="brand_kendaraan" class="input">
                                            @foreach ($brands as $brand)
                                                <option value="{{ $brand->id }}"
                                                    {{ $kendaraan->brand_kendaraan->id == $brand->id ? 'selected' : '' }}>
                                                    {{ $brand->nama }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <div class="input-wrapper">
                                        <label for="seri_kendaraans_id">Nomor Seri</label>
                                        <select required id="seri_kendaraans_id" class="input" name="seri_kendaraans_id">
                                            @foreach ($series as $seri)
                                                @if ($kendaraan->seri_kendaraans_id == $seri->id)
                                                    <option value="{{ $seri->id }}" selected>{{ $seri->nomor_seri }}
                                                    </option>
                                                @else
                                                    <option value="{{ $seri->id }}">{{ $seri->nomor_seri }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                        @error('seri_kendaraans_id')
                                            <p class="caption-error mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <div class="input-wrapper">
                                        <label for="kilometerData">Kategori Kilometer</label>
                                        <select required id="kilometerData" class="input"
                                            name="kategori_kilometer_kendaraans_id">
                                            @foreach ($kilometers as $kilometer)
                                                @if ($kendaraan->kategori_kilometer_kendaraans_id == $kilometer->id)
                                                    <option value="{{ $kilometer->id }}" selected>{{ $kilometer->jumlah }}
                                                    </option>
                                                @else
                                                    <option value="{{ $kilometer->id }}">{{ $kilometer->jumlah }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                        @error('kategori_kilometer_kendaraans_id')
                                            <p class="caption-error mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <div class="input-wrapper">
                                        <label for="kilometer">Kilometer</label>
                                        <input type="number" required id="kilometer" class="input" autocomplete="off"
                                            value="{{ $kendaraan->kilometer_saat_ini }}" name="kilometer">
                                        @error('kilometer')
                                            <p class="caption-error mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <div class="input-wrapper">
                                        <label for="tarif_sewa_hari">Tarif Sewa Harian</label>
                                        <input type="number" required id="tarif_sewa_hari" class="input"
                                            autocomplete="off" value="{{ $kendaraan->tarif_sewa_hari }}"
                                            name="tarif_sewa_hari">
                                        @error('tarif_sewa_hari')
                                            <p class="caption-error mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <div class="input-wrapper">
                                        <label for="tarif_sewa_minggu">Tarif Sewa Mingguan</label>
                                        <input type="number" required id="tarif_sewa_minggu" class="input"
                                            autocomplete="off" value="{{ $kendaraan->tarif_sewa_minggu }}"
                                            name="tarif_sewa_minggu">
                                        @error('tarif_sewa_minggu')
                                            <p class="caption-error mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <div class="input-wrapper">
                                        <label for="tarif_sewa_bulan">Tarif Sewa Bulanan</label>
                                        <input type="number" required id="tarif_sewa_bulan" class="input"
                                            autocomplete="off" value="{{ $kendaraan->tarif_sewa_bulan }}"
                                            name="tarif_sewa_bulan">
                                        @error('tarif_sewa_bulan')
                                            <p class="caption-error mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <div class="input-wrapper">
                                        <label for="tahun_pembuatan">Tahun Pembuatan</label>
                                        <input type="text" required id="tahun_pembuatan" class="input"
                                            autocomplete="off" value="{{ $kendaraan->tahun_pembuatan }}"
                                            name="tahun_pembuatan" minlength="0" maxlength="4" pattern="[0-9]*"
                                            title="Hanya angka 0-9 diperbolehkan">
                                        @error('tahun_pembuatan')
                                            <p class="caption-error mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <div class="input-wrapper">
                                        <label for="tanggal_pembelian">Tanggal Pembelian</label>
                                        <input type="date" required id="tanggal_pembelian" class="input"
                                            autocomplete="off" value="{{ $kendaraan->tanggal_pembelian }}"
                                            name="tanggal_pembelian">
                                        @error('tanggal_pembelian')
                                            <p class="caption-error mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <div class="input-wrapper">
                                        <label for="warna">Warna</label>
                                        <input type="text" required id="warna" class="input" autocomplete="off"
                                            value="{{ $kendaraan->warna }}" name="warna">
                                        @error('warna')
                                            <p class="caption-error mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <div class="input-wrapper">
                                        <label for="nomor_rangka">Nomor Rangka</label>
                                        <input type="text" required id="nomor_rangka" class="input"
                                            autocomplete="off" value="{{ $kendaraan->nomor_rangka }}"
                                            name="nomor_rangka">
                                        @error('nomor_rangka')
                                            <p class="caption-error mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 row-button">
                                    <div class="input-wrapper">
                                        <label for="nomor_mesin">Nomor Mesin</label>
                                        <input type="text" required id="nomor_mesin" class="input"
                                            autocomplete="off" value="{{ $kendaraan->nomor_mesin }}" name="nomor_mesin">
                                        @error('nomor_mesin')
                                            <p class="caption-error mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="button-wrapper d-flex">
                                        <button type="submit" class="button-primary">Simpan Perubahan</button>
                                        <a href="{{ route('kendaraan') }}" class="button-reverse">Batal
                                            Edit</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        $("#kilometerData").select2({
            theme: "bootstrap-5",
        });

        $("#jenis_kendaraan").select2({
            theme: "bootstrap-5",
        });

        $("#brand_kendaraan").select2({
            theme: "bootstrap-5",
        });

        $("#seri_kendaraans_id").select2({
            theme: "bootstrap-5",
        });

        $("#jenis_kendaraan").change(function() {
            let idJenis = $(this).val();
            let idBrand = $("#brand_kendaraan").val();
            $('#seri_kendaraans_id option').remove();
            $.ajax({
                type: 'get',
                url: '/kendaraan/getSeriKendaraan/' + idJenis + '/' + idBrand,
                success: function(data) {
                    if (data.length == 0) {
                        $('#seri_kendaraans_id').append(
                            `<option value="">Data nomor seri tidak ditemukan!</option>`
                        );
                    } else {
                        $('#seri_kendaraans_id').append(
                            `<option value="">Pilih nomor seri!</option>`
                        );
                        data.forEach(nomorSeri => {
                            $('#seri_kendaraans_id').append(
                                `<option value="${nomorSeri.id}">${nomorSeri.nomor_seri}</option>`
                            );
                        });
                    }
                }
            });
        });

        $("#brand_kendaraan").change(function() {
            let idBrand = $(this).val();
            let idJenis = $("#jenis_kendaraan").val();
            $('#seri_kendaraans_id option').remove();
            $.ajax({
                type: 'get',
                url: '/kendaraan/getSeriKendaraan/' + idJenis + '/' + idBrand,
                success: function(data) {
                    if (data.length == 0) {
                        $('#seri_kendaraans_id').append(
                            `<option value="">Data nomor seri tidak ditemukan!</option>`
                        );
                    } else {
                        $('#seri_kendaraans_id').append(
                            `<option value="">Pilih nomor seri!</option>`
                        );
                        data.forEach(nomorSeri => {
                            $('#seri_kendaraans_id').append(
                                `<option value="${nomorSeri.id}">${nomorSeri.nomor_seri}</option>`
                            );
                        });
                    }
                }
            });
        });

        const tagEditKendaraan = document.querySelector('.tag-edit-image');
        const inputEditKendaraan = document.querySelector('.input-edit-image');
        const buttonEdit = document.querySelector('.button-edit-image');

        buttonEdit.addEventListener('click', function() {
            inputEditKendaraan.click();
        });

        inputEditKendaraan.addEventListener('change', function() {
            tagEditKendaraan.src = URL.createObjectURL(inputEditKendaraan.files[0]);
        });

        $("#seriData").change(function() {
            let id = $(this).val();
            $.ajax({
                type: 'get',
                url: '/kendaraan/getSeriKendaraan/' + id,
                success: function(data) {
                    $('[data-value="jenis_kendaraan"]').val(data.jenis_kendaraan.nama);
                    $('[data-value="brand_kendaraan"]').val(data.brand_kendaraan.nama);
                }
            });
        });
    </script>
@endsection
