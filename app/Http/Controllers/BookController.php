<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\BookCollection;
use App\Book;
use App\BookAuthor;

class BookController extends Controller
{
    
//    public function __construct()
//    {
//        $this->middleware('auth');
//    }
    // all books
    public function index(Request $request)
    {
//        dd($request->language);
        $requestLanguage = $request->language;
        $books = Book::with('language','authors')
                ->where(function($q) use ($requestLanguage){
                    if(isset($requestLanguage)){
                        $q->whereIn('language_id',$requestLanguage);
                    }
                })->get();
//        $book = Book::find(1)->language['name'];
//          dd($book);
//        $book = Book::find(10)->authors()->orderBy('name')->get();
//                  dd($book);
//       dd($books);
        return $books;   
    }

    // add book
    public function add(Request $request)
    {
//        dd($request);
        $book = new Book([
            'name' => $request->input('name'),
            'language_id' => $request->input('language_id')
        ]);
        $book->save();
        $checkedAuthors = $request->checkedAuthors;
        
        $book->authors()->attach($checkedAuthors);

        return response()->json('The book successfully added');
    }

    // edit book
    public function edit($id)
    {

        $book = Book::with('authors')->find($id);
        return response()->json($book);
    }

    // update book
    public function update($id, Request $request)
    {
        $book = Book::find($id);
//        dd($request->all());
        $book->update($request->all());

        $book->authors()->sync($request->checkedAuthors);
//        $book->authors()->attach($request->checkedAuthors);
        return response()->json('The book successfully updated');
    }

    // delete book
    public function delete($id)
    {
        $book = Book::find($id);
        $book->delete();

        return response()->json('The book successfully deleted');
    }
}
