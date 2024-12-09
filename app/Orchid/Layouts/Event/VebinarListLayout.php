<?php

declare(strict_types=1);

namespace App\Orchid\Layouts\Event;

use App\Models\Vebinar;
use App\Models\Event;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Components\Cells\DateTimeSplit;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class VebinarListLayout extends Table
{
    /**
     * @var string
     */
    public $target = 'vebinars';

    /**
     * @return TD[]
     */
    public function columns(): array
    {
        return [
            TD::make('id', __('ID'))->defaultHidden(),
            TD::make('event_id', __('Event'))
                ->render(function (Vebinar $vebinar) {
                    $event = Event::find($vebinar->event_id);
                    return ($event->name . ' ' . $event->start_date); 
                })
                ->sort(),
            TD::make('room_name', __('Room name'))
                ->sort(),
            TD::make('start_date_time', __('Start time'))
                ->usingComponent(DateTimeSplit::class)
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
                ->render(fn (Vebinar $vebinar) => DropDown::make()
                    ->icon('bs.three-dots-vertical')
                    ->list([

                        Link::make(__('Edit'))
                            ->route('platform.events.vebinar.edit', $vebinar->id)
                            ->icon('bs.pencil'),

                        //Локализировать
                        Button::make(__('Delete'))
                            ->icon('bs.trash3')
                            ->confirm(__('Once the account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.'))
                            ->method('remove', [
                                'id' => $vebinar->id,
                            ]),
                    ])),
        ];
    }
}
