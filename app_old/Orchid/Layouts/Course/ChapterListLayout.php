<?php

declare(strict_types=1);

namespace App\Orchid\Layouts\Course;

use App\Models\Chapter;
use App\Models\Course;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Components\Cells\DateTimeSplit;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Layouts\Persona;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class ChapterListLayout extends Table
{
    /**
     * @var string
     */
    public $target = 'chapters';

    /**
     * @return TD[]
     */
    public function columns(): array
    {
        return [
            TD::make('id', __('ID'))->defaultHidden()->sort(),
            TD::make('name', __('Title'))
                ->sort(),
            TD::make('description', __('Description'))
                ->defaultHidden()
                ->sort(),
            TD::make('course_id', __('Course'))
                ->render(function (Chapter $event) {
                    return $event->course->name; 
                })
                ->sort(),
            /* TD::make('image', __('Image'))
                ->render(function (Course $course) {
                    $imageHref = $course->image;
                    return "<img src='$imageHref' width='100px' height='100px'>";
                })
                ->sort(), */
            TD::make('start_date', __('Start date'))
                ->render(function (Chapter $chapter) {
                    $start_date = $chapter->start_date;
                    if ($start_date)
                        return \Carbon\Carbon::parse($start_date)->translatedFormat('d.m.y');
                    else 
                        return '';
                })->defaultHidden()
                /* ->usingComponent(DateTimeSplit::class) */
                ->sort(),
            TD::make('end_date', __('End date'))
                ->render(function (Chapter $chapter) {
                    $end_date = $chapter->end_date;
                    if ($end_date)
                        return \Carbon\Carbon::parse($end_date)->translatedFormat('d.m.y'); 
                    else 
                        return '';
                })->defaultHidden()
                ->sort(),
            TD::make('start_time', __('Start time'))
                ->render(function (Chapter $chapter) {
                    $start_time = $chapter->start_time;
                    if ($start_time)
                        return \Carbon\Carbon::parse($start_time)->translatedFormat('H:i');
                    else 
                        return '';
                })->defaultHidden()
                ->sort(),
            TD::make('end_time', __('End time'))
                ->render(function (Chapter $chapter) {
                    $end_time = $chapter->end_time;
                    if ($end_time)
                        return \Carbon\Carbon::parse($end_time)->translatedFormat('H:i');
                    else
                        return '';
                })->defaultHidden()
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
            TD::make('color', __('Color'))
                ->render(function (Chapter $chapter) {
                    return "<div style='background-color: {$chapter->color}; width: 50px; height: 30px; border-radius: 0.6rem;'></div>";
                })
                ->align(TD::ALIGN_RIGHT),
            
            TD::make(__('Actions'))
                ->align(TD::ALIGN_CENTER)
                ->width('100px')
                ->render(fn (Chapter $chapter) => DropDown::make()
                    ->icon('bs.three-dots-vertical')
                    ->list([

                        Link::make(__('Edit'))
                            ->route('platform.courses.chapters.edit', $chapter->id)
                            ->icon('bs.pencil'),

                        //Локализировать
                        Button::make(__('Delete'))
                            ->icon('bs.trash3')
                            ->confirm(__('Once the account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.'))
                            ->method('remove', [
                                'id' => $chapter->id,
                            ]),
                    ])),
        ];
    }
}
