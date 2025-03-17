<?php
namespace App\Orchid\Layouts\User;

use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;
use Orchid\Screen\Actions\Link;
use App\Models\UserDocument;

class UserDocumentsLayout extends Table
{
    protected $target = 'documents'; // Передаемые данные

    protected function columns(): array
    {
        return [
            TD::make('type', 'Тип документа')->render(fn(UserDocument $doc) => $this->getDocumentType($doc->type)),

            TD::make('file', 'Документ')->render(function (UserDocument $doc) {
                if (!$doc->file) {
                    return 'Файл отсутствует';
                }

                $fileUrl = ('/storage/' . $doc->file);

                // Проверяем, является ли файл изображением
                $isImage = in_array(pathinfo($fileUrl, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png', 'gif', 'webp']);

                return $isImage
                    ? "<img src='{$fileUrl}' alt='Документ' style='max-width: 150px; max-height: 150px; border-radius: 5px;'>"
                    : Link::make('Скачать')->href($fileUrl)->target('_blank');
            }), // Используем raw(), чтобы HTML работал
        ];
    }

    private function getDocumentType(string $type): string
    {
        return match ($type) {
            'passport_2_page' => 'Паспорт (2 стр.)',
            'passport_3_page' => 'Паспорт (3 стр.)',
            'snils' => 'СНИЛС',
            'stud' => 'Студ. билет',
            'passport_5_page' => 'Паспорт (5 стр.)',
            'diplom_main_page' => 'Диплом (главная стр.)',
            'diplom_supplement_1_page' => 'Диплом (приложение 1 стр.)',
            'diplom_supplement_2_page' => 'Диплом (приложение 2 стр.)',
            'diplom_profperepod' => 'Диплом о профпереподготовке',
            default => 'Неизвестный документ',
        };
    }
}


