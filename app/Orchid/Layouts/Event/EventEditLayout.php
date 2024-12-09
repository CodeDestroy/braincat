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
class EventEditLayout extends Rows
{
    /**
     * The screen's layout elements.
     *
     * @return Field[]
     */
    public function fields(): array
    {
        return [
            Input::make('event.name')
                ->type('text')
                ->max(255)
                ->title(__('Title'))
                ->placeholder(__('Title')),
            Input::make('event.description')
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
            Relation::make('event.course_id')
                ->fromModel(Course::class, 'name')
                ->title('Выберите курс'),
            DateTimer::make('event.start_date')
                ->title('Start date')
                ->format('Y-m-d'),
            
            DateTimer::make('event.end_date')
                ->title('End date')
                ->format('Y-m-d'),
            DateTimer::make('event.start_time')
                ->title('Start time')
                ->noCalendar()
                ->format('H:i:ss')
                ->format24hr(),
            DateTimer::make('event.end_time')
                ->title('End time')
                ->noCalendar()
                ->format('H:i:ss')
                ->format24hr(),
            
            Select::make('event.status')
                ->title('Status')
                ->empty(__('Closed'), 'closed')
                ->options([
                    'inProgress' => __('In progress'),
                    'notActive' => __('Not active'),
                ]),
            Select::make('event.type')
            ->title('Тип')
                ->empty(__('Self study materials'), 'selfStudyMaterial')
                ->options([
                    /* 'selfStudyMaterial' => __('Self study materials'), */
                    'test' => __('Tests'),
                    'vebinar' => __('Vebinars'),
                ]),
                
            
            Input::make('event.order')
                ->type('text')
                ->title(__('Order'))
                ->placeholder(__('Order')),
            
            /* Select::make('event.color')
                ->empty('Color', 'color')
                ->options([
                    'black'  => 'Чёрный',
                    'text-purple-800'  => 'Фиолетовый',
                ]), */
            Input::make('event.color')
                ->type('color')
                ->max(255)
                ->title(__('Color'))
                ->placeholder(__('Color')),
    
        ];
    }
}
