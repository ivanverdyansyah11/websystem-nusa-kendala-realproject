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
        <div class="row mb-4">
            <div
                class="col-12 d-flex flex-column flex-md-row justify-content-md-between align-items-end align-items-md-center">
                <form class="form-search d-flex gap-3" method="POST" action="{{ route('pemesanan.search') }}">
                    @csrf
                    <div class="wrapper-searching position-relative">
                        <input type="text" class="input-search" placeholder=" " name="tanggal_mulai">
                        <label class="d-flex align-items-center">
                            <img src="{{ asset('assets/img/button/search.svg') }}" alt="Searcing Icon"
                                class="img-fluid search-icon">
                            <p>Cari tanggal mulai..</p>
                        </label>
                    </div>
                    <div class="wrapper-searching position-relative">
                        <input type="text" class="input-search" placeholder=" " name="tanggal_akhir">
                        <label class="d-flex align-items-center">
                            <img src="{{ asset('assets/img/button/search.svg') }}" alt="Searcing Icon"
                                class="img-fluid search-icon">
                            <p>Cari tanggal mulai..</p>
                        </label>
                    </div>
                </form>
            </div>
        </div>
        <div class="row">
            @if ($kendaraans->count() == 0)
                <div class="col-12 text-center mt-5">
                    <p style="font-size: 0.913rem;">Tidak Ada Data Kendaraan!</p>
                </div>
            @else
                @foreach ($kendaraans as $kendaraan)
                    <div class="col-md-6 col-lg-4 col-xl-3 mb-4">
                        <div class="card-product">
                            <div class="wrapper-img d-flex justify-content-center align-items-center">
                                <img src="{{ asset('assets/img/kendaraan-images/' . $kendaraan->foto_kendaraan) }}"
                                    alt="Car Thumbnail Image" class="img-fluid product-img">
                            </div>
                            <div class="product-content">
                                <p class="product-name">{{ $kendaraan->nama_kendaraan }}</p>
                                <div class="wrapper-other d-flex align-items-center justify-content-between">
                                    <div class="wrapper-tahun d-flex align-items-center">
                                        <img src="{{ asset('assets/img/button/kendaraan.svg') }}" alt="Kendaraan Icon"
                                            class="img-fluid kendaraan-icon">
                                        <p class="product-year">{{ $kendaraan->tahun_pembuatan }}</p>
                                    </div>
                                    <h6 class="product-price">Rp. {{ $kendaraan->tarif_sewa_hari }}</h6>
                                </div>
                                <div class="wrapper-button d-flex">
                                    <a href="{{ route('kendaraan.detail', $kendaraan->id) }}"
                                        class="button-primary w-100">Detail</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
        <div class="col-12 d-flex justify-content-end mt-4">
            {{ $kendaraans->links() }}
        </div>
    </div>

    {{-- MODAL HAPUS BOOKING --}}
    <div class="modal modal-delete fade" id="hapusBookingModal" tabindex="-1" aria-labelledby="hapusBookingModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <h3 class="title">Hapus Booking</h3>
                <form id="hapusBooking" class="form d-inline-block w-100" method="POST">
                    @csrf
                    <p class="caption-description row-button">Konfirmasi Penghapusan Booking: Apakah Anda yakin ingin
                        menghapus booking ini?
                        Tindakan ini tidak dapat diurungkan, dan booking akan dihapus secara permanen dari sistem.
                    </p>
                    <div class="button-wrapper d-flex">
                        <button type="submit" class="button-primary">Hapus Booking</button>
                        <button type="button" class="button-reverse" data-bs-dismiss="modal">Batal Hapus</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- END MODAL HAPUS BOOKING --}}

    <script>
        $(document).on('click', '[data-bs-target="#hapusBookingModal"]', function() {
            let id = $(this).data('id');
            $('#hapusBooking').attr('action', '/pemesanan/hapus/' + id);
        });
    </script>
@endsection
