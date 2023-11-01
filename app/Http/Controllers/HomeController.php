<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\BankSampah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = DB::table('bank_sampah')
        ->select('name', DB::raw('SUM(berat) as total_jumlah'))
        ->groupBy('name')
        ->get();

    $categories = $data->pluck('name');
    $jumlah = $data->pluck('total_jumlah');

    
    return view('pages.dashboard', compact('categories', 'jumlah'));
    }
    public function getdata(Request $request)
{
    $kategoriTerbanyak = BankSampah::select('name', DB::raw('count(*) as jumlah'))
    ->groupBy('name')
    ->orderBy('total', 'desc')
    ->take(5) // Ambil lima kategori terbanyak
    ->get();

// Siapkan data untuk grafik
$kategoriLabels = $kategoriTerbanyak->pluck('name');
$kategoriData = $kategoriTerbanyak->pluck('total');

return view('chart.trend_kategori_terbanyak', compact('kategoriLabels', 'kategoriData'));
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = Kategori::all();
        return view('pages.stor', compact('data'));
    }
    public function setor($name)
    {
        $data = Kategori::where('name', $name)->first();
        return view('pages.create', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'harga' => 'required',
            'berat' => 'required',
            'jumlah' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }
    
            $data = new BankSampah();
            $data->name = $request->input('name');
            $data->harga = $request->input('harga');
            $data->berat = $request->input('berat');
            $data->jumlah = $request->input('jumlah');
            $data->save();
            return redirect('/stor');
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
