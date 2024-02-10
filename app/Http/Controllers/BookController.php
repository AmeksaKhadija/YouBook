<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Reservation;
use Illuminate\Support\Facades\DB;


class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = Book::all();
        return view('home',['books'=>$books]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'titreLivre'=>'required',
            'prixLivre'=>'required',
        ]);
        $books = new Book();
        $books->title = $request->titreLivre;
        $books->prix = $request->prixLivre;
        $books->save();
        return redirect('/books');
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
        $books = Book::findOrFail($id);
        return view("edit", ["book" => $books]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $books = Book::findOrFail($id);
        $books->title = $request->input("title");
        $books->prix = $request->input("prix");
        $books->save();
        session()->flash('status', 'book modifier avec successe');
        return redirect()->route("books.index");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        $book->delete();
        return redirect()->route('books.index');
    }

    public function AllBooks()
    {
        $books = DB::table('books')->where('isDisponible','=','0')  ->get();
        return view('allBooks',compact('books'));
    }

    public function reserver($id){
        $book = new Reservation();
        $book->book_id=$id;
        $book->user_id	=1;
        $book->save();
        return redirect('/AllBooks');
    }
}
