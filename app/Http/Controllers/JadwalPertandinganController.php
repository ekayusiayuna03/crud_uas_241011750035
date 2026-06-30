<?php

namespace App\Http\Controllers;

use App\Models\JadwalPertandingan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;

class JadwalPertandinganController extends Controller
{
    /**
     * Display the public listing page.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        $query = JadwalPertandingan::query();

        if ($search) {
            $query->where('nama_event', 'like', "%{$search}%")
                  ->orWhere('tempat', 'like', "%{$search}%")
                  ->orWhere('penanggung_jawab', 'like', "%{$search}%");
        }

        $jadwal = $query->orderBy('tanggal', 'asc')->get();

        return view('welcome', compact('jadwal', 'search'));
    }

    /**
     * Display the admin dashboard list.
     */
    public function dashboard()
    {
        $jadwal = JadwalPertandingan::orderBy('tanggal', 'desc')->get();
        return view('admin.dashboard', compact('jadwal'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_event' => ['required', 'string', 'max:255'],
            'tanggal' => ['required', 'date'],
            'tempat' => ['required', 'string', 'max:255'],
            'penanggung_jawab' => ['required', 'string', 'max:255'],
            'gambar' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:2048'],
        ], [
            'nama_event.required' => 'Nama event wajib diisi.',
            'tanggal.required' => 'Tanggal event wajib diisi.',
            'tempat.required' => 'Tempat event wajib diisi.',
            'penanggung_jawab.required' => 'Nama penanggung jawab wajib diisi.',
            'gambar.image' => 'File harus berupa gambar.',
            'gambar.mimes' => 'Format gambar harus jpeg, png, jpg, atau webp.',
            'gambar.max' => 'Ukuran gambar maksimal 2MB.',
        ]);

        $data = $request->only(['nama_event', 'tanggal', 'tempat', 'penanggung_jawab']);

        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            // Save inside public/uploads/jadwal directory
            $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/jadwal'), $fileName);
            $data['gambar'] = 'uploads/jadwal/' . $fileName;
        }

        JadwalPertandingan::create($data);

        return redirect()->route('admin.dashboard')
            ->with('success', 'Jadwal pertandingan berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $item = JadwalPertandingan::findOrFail($id);
        return view('admin.edit', compact('item'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $item = JadwalPertandingan::findOrFail($id);

        $request->validate([
            'nama_event' => ['required', 'string', 'max:255'],
            'tanggal' => ['required', 'date'],
            'tempat' => ['required', 'string', 'max:255'],
            'penanggung_jawab' => ['required', 'string', 'max:255'],
            'gambar' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:2048'],
        ], [
            'nama_event.required' => 'Nama event wajib diisi.',
            'tanggal.required' => 'Tanggal event wajib diisi.',
            'tempat.required' => 'Tempat event wajib diisi.',
            'penanggung_jawab.required' => 'Nama penanggung jawab wajib diisi.',
            'gambar.image' => 'File harus berupa gambar.',
            'gambar.mimes' => 'Format gambar harus jpeg, png, jpg, atau webp.',
            'gambar.max' => 'Ukuran gambar maksimal 2MB.',
        ]);

        $data = $request->only(['nama_event', 'tanggal', 'tempat', 'penanggung_jawab']);

        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/jadwal'), $fileName);
            $data['gambar'] = 'uploads/jadwal/' . $fileName;

            if ($item->gambar && file_exists(public_path($item->gambar))) {
                @unlink(public_path($item->gambar));
            }
        }

        $item->update($data);

        return redirect()->route('admin.dashboard')
            ->with('success', 'Jadwal pertandingan berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $item = JadwalPertandingan::findOrFail($id);

        // Delete image if exists
        if ($item->gambar && file_exists(public_path($item->gambar))) {
            @unlink(public_path($item->gambar));
        }

        $item->delete();

        return redirect()->route('admin.dashboard')
            ->with('success', 'Jadwal pertandingan berhasil dihapus.');
    }

    /**
     * Export all schedule data to PDF.
     */
    public function exportPdf()
    {
        $jadwal = JadwalPertandingan::orderBy('tanggal', 'asc')->get();
        
        $pdf = Pdf::loadView('admin.pdf', compact('jadwal'));
        
        return $pdf->download('laporan_jadwal_pertandingan_' . date('Y-m-d') . '.pdf');
    }
}