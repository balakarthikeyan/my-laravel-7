<?php
  
namespace App\Http\Controllers;
use App\Models\Album;

class AlbumController extends Controller {
  
    public function index() {  
        $Album  = Album::all();  
        return response()->json($Album);  
    }
  
    public function getAlbum($id) {  
        $Album  = Album::find($id);  
        return response()->json($Album);
    }
  
    public function createAlbum(Request $request) {  
        $Album = Album::create($request->all());  
        return response()->json($Album);  
    }
  
    public function deleteAlbum($id) {
        $Album  = Album::find($id);
        $Album->delete();
        return response()->json('deleted');
    }
  
    public function updateAlbum(Request $request, $id) {
        $Album  = Album::find($id);
        $Album->title = $request->input('title');
        $Album->artist = $request->input('artist');
        $Album->save();  
        return response()->json($Album);
    }
  
}