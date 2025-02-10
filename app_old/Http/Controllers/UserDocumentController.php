<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserDocument;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
class UserDocumentController extends Controller
{
    public function index($userId, $type)
    {

        /* $document = UserDocument::where('user_id', $userId)
            ->where('type', $type)
            ->first();
        $path = storage_path('public/' . $document->file);
        return $path;
        if (!File::exists($path)) {
            abort(404);
        }

        $file = File::get($path);
        $type = File::mimeType($path);

        $response = Response::make($file, 200);
        $response->header("Content-Type", $type);

        return $response; */
        $document = UserDocument::where('user_id', $userId)
                                ->where('type', $type)
                                ->first();
        $path =('/storage/' . $document->file); // Ссылка на изображение
        return response()->json(['path' => $path]);
        /* if ($document && \Storage::exists($document->file)) {
            $path = \Storage::url($document->file); // Ссылка на изображение
            return response()->json(['path' => $path]);
        } else {
            return response()->json(['message' => 'Документ не найден'], 404);
        } */
    }
}
