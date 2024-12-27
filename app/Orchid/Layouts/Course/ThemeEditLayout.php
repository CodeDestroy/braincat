<?php

declare(strict_types=1);

namespace App\Orchid\Layouts\Course;

use App\Models\Chapter;
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
class ThemeEditLayout extends Rows
{
    /**
     * The screen's layout elements.
     *
     * @return Field[]
     */
    public function fields(): array
    {
        return [
            Input::make('theme.name')
                ->type('text')
                ->max(255)
                ->required()
                ->title(__('Title'))
                ->placeholder(__('Title')),
            Input::make('theme.description')
                ->type('text')
                ->max(255)
                ->required()
                ->title(__('Description'))
                ->placeholder(__('Description')),
            Relation::make('theme.course_id')
                ->fromModel(Course::class, 'name')
                ->title(__('Select course'))
                ->required(),
            Relation::make('theme.chapter_id')
                ->fromModel(Chapter::class, 'name')
                ->title(__('Select chapter')),
            DateTimer::make('theme.start_date')
                ->title(__('Start date'))
                ->format('Y-m-d'),
            
            DateTimer::make('theme.end_date')
                ->title(__('End date'))
                ->format('Y-m-d'),
            DateTimer::make('theme.start_time')
                ->title(__('Start time'))
                ->noCalendar()
                ->format('H:i:ss')
                ->placeholder(__('Select time'))
                ->format24hr(),
            DateTimer::make('theme.end_time')
                ->title(__('End time'))
                ->noCalendar()
                ->format('H:i:ss')
                ->placeholder(__('Select time'))
                ->format24hr(),
            Select::make('theme.calendar_visibility')
                ->title('Calendar visibility')
                ->empty(__('Yes'), '1')
                ->options([
                    '1' => __('Yes'),
                    '0' => __('No'),
                ]),
            /* Input::make('chapter.color')
                ->type('color')
                ->max(255)
                ->title(__('Color'))
                ->placeholder(__('Color')) */
            
    
        ];
    }
}
