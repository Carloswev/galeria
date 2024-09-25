<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PhotoController extends Controller
{
    public function index()
    {
        // Recupera todas as fotos do banco de dados
        $photos = Photo::all();
        return view('photos.index', compact('photos'));
    }

    public function store(Request $request)
    {
        // Valida a entrada
        $request->validate([
            'photos.*' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Valida as imagens
        ]);

        // Armazena as fotos
        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $file) {
                $path = $file->store('photos', 'public'); // Armazena a imagem no diretório 'photos'
                Photo::create(['path' => $path, 'name' => $file->getClientOriginalName()]); // Adiciona ao banco de dados
            }
        }

        return redirect()->route('photos.index')->with('success', 'Fotos adicionadas com sucesso!');
    }

    public function destroy($id)
    {
        // Remove a foto do banco de dados
        $photo = Photo::findOrFail($id);
        Storage::disk('public')->delete($photo->path); // Remove a imagem do disco
        $photo->delete(); // Remove do banco de dados

        return redirect()->route('photos.index')->with('success', 'Foto excluída com sucesso!');
    }
}
