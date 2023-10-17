<?php

namespace App\Http\Controllers;

use App\Models\BrandKendaraan;
use App\Models\JenisKendaraan;
use App\Models\Kendaraan;
use App\Models\Laporan;
use App\Models\Pelanggan;
use App\Models\Pemesanan;
use App\Models\SeriKendaraan;
use App\Models\Sopir;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    function check()
    {
        $pelanggan = Pelanggan::where('status', 'ada')->where('kelengkapan_ktp', 'lengkap')->where('kelengkapan_kk', 'lengkap')->where('kelengkapan_nomor_telepon', 'lengkap')->count();
        $sopir = Sopir::where('status', 'ada')->where('kelengkapan_ktp', 'lengkap')->where('kelengkapan_sim', 'lengkap')->where('kelengkapan_nomor_telepon', 'lengkap')->count();
        $kendaraan = Kendaraan::whereIn('status', ['ready', 'booking'])->count();

        if ($pelanggan == 0) {
            return redirect(route('pemesanan'))->with('failed', 'Tidak Menemukan Pelanggan yang Ready, Tambahkan Pelanggan Baru!');
        } elseif ($sopir == 0) {
            return redirect(route('pemesanan'))->with('failed', 'Tidak Menemukan Sopir yang Ready, Tambahkan Sopir Baru!');
        } elseif ($kendaraan == 0) {
            return redirect(route('pemesanan'))->with('failed', 'Tidak Menemukan Kendaraan yang Ready atau Booking Untuk Booking, Tambahkan Kendaraan Baru!');
        }
    }

    function getKendaraanBySeri($idSeri)
    {
        $kendaraan = Kendaraan::where('seri_kendaraans_id', $idSeri)->whereIn('status', ['ready', 'booking'])->with('jenis_kendaraan', 'brand_kendaraan', 'seri_kendaraan')->get();
        return response()->json($kendaraan);
    }

    public function booking()
    {
        return view('pemesanan.create', [
            'title' => 'Booking',
            'kendaraans' => Kendaraan::where('status', 'ready')->orWhere('status', 'booking')->get(),
            'jenises' => JenisKendaraan::all(),
            'brands' => BrandKendaraan::all(),
            'series' => SeriKendaraan::all(),
            'pelanggans' => Pelanggan::where('status', 'ada')->where('kelengkapan_ktp', 'lengkap')->where('kelengkapan_kk', 'lengkap')->where('kelengkapan_nomor_telepon', 'lengkap')->get(),
            'sopirs' => Sopir::where('status', 'ada')->where('kelengkapan_ktp', 'lengkap')->where('kelengkapan_sim', 'lengkap')->where('kelengkapan_nomor_telepon', 'lengkap')->get(),
        ]);
    }

    function bookingAction(Request $request)
    {
        $pelangganCheck = Pemesanan::where('pelanggans_id', $request->pelanggans_id)
            ->where('kendaraans_id', $request->kendaraans_id)
            ->first();

        if ($pelangganCheck) {
            return redirect(route('booking.create'))->with('failed', 'Pelanggan ' . $pelangganCheck->pelanggan->nama . ' Sudah Booking Kendaraan Ini!');
        }

        $sopirCheck = Pemesanan::where('sopirs_id', $request->sopirs_id)
            ->whereDate('tanggal_mulai', '<=', $request->tanggal_mulai)
            ->whereDate('tanggal_akhir', '>=', $request->tanggal_akhir)
            ->first();

        if (!$sopirCheck) {
            $sopirCheck = Pemesanan::where('sopirs_id', $request->sopirs_id)
                ->whereBetween('tanggal_mulai', [$request->tanggal_mulai, $request->tanggal_akhir])
                ->first();

            if (!$sopirCheck) {
                $sopirCheck = Pemesanan::where('sopirs_id', $request->sopirs_id)
                    ->whereBetween('tanggal_akhir', [$request->tanggal_mulai, $request->tanggal_akhir])
                    ->first();
            }
        }

        $kendaraanCheck = Pemesanan::where('kendaraans_id', $request->kendaraans_id)
            ->whereDate('tanggal_mulai', '<=', $request->tanggal_mulai)
            ->whereDate('tanggal_akhir', '>=', $request->tanggal_akhir)
            ->first();

        if (!$kendaraanCheck) {
            $kendaraanCheck = Pemesanan::where('kendaraans_id', $request->kendaraans_id)
                ->whereBetween('tanggal_mulai', [$request->tanggal_mulai, $request->tanggal_akhir])
                ->first();

            if (!$kendaraanCheck) {
                $kendaraanCheck = Pemesanan::where('kendaraans_id', $request->kendaraans_id)
                    ->whereBetween('tanggal_akhir', [$request->tanggal_mulai, $request->tanggal_akhir])
                    ->first();
            }
        }

        if ($sopirCheck) {
            return redirect(route('booking.create'))->with('failed', 'Sopir ' . $sopirCheck->sopir->nama . ' Sudah Booking Pada Tanggal Ini!');
        } else if ($kendaraanCheck) {
            return redirect(route('booking.create'))->with('failed', 'Kendaraan ' . $kendaraanCheck->kendaraan->nomor_plat . ' Sudah Booking Pada Tanggal Ini!');
        }

        return $request;

        if ($request->pelanggans_id == '-' || $request->kendaraans_id == '-') {
            return redirect(route('booking.create'))->with('failed', 'Isi Form Input Pelanggan dan Kendaraan Terlebih Dahulu!');
        }

        $validatedData = $request->validate([
            'pelanggans_id' => 'required|string',
            'kendaraans_id' => 'required|string',
            'sopirs_id' => 'nullable|string',
            'total_harian' => 'required|string',
            'total_mingguan' => 'required|string',
            'total_bulanan' => 'required|string',
            'tanggal_mulai' => 'required|date',
            'tanggal_akhir' => 'required|date',
        ]);

        $validatedData['status'] = 'booking';

        if ($validatedData['sopirs_id'] === '-') {
            $validatedData['sopirs_id'] = null;
        } else {
            $validatedData['sopirs_id'] = (int)$validatedData['sopirs_id'];
        }

        if (is_string($validatedData['pelanggans_id'])) {
            $validatedData['pelanggans_id'] = (int)$validatedData['pelanggans_id'];
        }

        if (is_string($validatedData['kendaraans_id'])) {
            $validatedData['kendaraans_id'] = (int)$validatedData['kendaraans_id'];
        }

        $pemesanan = Pemesanan::create($validatedData);
        $pemesananID = Pemesanan::latest()->first();
        $kendaraan = Kendaraan::where('id', $validatedData['kendaraans_id'])->first()->update([
            'status' => 'booking',
        ]);

        $laporan = Laporan::create([
            'penggunas_id' => auth()->user()->id,
            'relations_id' => $pemesananID->id,
            'kategori_laporan' => 'booking',
        ]);

        if ($pemesanan && $kendaraan && $laporan) {
            return redirect(route('pemesanan'))->with('success', 'Berhasil Booking Kendaraan!');
        } else {
            return redirect(route('pemesanan'))->with('failed', 'Gagal Booking Kendaraan!');
        }
    }

    public function detail($id)
    {
        $pemesanan = Pemesanan::where('id', $id)->with('kendaraan', 'pelanggan', 'sopir')->first();

        return view('pemesanan.detail', [
            'title' => 'Booking',
            'pemesanan' => $pemesanan,
        ]);
    }

    public function edit($id)
    {
        $pemesanan = Pemesanan::where('id', $id)->with('kendaraan', 'pelanggan', 'sopir')->first();

        return view('pemesanan.edit', [
            'title' => 'Booking',
            'pemesanan' => $pemesanan,
            'kendaraans' => Kendaraan::where('status', 'ready')->orWhere('status', 'booking')->get(),
            'jenises' => JenisKendaraan::all(),
            'brands' => BrandKendaraan::all(),
            'series' => SeriKendaraan::all(),
            'pelanggans' => Pelanggan::where('status', 'ada')->where('kelengkapan_ktp', 'lengkap')->where('kelengkapan_kk', 'lengkap')->where('kelengkapan_nomor_telepon', 'lengkap')->get(),
            'sopirs' => Sopir::where('status', 'ada')->where('kelengkapan_ktp', 'lengkap')->where('kelengkapan_sim', 'lengkap')->where('kelengkapan_nomor_telepon', 'lengkap')->get(),
        ]);
    }

    function update($id, Request $request)
    {
        $pemesanan = Pemesanan::where('id', $id)->first();
        $kendaraan = Pemesanan::where('kendaraans_id', $pemesanan->kendaraans_id)->where('status', 'booking')->count();
        if ($kendaraan == 1) {
            Kendaraan::where('id', $pemesanan->kendaraans_id)->first()->update([
                'status' => 'ready',
            ]);
        }

        $validatedData = $request->validate([
            'pelanggans_id' => 'required|string',
            'kendaraans_id' => 'required|string',
            'sopirs_id' => 'nullable|string',
            'total_harian' => 'required|string',
            'total_mingguan' => 'required|string',
            'total_bulanan' => 'required|string',
            'tanggal_mulai' => 'required|date',
            'tanggal_akhir' => 'required|date',
        ]);

        $validatedData['status'] = 'booking';

        if ($validatedData['sopirs_id'] === '-') {
            $validatedData['sopirs_id'] = null;
        } else {
            $validatedData['sopirs_id'] = (int)$validatedData['sopirs_id'];
        }

        if (is_string($validatedData['pelanggans_id'])) {
            $validatedData['pelanggans_id'] = (int)$validatedData['pelanggans_id'];
        }

        if (is_string($validatedData['kendaraans_id'])) {
            $validatedData['kendaraans_id'] = (int)$validatedData['kendaraans_id'];
        }

        $pemesanan = $pemesanan->update($validatedData);
        $kendaraan = Kendaraan::where('id', $validatedData['kendaraans_id'])->first()->update([
            'status' => 'booking',
        ]);

        if ($pemesanan && $kendaraan) {
            return redirect(route('pemesanan'))->with('success', 'Berhasil Booking Kendaraan!');
        } else {
            return redirect(route('pemesanan'))->with('failed', 'Gagal Booking Kendaraan!');
        }
    }

    public function delete($id)
    {
        $pemesanan = Pemesanan::where('id', $id)->first();
        $pemesananCount = Pemesanan::where('kendaraans_id', $pemesanan->kendaraans_id)->count();

        $pelanggan = Pelanggan::where('id', $pemesanan->pelanggans_id)->first()->update([
            'status' => 'ada',
        ]);

        $laporan = Laporan::where('relations_id', $pemesanan->id)->where('kategori_laporan', 'booking')->first();
        $laporan = $laporan->delete();

        if ($pemesananCount == 1) {
            Kendaraan::where('id', $pemesanan->kendaraans_id)->first()->update([
                'status' => 'ready',
            ]);
        }

        $pemesanan = $pemesanan->delete();


        if ($pemesanan && $pelanggan && $laporan) {
            return redirect(route('pemesanan'))->with('success', 'Berhasil Hapus Booking Kendaraan!');
        } else {
            return redirect(route('pemesanan'))->with('failed', 'Gagal Hapus Booking Kendaraan!');
        }
    }
}
