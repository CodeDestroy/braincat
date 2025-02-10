<?php

declare(strict_types=1);

namespace App\Orchid\Layouts\Course;

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
class ChapterEditLayout extends Rows
{
    /**
     * The screen's layout elements.
     *
     * @return Field[]
     */
    public function fields(): array
    {
        return [
            Input::make('chapter.name')
                ->type('text')
                ->max(255)
                ->required()
                ->title(__('Title'))
                ->placeholder(__('Title')),
            Input::make('chapter.description')
                ->type('text')
                ->max(255)
                ->title(__('Description'))
                ->placeholder(__('Description')),
            Relation::make('chapter.course_id')
                ->fromModel(Course::class, 'name')
                ->title('Выберите курс'),

            DateTimer::make('chapter.start_date')
                ->title('Start date')
                ->format('Y-m-d'),
            
            DateTimer::make('chapter.end_date')
                ->title('End date')
                ->format('Y-m-d'),
            DateTimer::make('chapter.start_time')
                ->title('Start time')
                ->noCalendar()
                ->format('H:i:ss')
                ->placeholder(__('Select time'))
                ->format24hr(),
            DateTimer::make('chapter.end_time')
                ->title('End time')
                ->noCalendar()
                ->format('H:i:ss')
                ->placeholder(__('Select time'))
                ->format24hr(),
            Input::make('chapter.color')
                ->type('color')
                ->max(255)
                ->title(__('Color'))
                ->placeholder(__('Color')),
            
    
        ];
    }
}
