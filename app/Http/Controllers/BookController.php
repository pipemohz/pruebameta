<?php

namespace App\Http\Controllers;

use App\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
     $books=Book::with('author')->get();
     return response()->json($books);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $book=new Book();
        $book->publish_date=$request->publish_date;
        $book->title=$request->title;
        $book->author_id=$request->author_id;
        $validator=Book::validate(array(
            'publish_date'=>$request->publish_date,
            'title'=>$request->title,
            'author_id'=>$request->author_id,
        ));

        if($validator->fails())
        {
            //return response()->json(null);
            return $validator->messages()->all();
        }
        else
        {
            $book->save();
            return response()->json($book);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $book=Book::with('author')->find($id);
        return response()->json($book);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $book=Book::findOrFail($id);
        $book->publish_date=$request->publish_date;
        $book->title=$request->title;
        $book->author_id=$request->author_id;

        $validator=Book::validate(array
        (
            'publish_date'=>$request->publish_date,
            'title'=>$request->title,
            'author_id'=>$request->author_id,
        ));

        if($validator->fails())
        {
            return $validator->messages()->all();
        }
        else
        {
            $book->save();
            return response()->json($book);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $book=Book::findOrFail($id);
        if($book)
        {
            $book->delete();
            response()->json(null);
        }
    }
}
