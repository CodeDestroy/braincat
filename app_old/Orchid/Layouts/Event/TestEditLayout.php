<?php

declare(strict_types=1);

namespace App\Orchid\Layouts\Event;

use Orchid\Screen\Field;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\DateTimer;
use Orchid\Screen\Fields\Relation;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Fields\Attach;
use Orchid\Screen\Layouts\Rows;
use App\Models\Course;
use App\Models\Event;

use Orchid\Screen\TD;
class TestEditLayout extends Rows
{
    /**
     * The screen's layout elements.
     *
     * @return Field[]
     */
    public function fields(): array
    {
        return [
            Input::make('test.title')
                ->type('text')
                ->max(255)->required()
                ->title(__('Title'))
                ->placeholder(__('Title')),
            Input::make('test.description')
                ->type('text')
                ->max(255)
                
                ->title(__('Description'))
                ->placeholder(__('Description')),

            Relation::make('test.event_id')
                ->fromModel(Event::class, 'name')
                ->title('Выберите событие')
                ->applyScope('type', ['test'])
                ->displayAppend('full'),
    
        ];
    }
}
