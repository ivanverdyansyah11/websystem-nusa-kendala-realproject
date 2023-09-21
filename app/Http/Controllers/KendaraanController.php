<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KendaraanController extends Controller
{
    public function index()
    {
        return view('kendaraan.index', [
            'title' => 'Kendaraan',
        ]);
    }

    public function detail()
    {
        return view('kendaraan.detail', [
            'title' => 'Kendaraan',
        ]);
    }

    public function create()
    {
        return view('kendaraan.create', [
            'title' => 'Kendaraan',
        ]);
    }

    public function edit()
    {
        return view('kendaraan.edit', [
            'title' => 'Kendaraan',
        ]);
    }
}