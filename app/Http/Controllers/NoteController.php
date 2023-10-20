<?php

namespace App\Http\Controllers;

use App\Http\Requests\NoteRequest;
use App\Http\Resources\NoteResource;
use App\Models\Note;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class NoteController extends Controller
{
    public function index(): JsonResource
    {
        $notes = Note::all();
        //parametro1 = datos,parametro2 = msj de servicio,parametro3 = opcional->valor de cabecera
        //return response()->json($notes,200);    
        //MODIFICACION CON APP/HTTP/RESOURCES/NOTERESOURCES ----- tmb usamos JsonReource, ya no JsonResponse
        return NoteResource::collection($notes); // NoteResourve::collection - para mostrar un contenido listado de elementos
    }

    public function store(NoteRequest $request): JsonResponse
    {
        $note = Note::create($request->all());
        return response()->json([
            'success' => true,
            'data' => new NoteResource($note)
        ], 201);
    }

    public function show(string $id): JsonResource
    {
        $note =  Note::find($id);
        //return response()->json($note, 200);  //esto es con json pura
        return new NoteResource($note);  //new NoteResourve - para mostrar un contenido singular
    }

    public function update(Request $request, string $id): JsonResponse
    {
        $note = Note::find($id);
        $note->update([
            'title' => $request->title,
            'content' => $request->content
        ]);
        return response()->json([
            'success' => true,
            'data' =>   new NoteResource($note)
        ], 200);
    }
    public function destroy(string $id): JsonResponse
    {
        Note::find($id)->delete();
        return response()->json([
            'success' => true
        ], 200);
    }
}
