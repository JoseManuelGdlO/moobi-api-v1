<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;

class CrudController extends Controller
{
    public function getAllArticles() {
        $article = Article::get()->toJson(JSON_PRETTY_PRINT);
        return response($article, 200);
    }
  
    public function createArticle(Request $request) {
        $article = new Article;
        $article->name = $request->name;
        $article->price = $request->price;
        $article->save();

        return response()->json([
            "message" => "El articulo se registro correctamente"
        ], 200);
    }
  
      public function getArticle($id) {
        if (Article::where('id', $id)->exists()) {
            $article = Article::where('id', $id)->get()->toJson(JSON_PRETTY_PRINT);
            return response($article, 200);
          } else {
            return response()->json([
              "message" => "El artículo no se encuentra"
            ], 200);
          }
      }
  
      public function updateArticle(Request $request, $id) {
        if (Article::where('id', $id)->exists()) {
            $article = Article::find($id);
            $article->name = is_null($request->name) ? $article->name : $request->name;
            $article->price = is_null($request->price) ? $article->price : $request->price;
            $article->save();
    
            return response()->json([
                "message" => "Se ha modificado el artículo correctamente"
            ], 200);
            } else {
            return response()->json([
                "message" => "El artículo no se encuentra"
            ], 200);
            
        }
      }
  
      public function deleteArticle ($id) {
        if(Article::where('id', $id)->exists()) {
            $article = Article::find($id);
            $article->delete();
    
            return response()->json([
              "message" => "El artículo ha sido eliminado correctamente"
            ], 200);
          } else {
            return response()->json([
              "message" => "El artículo no se encuentra"
            ], 200);
          }
      }
}
