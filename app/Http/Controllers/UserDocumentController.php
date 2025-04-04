<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserDocument;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Response;
use App\Models\User;
use ZipArchive;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
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
    public function download()
    {
        // Директория для временных файлов
        $tempDir = storage_path('/storage/user_docs');
        if (!file_exists($tempDir)) {
            mkdir($tempDir, 0777, true);
        }

        // Получаем всех пользователей с их документами
        /* $users = User::with('documents')->get(); */
        $users = User::whereHas('payments', function ($query) {
            $query->where('course_id', 1);
        })->with('documents')->get();
        foreach ($users as $user) {
            // Формируем название папки: "Фамилия Имя ID"
            $userFolder = "{$user->secondName} {$user->name} {$user->id}";
            $userPath = $tempDir . DIRECTORY_SEPARATOR . $userFolder;

            if (!file_exists($userPath)) {
                mkdir($userPath, 0777, recursive: true);
            }

            // Перебираем документы пользователя
            /* foreach ($user->documents as $document) {
                
                $sourcePath = storage_path("storage/{$document->file}");
                $destinationPath = $userPath . DIRECTORY_SEPARATOR . $document->type;
                
                if (file_exists($sourcePath)) {
                    copy($sourcePath, $destinationPath);
                    
                }
            } */
            foreach ($user->documents as $document) {
                // Определяем оригинальное имя файла и его расширение
                $fileInfo = pathinfo($document->file);
                $extension = isset($fileInfo['extension']) ? '.' . $fileInfo['extension'] : '';
                
                // Полный путь к исходному файлу (реальное хранилище, а не публичный путь)
                $sourcePath = storage_path("storage/{$document->file}");
                
                // Определяем папку пользователя: "Фамилия Имя ID"
                $userFolder = "{$user->secondName} {$user->name} {$user->id}";
                $userPath = $tempDir . DIRECTORY_SEPARATOR . $userFolder;
            
                // Создаём папку пользователя, если её нет
                if (!file_exists($userPath)) {
                    mkdir($userPath, 0777, true);
                }
            
                // Итоговое имя файла с расширением
                $destinationPath = $userPath . DIRECTORY_SEPARATOR . $document->type . $extension;
            
                // Копируем файл, если он существует
                if (file_exists($sourcePath)) {
                    copy($sourcePath, $destinationPath);
                }
            }
            
        }

        // Создаем ZIP-архив
        $zipFile = sys_get_temp_dir() . '/user_documents.zip';

        $zip = new ZipArchive();
        
        if ($zip->open($zipFile, ZipArchive::CREATE | ZipArchive::OVERWRITE) === true) {
            $files = new \RecursiveIteratorIterator(
                new \RecursiveDirectoryIterator($tempDir),
                \RecursiveIteratorIterator::LEAVES_ONLY
            );

            foreach ($files as $file) {
                if (!$file->isDir()) {
                    $filePath = $file->getRealPath();
                    $relativePath = substr($filePath, strlen($tempDir) + 1);
                    $zip->addFile($filePath, $relativePath);
                }
            }

            $zip->close();
        }

        // Удаляем временные файлы
        $this->deleteDirectory($tempDir);

        return response()->download($zipFile, 'user_documents.zip')->deleteFileAfterSend(true);
    }

    private function deleteDirectory($dir)
    {
        if (!file_exists($dir)) return;

        foreach (scandir($dir) as $file) {
            if ($file === '.' || $file === '..') continue;
            $filePath = $dir . DIRECTORY_SEPARATOR . $file;
            is_dir($filePath) ? $this->deleteDirectory($filePath) : unlink($filePath);
        }

        rmdir($dir);
    }
}
