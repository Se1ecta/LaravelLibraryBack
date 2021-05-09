<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Author;
use App\Models\Category;

use Image;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books = DB::table('books')
                        ->join('authors', 'books.author', '=', 'authors.id_author')
                        ->join('categories', 'books.category', '=', 'categories.id_category')
                        ->select('books.*', 'authors.name', 'authors.surname', DB::raw('categories.title as category'))
                        ->get();
        
        // $books = Book::with(['author', 'category'])->get();
        return response()->json($books);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $authors = Author::all()->lists('name','id');
        // $categories = Category::all()->list('title', 'id');
        return view('books.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // echo $request;
        // $test = $request->file('image')->guessExtension();
        // dd($request);
        $request->validate([
            'title'=>'required',
            'author'=>'required',
            'category'=>'required',
            'description'=>'required',
            'rating'=>'required',
            'image'=>'required'
        ]);
        
        // $newImage = time() . '-' . $request->title . '.' . $request->image->extension();

        // $request->image->move(base_path('resources\images'), $newImage);
        // $book = new Book;
        // $book->fill($request->all());

        // $image = Image::make(request->image);
        // Response->make($image->encode('jpeg'));

        $book = Book::create([
            'title' => $request->input('title'),
            'author' => $request->input('author'),
            'category' => $request->input('category'),
            'description' => $request->input('description'),
            'rating' => $request->input('rating'),
            'image' => $request->input('image'),
        ]);
        // return redirect('/books')->with('success', 'Book saved!');
        return response()->json(['success'=>'You have successfully upload image.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Providers\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Book::find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Providers\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Providers\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title'=>'required',
            'author'=>'required',
            'category'=>'required',
            'description'=>'required',
            'rating'=>'required',
            'image'=>'required'
        ]);
        // $newImage = time() . '-' . $request->title . '.' . $request->image->extension();

        // $request->image->move(base_path('resources\images'), $newImage);
        $book = Book::find($id);
        $book->title= $request->input('title');
        $book->author = $request->input('author');
        $book->category = $request->input('category');
        $book->description= $request->input('description');
        $book->rating=$request->input('rating');
        $book->image=$request->input('image');
        $book->save();
        // $book->update($request->all());
        return response()->json(['success'=>'You have successfully updated book.']);
        // return $book;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Providers\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return Book::destroy($id);
    }
}
