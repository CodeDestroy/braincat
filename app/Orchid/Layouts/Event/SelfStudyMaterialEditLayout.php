<?php

declare(strict_types=1);

namespace App\Orchid\Layouts\Event;

use Orchid\Screen\Field;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Fields\Quill;
use Orchid\Screen\Fields\Code;
use Orchid\Screen\Fields\SimpleMDE;
use Orchid\Screen\Layouts\Rows;
use Orchid\Screen\Fields\Textarea;
use Orchid\Screen\Actions\Button;
use App\Models\Event;

use Orchid\Screen\TD;
class SelfStudyMaterialEditLayout extends Rows
{
    /**
     * The screen's layout elements.
     *
     * @return Field[]
     */
    public function fields(): array
    {
        return [
            Relation::make('selfStudyMaterial.event_id')
            ->fromModel(Event::class, 'name')
            ->applyScope('type', ['selfStudyMaterial'])
            ->displayAppend('full')
            /* ->multiple() */
            ->title('Выберите курс'),
                /* ->fromModel(Event::class, 'name')
                ->title('Выберите курс'), */
            Input::make('selfStudyMaterial.title')
                ->type('text')
                ->required()
                ->max(255)
                ->title(__('Title'))
                ->placeholder(__('Title')),
            Input::make('event.description')
                ->type('text')
                ->max(255)
                
                ->title(__('Description'))
                ->placeholder(__('Description')),       
            Quill::make('selfStudyMaterial.text')
                ->toolbar(["text", "color", "header", "list", "format", "media"])
                ->title(__('Text'))
                ->placeholder(__('Text')),    
            /* Code::make('selfStudyMaterial.text')
                ->language(Code::MARKUP)
                ->placeholder(__('Text')),  */
            // Добавьте текстовое поле для кода
            /* Textarea::make('code')
                ->title(__('Code'))
                ->placeholder(__('Code'))
                ->style('display: none; width: 100%; height: 300px;'), // Скрыто по умолчанию

            // Добавьте кнопку для переключения режима
            Button::make(__('Toggle Code Mode'))
                ->method('toggleCodeMode')
                ->class('btn btn-primary'),  */    
            /* Input::make('event.description')
                ->type('text')
                ->max(255)
                ->required()
                ->title(__('Description'))
                ->placeholder(__('Description')),       */    
    
        ];
    }
}
