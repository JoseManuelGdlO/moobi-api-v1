<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inventary;
use Carbon\Carbon;

class InventaryController extends Controller
{
    public function addInventary(Request $request) {
        $mytime = Carbon::now();
        $mytime->toDateTimeString();

        $inventary = new Inventary;
        $inventary->fkBusinessId = $request->fkBusinessId;
        $inventary->name = $request->name;
        $inventary->cost = $request->cost;
        $inventary->quantity = $request->quantity;
        $inventary->description = $request->description;
        $inventary->sku = $request->sku;
        $inventary->imageUrl = $request->imageUrl;
        $inventary->eliminated = $request->eliminated;
        $inventary->creationDate = $mytime;
        $inventary->update = '';

        $inventary->save();

        return response()->json([
            "message" => "El articulo se agregó en el correctamente en el inventario"
        ], 200);
    }
    
    public function getInventary($id) {
        if (Inventary::where('fkBusinessId', $id)->exists()) {
            $inventary = Inventary::where('fkBusinessId', $id)->get()->toJson(JSON_PRETTY_PRINT);
            return response($inventary, 200);
          } else {
            return response()->json([
              "message" => "No se encuentran coincidencias para este negocio"
            ], 200);
          }
      }

      public function deleteInventary($id) {
        if (Inventary::where('id', $id)->exists()) {
            $inventary = Inventary::find($id);
            $inventary->eliminated = 1;
            $inventary->save();
    
            return response()->json([
                "message" => "Se ha eliminado el artículo del inventario correctamente"
            ], 200);
            } else {
            return response()->json([
                "message" => "El artículo no se encuentra en el inventario"
            ], 200);
            
        }
      }
}
