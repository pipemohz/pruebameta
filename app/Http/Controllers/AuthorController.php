<?php

namespace App\Http\Controllers;

use App\Author;
use Illuminate\Http\Request;

use function GuzzleHttp\Promise\all;

class AuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $author=Author::all();
        return response()->json($author);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $author=new Author();
        $author->name=$request->name;
        $validator=Author::validate(array
        (
            'name'=>$request->name,
        ));

        if($validator->fails())
        {
            return $validator->messages()->all();
        }
        else
        {
            $author->save();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $author=Author::find($id);
        return response()->json($author);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $author=Author::findOrFail($id);

        $author->name=$request->name;
        $validator=Author::validate(array
        (
            'name'=>$request->name,
        ));

        if($validator->fails())
        {
            return $validator->messages()->all();
        }
        else
        {
            $author->save();
            return response()->json($author);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Author  $author
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $author=Author::findOrFail($id);
        if($author)
        {
            $author->delete();
            return response()->json(null);
        }
    }
}
