<?php

namespace App\Http\Controllers;

use App\Models\Diccionario;
use App\Http\Resources\PalabraResource;
use App\Http\Resources\PalabraCollection;
use App\Http\Resources\DiccionarioResource;
use App\Http\Requests\GuardarPalabraRequest;
use App\Http\Resources\DiccionarioCollecction;
use App\Http\Requests\GuardarDiccionarioRequest;

class DiccionarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       // $diccionario = Diccionario::latest()->paginate(5);
       $diccionario = Diccionario::all();

 
             return new DiccionarioCollecction($diccionario);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GuardarPalabraRequest $request)
    {
        $diccionario = Diccionario::create($request-> all());
        if(!$diccionario){
        return response()->json([
           "error" => true,
           "message" => "Error al crear la palabra"
       ],400);
       }else{
           return response()->json([
               "error" => false,
               "response" => $diccionario
           ],200);
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
        $diccionario = Diccionario::find($id);

        if (!$diccionario){
            return response()->json([
                "error" => true,
                "message" =>"la palabra no existe"
            ],404);
           
            }else{
   
                return new DiccionarioResource($diccionario);
               
            }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(GuardarDiccionarioRequest $request, $id)
    {
        $diccionario = Diccionario::find($id);

       if(!empty($diccionario))

        if ($diccionario->update($request->all())) {
            return response()->json([
                "error" => false,
                "response" => "Diccionario actualizado",
                "data" => $diccionario
            ], 200);
        }else{
            return response()->json([
                "error" => true,
                "message" => "Error al actualizar el diccionario"

            ], 400);
        }

    
    else{
        return response()->json([
            "error" => true,
            "message" => "el diccionario no existe"
        ],400);
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
        $diccionario = Diccionario::find($id);

        if(!empty($diccionario))
 
         if ($diccionario->delete) {
             return response()->json([
                 "error" => false,
                 "response" => "Diccionario eliminado",
                 "data" => $diccionario
             ], 200);
         }else{
             return response()->json([
                 "error" => true,
                 "message" => "Error al eliminar la palabra"
 
             ], 400);
         }
 
     
     else{
         return response()->json([
             "error" => true,
             "message" => "El diccionario no existe"
         ],400);
     }
    
}
    
}
