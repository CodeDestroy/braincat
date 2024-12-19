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
class CourseEditLayout extends Rows
{
    /**
     * The screen's layout elements.
     *
     * @return Field[]
     */
    public function fields(): array
    {
        return [
            Input::make('course.name')
                ->type('text')
                ->max(255)
                ->title(__('Title'))
                ->placeholder(__('Title')),
            Input::make('course.description')
                ->type('text')
                ->max(255)
                ->required()
                ->title(__('Description'))
                ->placeholder(__('Description')),
            /* TD::make('imageView', __('Image'))
                ->render(function (Event $event) {
                    $imageHref = $event->image;
                    return "<img src='$imageHref' width='100px' height='100px'>";
                })
                ->sort(), */
            Attach::make('image')
                ->title(__('Image'))
                ->path('/img')
                ->accept('image/*'),

            DateTimer::make('course.start_date')
                ->title('Start date')
                ->format('Y-m-d'),
            
            DateTimer::make('course.end_date')
                ->title('End date')
                ->format('Y-m-d'),
            DateTimer::make('course.start_time')
                ->title('Start time')
                ->noCalendar()
                ->format('H:i:ss')
                ->format24hr(),
            DateTimer::make('course.end_time')
                ->title('End time')
                ->noCalendar()
                ->format('H:i:ss')
                ->format24hr(),
            
            Select::make('course.status')
                ->title('Status')
                ->empty(__('Closed'), 'closed')
                ->options([
                    'inProgress' => __('In progress'),
                    'notActive' => __('Not active'),
                ]),

            Input::make('course.price')
                ->type('text')
                ->title(__('Price'))
                ->placeholder(__('Price')),
    
        ];
    }
}
