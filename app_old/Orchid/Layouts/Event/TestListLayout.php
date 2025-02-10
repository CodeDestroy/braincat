<?php

declare(strict_types=1);

namespace App\Orchid\Layouts\Event;

use App\Models\Test;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Components\Cells\DateTimeSplit;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Layouts\Persona;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class TestListLayout extends Table
{
    /**
     * @var string
     */
    public $target = 'tests';

    /**
     * @return TD[]
     */
    public function columns(): array
    {
        return [
            TD::make('id', __('ID'))->defaultHidden(),
            TD::make('title', __('Title'))
                ->sort(),
            TD::make('description', __('Description'))
                ->defaultHidden()
                ->sort(),
            TD::make('event_id', __('Event'))
                ->render(function (Test $test) {
                    return ($test->event->name) . ' ' . ($test->event->start_date); 
                })
                ->sort(),
            TD::make(__('Actions'))
                ->align(TD::ALIGN_CENTER)
                ->width('100px')
                ->render(fn (Test $test) => DropDown::make()
                    ->icon('bs.three-dots-vertical')
                    ->list([

                        Link::make(__('Edit'))
                            ->route('platform.events.tests.edit', $test->id)
                            ->icon('bs.pencil'),

                        //Локализировать
                        Button::make(__('Delete'))
                            ->icon('bs.trash3')
                            ->confirm(__('Once the account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.'))
                            ->method('remove', [
                                'id' => $test->id,
                            ]),
                    ])),
        ];
    }
}
