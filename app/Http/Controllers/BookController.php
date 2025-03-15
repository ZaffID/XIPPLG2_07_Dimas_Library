<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class BookController extends Controller
{
    public function index(): JsonResponse
    { 
        $books = Book::all(); 

        return response()->json([
            'status' => 200, 
            'message' => 'Books retrieved successfully.', 
            'data' => $books 
        ], 200); 
    }

    public function show($id): JsonResponse
    {
        $book = Book::find($id);

        if (!$book) {
            return response()->json([
                'status' => 404,
                'message' => 'Book not found.',
                'data' => null
            ], 404);
        }

        return response()->json([
            'status' => 200,
            'message' => 'Book retrieved successfully.',
            'data' => $book
        ], 200);
    }

    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'writer' => 'required|string|max:255',
            'user_id' => 'required|exists:users,id',
            'category_id' => 'required|exists:categories,id',
            'publisher' => 'required|string|max:255',
            'year' => 'required|integer|min:1900|max:' . date('Y')
        ]);

        $book = Book::create($request->all());

        return response()->json([
            'status' => 201,
            'message' => 'Book created successfully.',
            'data' => $book
        ], 201);
    }

    public function update(Request $request, $id): JsonResponse
    {
        $book = Book::find($id);

        if (!$book) {
            return response()->json([
                'status' => 404,
                'message' => 'Book not found.',
                'data' => null
            ], 404);
        }

        $request->validate([
            'title' => 'string|max:255',
            'writer' => 'string|max:255',
            'user_id' => 'exists:users,id',
            'category_id' => 'exists:categories,id',
            'publisher' => 'string|max:255',
            'year' => 'integer|min:1900|max:' . date('Y')
        ]);

        $book->update($request->all());

        return response()->json([
            'status' => 200,
            'message' => 'Book updated successfully.',
            'data' => $book
        ], 200);
    }

    public function destroy($id): JsonResponse
    {
        $book = Book::find($id);

        if (!$book) {
            return response()->json([
                'status' => 404,
                'message' => 'Book not found.',
                'data' => null
            ], 404);
        }

        $book->delete();

        return response()->json([
            'status' => 200,
            'message' => 'Book deleted successfully.',
            'data' => null
        ], 200);
    }
}