<?php

namespace App\Services;

// Los datos se almacenan en un archivo JSON en lugar de una base de datos.
class BookService
{
    // Obtiene todos los libros desde el archivo JSON.
    private static function getBooks()
    {
        $path = storage_path('books.json');

        if (!file_exists($path)) {
            file_put_contents($path, json_encode([]));
        }

        return json_decode(file_get_contents($path), true);
    }

    // Guarda la lista completa de libros en el archivo JSON.
    private static function saveBooks($books)
    {
        file_put_contents(
            storage_path('books.json'),
            json_encode($books)
        );
    }

    // Devuelve todos los libros, permite filtrar por título o autor
    public static function all($filters = [])
    {
        $books = self::getBooks();

        if (isset($filters['title'])) {
            $books = array_filter($books, fn($b) =>
                str_contains(strtolower($b['title']), strtolower($filters['title']))
            );
        }

        if (isset($filters['author'])) {
            $books = array_filter($books, fn($b) =>
                str_contains(strtolower($b['author']), strtolower($filters['author']))
            );
        }

        return array_values($books);
    }

    // Busca un libro por su ID, devuelve null si no existe
    public static function find($id)
    {
        $books = self::getBooks();

        foreach ($books as $book) {
            if ($book['id'] == $id) {
                return $book;
            }
        }

        return null;
    }

    // Crea un libro, genera un ID con la fecha y devuelve el libro creado
    public static function create($data)
    {
        $books = self::getBooks();

        $data['id'] = uniqid();
        $data['createdAt'] = now()->toISOString();
        $data['isRead'] = $data['isRead'] ?? false;

        $books[] = $data;

        self::saveBooks($books);

        return $data;
    }

    // Actualiza un libro existente, devuelve el libro actualizado o null si no existe
    public static function update($id, $data)
    {
        $books = self::getBooks();

        foreach ($books as &$book) {
            if ($book['id'] == $id) {
                $book = array_merge($book, $data);
                self::saveBooks($books);
                return $book;
            }
        }

        return null;
    }

    // Cambia el estado de lectura de un libro
    public static function toggleRead($id)
    {
        $books = self::getBooks();

        foreach ($books as &$book) {
            if ($book['id'] == $id) {
                $book['isRead'] = !$book['isRead'];
                self::saveBooks($books);
                return $book;
            }
        }

        return null;
    }

    // Elimina un libro por su ID, devuelve true si lo elimina y false si no existe
    public static function delete($id)
    {
        $books = self::getBooks();

        foreach ($books as $i => $book) {
            if ($book['id'] == $id) {
                array_splice($books, $i, 1);
                self::saveBooks($books);
                return true;
            }
        }

        return false;
    }
}
