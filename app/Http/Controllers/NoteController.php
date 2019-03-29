<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Note;

class NoteController extends Controller
{
    public function index()
    {
      	$notes = Note::all();

      	return $notes;
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

      	$note->save();

      	return $note;
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //Solicitamos al modelo la nota con el id solicitado por GET.
        return Note::where('id', $id)->get();
    }
    
    public function update(Request $request, $id)
    {
        $note = Note::find($id);

        $note->title = $request->input('title');
        $note->content = $request->input('content');
        $note->save();

        return $note;
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         $note = Note::find($id);
         $note->delete();

         return $note;
    }
}
