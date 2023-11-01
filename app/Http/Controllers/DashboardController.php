<?php

namespace App\Http\Controllers;

use App\Models\BankSampah;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dataall = BankSampah::all();
        $data = DB::table('bank_sampah')
        ->select('name', DB::raw('SUM(berat) as total_jumlah'))
        ->groupBy('name')
        ->get();

        $categories = $data->pluck('name');
        $jumlah = $data->pluck('total_jumlah');

        
    return view('pages.admin.index', compact('categories', 'jumlah', 'dataall'));

    }

    public function create()
    {
        return view('pages.admin.create');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function sampah()
    {
        $data = Kategori::all();
        foreach ($data as $kategori) {
            $kategori->formattedHarga = 'Rp ' . number_format($kategori->harga, 0, ',', '.');
        }
        return view('pages.admin.pengelolaan', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $validator = Validator::make($request->all(), [
        'name' => 'required|unique:kategori,name',
        'harga' => 'required',
        'foto' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Sesuaikan dengan jenis gambar yang diizinkan dan ukuran maksimum
        'deskripsi' => 'required',
    ]);
    if ($validator->fails()) {
        return redirect('/tambah-data')
            ->withErrors($validator)
            ->withInput();
    }

        $data = new Kategori();
        $data->name = $request->input('name');
        $data->harga = str_replace(['Rp ', '.'], '', $request->input('harga'));
        $data->deskripsi = $request->input('deskripsi');

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads'), $filename);
            $data->foto = 'uploads/' . $filename;
        } else {
            $data->foto = null;
        }

        $data->save();
        return redirect('/kelola-sampah');
}

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = Kategori::findOrfail($id);

        return view('pages.admin.edit', compact('data', 'id'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'harga' => 'required',
            'foto' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Sesuaikan dengan jenis gambar yang diizinkan dan ukuran maksimum
            'deskripsi' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect('/tambah-data')
                ->withErrors($validator)
                ->withInput();
        }
    
            $data = Kategori::findOrFail($id);
            $data->name = $request->input('name');
            $data->harga = str_replace(['Rp ', '.'], '', $request->input('harga'));
            $data->deskripsi = $request->input('deskripsi');
    
            if ($request->hasFile('foto')) {
                $file = $request->file('foto');
                $filename = time() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('uploads'), $filename);
        
                // Hapus foto lama jika ada
                if ($data->foto) {
                    if (file_exists(public_path($data->foto))) {
                        unlink(public_path($data->foto));
                    }
                }
        
                $data->foto = 'uploads/' . $filename;
            }
        
            // Simpan data lainnya yang diubah
            $data->save();
        
            return redirect('/kelola-sampah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Kategori::where('id', $id)->delete();
        return redirect('/kelola-sampah')->with('succes', 'Data Berhasil Di hapus');
    }
}
