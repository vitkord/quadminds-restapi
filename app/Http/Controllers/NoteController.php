<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Note;
use App\Http\Resources\Note as NoteResource;

class NoteController extends Controller
{
    public function index()
    {
      	$notes = Note::orderBy('id', 'desc')->paginate(5);

      	return NoteResource::collection($notes);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $note = new Note;
        $note->title = $request->input('title');
        $note->content = $request->input('content'); 

        if ($note->save()) 
        {
            return new NoteResource($note);
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //traemos la nota
        $note = Note::findOrFail($id);

        //retornamos la nota como recurso
        return new NoteResource($note);
    }
    
    public function update(Request $request)
    {
        if ($request->isMethod('put')) 
        {
            $note = Note::findOrFail($request->note_id);
            $note->title = $request->input('title');
            $note->content = $request->input('content');

            if ($note->save()) 
            {
                return new NoteResource($note);    
            } 
        }
        
        
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //buscamos la nota
        $note = Note::findOrFail($id);
        if ($note->delete()) 
        {
            //retornamos la nota como recurso
            return new NoteResource($note);
        }
    }
}
