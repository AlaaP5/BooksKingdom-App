<?php

namespace App\Services;

use App\Models\Book;

class BookService
{
    public function store($request)
    {
        $input = $request->all();

        $image = $request->file('image')->getClientOriginalName();
        $path = $request->file('image')->storeAs('images', $image, 'files');
        $input['image'] = $path;

        $content = $request->file('content')->getClientOriginalName();
        $pathBook = $request->file('content')->storeAs('books', $content, 'files');
        $input['content'] = $pathBook;

        Book::create($input);
        return response()->json(['message' => 'The book is added Successfully'], 201);
    }


    public function fetch()
    {
        $books = Book::get();
        foreach ($books as $book) {
            $book->image = asset('files/' . $book->image);
            $book->content = asset('files/' . $book->content);
        }
        if (!count($books)) {
            return response()->json(['message' => 'not found'], 404);
        }
        return response()->json(['data' => $books], 200);
    }


    public function getBook($id)
    {
        $book = Book::where('id', $id)->first();
        if (empty($book)) {
            return response()->json(['message' => 'not found'], 404);
        }
        $book->image = asset('files/' . $book->image);
        $book->content = asset('files/' . $book->content);
        return response()->json(['data' => $book], 200);
    }


    public function search($name)
    {
        $search = Book::where('name', 'like', '%' . $name . '%')->orderBy("name")->get();
        if (!count($search)) {
            return response()->json(['message' => 'not found'], 404);
        }
        foreach ($search as $se) {
            $se->image = asset('files/' . $se->image);
            $se->content = asset('files/' . $se->content);
        }
        return response()->json(['data' => $search], 200);
    }


    public function update($id, $request)
    {
        $book = Book::find($id);
        if ($request->content) {
            $content = $request->file('content')->getClientOriginalName();
            $pathBook = $request->file('content')->storeAs('books', $content, 'files');
        }

        if ($request->image) {
            $image = $request->file('image')->getClientOriginalName();
            $path = $request->file('image')->storeAs('images', $image, 'files');
        }
        $book->update([
            'name' => ($request->name) ? $request->name : $book->name,
            'author_id' => ($request->author_id) ? $request->author_id : $book->author_id,
            'type_id' => ($request->type_id) ? $request->type_id : $book->type_id,
            'description' => ($request->description) ? $request->description : $book->description,
            'status_id' => ($request->status_id) ? $request->status_id : $book->status_id,
            'content' => ($request->content) ? $pathBook : $book->content,
            'image' => ($request->image) ? $path : $book->image,
            'date_publication' => ($request->date_publication) ? $request->date_publication : $book->date_publication,
            'price' => ($request->price) ? $request->price : $book->price,
            'pages' => ($request->pages) ? $request->pages : $book->pages
        ]);
        return response()->json(['message' => 'Book updated successfully'], 200);
    }


    public function deleteBook($id)
    {
        $book = Book::find($id);
        if (empty($book)) {
            return response()->json(['message' => 'this book not found'], 404);
        }
        $book->delete();
        return response()->json(['message' => 'Book deleted successfully'], 200);
    }
}
