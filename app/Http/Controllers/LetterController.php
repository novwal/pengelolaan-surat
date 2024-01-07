<?php

namespace App\Http\Controllers;

use App\Models\Letter_type;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\LetterExport;
use Illuminate\Http\Request;

class LetterTypeController extends Controller
{
    public function index()
    {
        $letterType = Letter_type::all();
        return view('klasifikasi.index', compact('letterType'));
    }

    public function create()
    {
        return view('klasifikasi.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'letter_code' => 'required|min:3',
            'name_type' => 'required',
        ]);

        $code = $request->letter_code . '-' . (Letter_type::count() + 1);

        Letter_type::create([
            'letter_code' => $code,
            'name_type' => $request->name_type,
        ]);

        return redirect()->route('KlasifikasiSurat.home')->with('success', 'Berhasil Menambah Data Klasifikasi Surat!');
    }

    public function edit($id)
    {
        $letterType = Letter_type::findOrFail($id);
        return view('klasifikasi.edit', compact('letterType'));
    }

    public function update(Request $request, $id)
    {
        $letterType = Letter_type::findOrFail($id);

        $request->validate([
            'name_type' => 'required',
        ]);

        $letterType->update([
            'name_type' => $request->name_type,
        ]);

        return redirect()->route('KlasifikasiSurat.home')->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy($id)
    {
        Letter_type::findOrFail($id)->delete();
        return redirect()->back()->with('deleted', 'Berhasil Menghapus Data!');
    }

    public function fileExport() 
    {
        return Excel::download(new LetterExport, 'Klasifikasi-Surat.xlsx');
    } 
}
