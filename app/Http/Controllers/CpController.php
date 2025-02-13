<?php

namespace App\Http\Controllers;

use App\Models\Cp;
use Illuminate\Http\Request;

class CpController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($mapel_id)
    {
        $user = auth()->user();
        $guru = $user->guru;
    
        if (!$guru || !$guru->mapel->contains('id', $mapel_id)) {
            abort(403, 'Anda tidak memiliki akses ke CP mapel ini.');
        }
    
        // Ambil CP berdasarkan mapel & guru yang sedang login
        $cp = Cp::where('mapel_id', $mapel_id)
                ->where('guru_id', $guru->id)
                ->get();
    
        return view('cp.cp', compact('cp', 'mapel_id'));
    }

    
    

    public function create() {

    }

    public function store(Request $request)
    {

        $user = auth()->user();
        $guru = $user->guru;

        $request->validate([
            'nama_cp' => 'required|string|max:255',
            'mapel_id' => 'required|exists:mapels,id',
        ]);
    
        Cp::create([
            'nama_cp' => $request->nama_cp,
            'mapel_id' => $request->mapel_id,
            'guru_id' => $guru->id
        ]);    

        return redirect()->back()->with('success', 'Capaian Pembelajaran berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Cp $cp)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cp $cp)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cp $cp)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cp $cp)
    {
        //
    }
}
