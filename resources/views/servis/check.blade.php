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
                <h5 class="subtitle">Servis Kendaraan</h5>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <form class="form d-inline-block w-100" action="{{ route('servis.check.action', $kendaraan->id) }}"
                    method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 mb-5">
                            <div class="input-wrapper">
                                <div class="wrapper d-flex gap-3 align-items-end">
                                    <img src="{{ asset('assets/img/kendaraan-images/' . $kendaraan->foto_kendaraan) }}"
                                        class="img-fluid tag-create-image" alt="Kendaraan Image" width="80">
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <div class="input-wrapper">
                                        <label for="nama_kendaraan">Nama Kendaraan</label>
                                        <input type="text" id="nama_kendaraan" class="input" autocomplete="off" disabled
                                            value="{{ $kendaraan->nama_kendaraan }}">
                                    </div>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <div class="input-wrapper">
                                        <label for="kategori_kilometer">Kategori Kilometer</label>
                                        <input type="text" id="kategori_kilometer" class="input" autocomplete="off"
                                            disabled value="{{ $kendaraan->kilometer_kendaraan->jumlah }}">
                                    </div>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <div class="input-wrapper">
                                        <label for="tanggal_servis">Tanggal Servis</label>
                                        <input type="date" id="tanggal_servis" name="tanggal_servis" class="input"
                                            autocomplete="off">
                                        @error('tanggal_servis')
                                            <p class="caption-error mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <div class="input-wrapper">
                                        <label for="kilometer_sebelum">Kilometer Sebelum</label>
                                        <input type="text" id="kilometer_sebelum" name="kilometer_sebelum" class="input"
                                            autocomplete="off" value="{{ $kendaraan->kilometer }}">
                                        @error('kilometer_sebelum')
                                            <p class="caption-error mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <div class="input-wrapper">
                                        <label for="kilometer_setelah">Kilometer Setelah</label>
                                        <input type="text" id="kilometer_setelah" name="kilometer_setelah" class="input"
                                            autocomplete="off" value="{{ $kendaraan->kilometer_saat_ini }}">
                                        @error('kilometer_setelah')
                                            <p class="caption-error mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <div class="input-wrapper">
                                        <label for="air_accu">Air Accu</label>
                                        <select id="air_accu" class="input" name="air_accu">
                                            <option value="-">Pilih kondisi air accu</option>
                                            <option value="ada">Ada</option>
                                            <option value="tidak ada">Tidak Ada</option>
                                            <option value="kosong">Kosong</option>
                                        </select>
                                        @error('air_accu')
                                            <p class="caption-error mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <div class="input-wrapper">
                                        <label for="air_waiper">Air Waiper</label>
                                        <select id="air_waiper" class="input" name="air_waiper">
                                            <option value="-">Pilih kondisi air waiper</option>
                                            <option value="ada">Ada</option>
                                            <option value="tidak ada">Tidak Ada</option>
                                            <option value="kosong">Kosong</option>
                                        </select>
                                        @error('air_waiper')
                                            <p class="caption-error mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <div class="input-wrapper">
                                        <label for="ban">Ban</label>
                                        <select id="ban" class="input" name="ban">
                                            <option value="-">Pilih kondisi ban</option>
                                            <option value="ada">Ada</option>
                                            <option value="tidak ada">Tidak Ada</option>
                                            <option value="kosong">Kosong</option>
                                        </select>
                                        @error('ban')
                                            <p class="caption-error mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <div class="input-wrapper">
                                        <label for="oli">Oli</label>
                                        <select id="oli" class="input" name="oli">
                                            <option value="-">Pilih kondisi oli</option>
                                            <option value="ada">Ada</option>
                                            <option value="tidak ada">Tidak Ada</option>
                                            <option value="kosong">Kosong</option>
                                        </select>
                                        @error('oli')
                                            <p class="caption-error mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 mb-4">
                                    <div class="input-wrapper">
                                        <label for="total_bayar">Total Bayar</label>
                                        <input type="text" id="total_bayar" class="input" autocomplete="off"
                                            name="total_bayar">
                                        @error('total_bayar')
                                            <p class="caption-error mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 row-button">
                                    <div class="input-wrapper">
                                        <label for="keterangan">Keterangan</label>
                                        <input type="text" id="keterangan" class="input" autocomplete="off"
                                            name="keterangan">
                                        @error('keterangan')
                                            <p class="caption-error mt-2">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="button-wrapper d-flex">
                                        <button type="submit" class="button-primary">Servis Kendaraan</button>
                                        <a href="{{ route('servis') }}" class="button-reverse">Batal
                                            Servis</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
