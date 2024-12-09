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
use Orchid\Screen\Fields\DateTimer;
use App\Models\Event;

use Orchid\Screen\TD;
class VebinarEditLayout extends Rows
{
    /**
     * The screen's layout elements.
     *
     * @return Field[]
     */
    public function fields(): array
    {
        return [
            Relation::make('vebinar.event_id')
                ->fromModel(Event::class, 'name')
                ->applyScope('type', ['vebinar'])
                ->displayAppend('full')
                ->title('Выберите курс'),
            Input::make('vebinar.room_name')
                ->type('text')
                ->max(255)
                
                ->title(__('Room name'))
                ->placeholder(__('Description')),       
            DateTimer::make('vebinar.start_date_time')
                ->title('Start time')
                /* ->noCalendar()
                ->format('H:i:ss')
                ->format24hr(), */
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
