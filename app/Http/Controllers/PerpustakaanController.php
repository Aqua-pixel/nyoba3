<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Perpustakaan;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\StorePerpustakaanRequest;
use App\Http\Requests\UpdatePerpustakaanRequest;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class PerpustakaanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        $perpustakaans = Perpustakaan::all();

        return response(view('Perpustakaans.index', ['Perpustakaans' => $perpustakaans]));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response
    {
        return response(view('Perpustakaans.create'));
    }

    /**
     * Store a newly created resource in storage.
     */
	public function store(StorePerpustakaanRequest $request)
    {

        $this->validate($request, [
            'judul'   => 'required|string',
            'penulis' => 'required|string',
            'gambar'  => 'required|image|mimes:png,jpg,jpeg',
            'price'   => 'required|numeric',
            'jumlah'  => 'required|numeric',
        ]);
        
        // Upload image
        $gambar = $request->file('gambar');
        $filename = date('d-m-y').$gambar->getClientOriginalName();
        $path = 'storage/'.$filename;

        storage::disk('public')->put($path,file_get_contents($gambar));

        // $gambar->storeAs('public/Bukus', $gambar->hashName());
    
        $perpustakaan = Perpustakaan::create([
            'judul'   => $request->judul,
            'penulis' => $request->penulis,
            // 'gambar'  => $gambar->hashName(),
            'gambar'  => $filename,
            'price'   => $request->price,
            'jumlah'  => $request->jumlah,
        ]);
    
        if($perpustakaan){
            //redirect dengan pesan sukses
            return redirect()->route('Perpustakaans.index')->with(['success' => 'Data Berhasil Disimpan!']);
        }else{
            //redirect dengan pesan error
            return redirect()->route('Perpustakaans.index')->with(['error' => 'Data Gagal Disimpan!']);
        }
    }

    // public function store(Request $request) {
    //     $validator = Perpustakaan::make($request->all(),[
    //         'gambar' => 'requires|image|mimes:png,jpg,jpeg',
    //     ]);

    //     if($validator->fails()) return redirect()->back()->withInput()->withErrors($validator);

    //     $gambar = $request-> file('gambar');
    //     $filename = date('Y-m-d').$gambar->getClientOriginalName();
    //     $path = 'public/'.$filename;

    //     Storage::disk('public')->put($path,file_get_contents($gambar));
    // }
    /**
     * Display the specified resource.
     */
    public function show(string $id): Response
    {
        dd('show');
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): Response
    {
        $perpustakaan = Perpustakaan::findOrFail($id);

        return response(view('Perpustakaans.edit', ['perpustakaan' => $perpustakaan]));

    }
    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePerpustakaanRequest $request, string $id)
    {
        $this->validate($request, [
            'judul'   => 'required|string',
            'penulis' => 'required|string',
            'gambar'  => 'required|image|mimes:png,jpg,jpeg',
            'price'   => 'required|numeric',
            'jumlah'  => 'required|numeric',
        ]);
        
        // Upload image
        $gambar = $request->file('gambar');
        $filename = date('d-m-y').$gambar->getClientOriginalName();
        $path = 'storage/'.$filename;

        storage::disk('public')->put($path,file_get_contents($gambar));

        // $gambar->storeAs('public/Bukus', $gambar->hashName());
    
        $perpustakaan = Perpustakaan::create([
            'judul'   => $request->judul,
            'penulis' => $request->penulis,
            // 'gambar'  => $gambar->hashName(),
            'gambar'  => $filename,
            'price'   => $request->price,
            'jumlah'  => $request->jumlah,
        ]);
    
        if($perpustakaan){
            //redirect dengan pesan sukses
            return redirect()->route('Perpustakaans.index')->with(['success' => 'Data Berhasil Disimpan!']);
        }else{
            //redirect dengan pesan error
            return redirect()->route('Perpustakaans.index')->with(['error' => 'Data Gagal Disimpan!']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): RedirectResponse
    {
        $perpustakaan = Perpustakaan::findOrFail($id);       
        
        Perpustakaan::deleting(function ($perpustakaan) {
            // Menghapus file gambar yang terkait dari penyimpanan (storage)
            Storage::disk('public')->delete('storage/' . $perpustakaan->gambar);
        });

        if ($perpustakaan->delete()) {
            return redirect(route('Perpustakaans.index'))->with('success', 'Deleted!');
        }

        return redirect(route('Perpustakaans.index'))->with('error', 'Sorry, unable to delete this!');
    }

}
