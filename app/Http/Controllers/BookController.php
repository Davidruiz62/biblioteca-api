<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\BookService;

// Recibe peticiones HTTP 
class BookController extends Controller
{
    // Devuelve la lista de libros, si no existe devuelve un error
    public function index(Request $request)
    {
        return response()->json(
            BookService::all($request->query())
        );
    }

    // Devuelve un libro concreto por su ID, si no existe devuelve un error
    public function show($id)
    {
        $book = BookService::find($id);

        return $book
            ? response()->json($book)
            : response()->json(['error' => 'Not found'], 404);
    }

    // Crea in libro, primero se valida y luego se crea
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'  => 'required|string|min:2',
            'author' => 'required|string|min:2',
        ]);

        $book = BookService::create($validated);

        return response()->json($book, 201);
    }

    // Actualiza un libro exsistente, primero pasa la validación y luego la actualización
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'title'  => 'sometimes|required|string|min:2',
            'author' => 'sometimes|required|string|min:2',
            'isRead' => 'sometimes|boolean',
        ]);

        $book = BookService::update($id, $validated);

        return $book
            ? response()->json($book)
            : response()->json(['error' => 'Not found'], 404);
    }

    // Cambia el estado de leído a no leído o viceversa
    public function toggleRead($id)
    {
        $book = BookService::toggleRead($id);

        return $book
            ? response()->json($book)
            : response()->json(['error' => 'Not found'], 404);
    }

    //Elimina un libro por su ID, devuelve una confirmación o un error
    public function destroy($id)
    {
        return BookService::delete($id)
            ? response()->json(['deleted' => true])
            : response()->json(['error' => 'Not found'], 404);
    }
}
