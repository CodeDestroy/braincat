<?php

declare(strict_types=1);

namespace App\Orchid\Layouts\Event;

use App\Models\Event;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Components\Cells\DateTimeSplit;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Layouts\Persona;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class EventListLayout extends Table
{
    /**
     * @var string
     */
    public $target = 'events';

    /**
     * @return TD[]
     */
    public function columns(): array
    {
        return [
            TD::make('id', __('ID'))->defaultHidden(),
            TD::make('name', __('Title'))
                ->sort(),
            TD::make('description', __('Description'))
                ->defaultHidden()
                ->sort(),
            TD::make('course_id', __('Course'))
                ->render(function (Event $event) {
                    return $event->course->name; 
                })
                ->sort(),
            TD::make('image', __('Image'))
                ->render(function (Event $event) {
                    $imageHref = $event->image;
                    return "<img src='$imageHref' width='100px' height='100px'>";
                })
                ->sort(),
            TD::make('start_date', __('Start date'))
                ->render(function (Event $event) {
                    $start_date = $event->start_date;
                    return \Carbon\Carbon::parse($start_date)->translatedFormat('d.m.y');
                })
                /* ->usingComponent(DateTimeSplit::class) */
                ->sort(),
            TD::make('end_date', __('End date'))
                ->render(function (Event $event) {
                    $end_date = $event->end_date;
                    return \Carbon\Carbon::parse($end_date)->translatedFormat('d.m.y');
            })
                ->sort(),
            TD::make('start_time', __('Start time'))
                ->render(function (Event $event) {
                    $start_time = $event->start_time;
                    return \Carbon\Carbon::parse($start_time)->translatedFormat('H:i');
                })
                ->sort(),
            TD::make('end_time', __('End time'))
                ->render(function (Event $event) {
                    $end_time = $event->end_time;
                    return \Carbon\Carbon::parse($end_time)->translatedFormat('H:i');
                })
                ->sort(),
            TD::make('created_at', __('Created'))
                ->usingComponent(DateTimeSplit::class)
                ->align(TD::ALIGN_RIGHT)
                ->defaultHidden()
                ->sort(),

            TD::make('updated_at', __('Last edit'))
                ->usingComponent(DateTimeSplit::class)
                ->align(TD::ALIGN_RIGHT)
                ->defaultHidden()
                ->sort(),

            TD::make(__('Actions'))
                ->align(TD::ALIGN_CENTER)
                ->width('100px')
                ->render(fn (Event $event) => DropDown::make()
                    ->icon('bs.three-dots-vertical')
                    ->list([

                        Link::make(__('Edit'))
                            ->route('platform.event.edit', $event->id)
                            ->icon('bs.pencil'),

                        //Локализировать
                        Button::make(__('Delete'))
                            ->icon('bs.trash3')
                            ->confirm(__('Once the account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.'))
                            ->method('remove', [
                                'id' => $event->id,
                            ]),
                    ])),
        ];
    }
}
