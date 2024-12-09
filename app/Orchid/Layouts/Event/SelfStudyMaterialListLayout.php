<?php

declare(strict_types=1);

namespace App\Orchid\Layouts\Event;

use App\Models\SelfStudyMaterial;
use App\Models\Event;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Components\Cells\DateTimeSplit;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class SelfStudyMaterialListLayout extends Table
{
    /**
     * @var string
     */
    public $target = 'selfStudyMaterials';

    /**
     * @return TD[]
     */
    public function columns(): array
    {
        return [
            TD::make('id', __('ID'))->defaultHidden(),
            TD::make('event_id', __('Event'))
                ->render(function (SelfStudyMaterial $selfStudyMaterial) {
                    $event = Event::find($selfStudyMaterial->event_id);
                    return $event->name; 
                })
                ->sort(),
            TD::make('title', __('Title'))
                ->sort(),
            TD::make('description', __('Description'))
                ->defaultHidden()
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
                ->render(fn (SelfStudyMaterial $selfStudyMaterial) => DropDown::make()
                    ->icon('bs.three-dots-vertical')
                    ->list([

                        Link::make(__('Edit'))
                            ->route('platform.events.selfStudyMaterials.edit', $selfStudyMaterial->id)
                            ->icon('bs.pencil'),

                        //Локализировать
                        Button::make(__('Delete'))
                            ->icon('bs.trash3')
                            ->confirm(__('Once the account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.'))
                            ->method('remove', [
                                'id' => $selfStudyMaterial->id,
                            ]),
                    ])),
        ];
    }
}
