<?php

declare(strict_types=1);

namespace App\Orchid\Layouts\Course;

use App\Models\Chapter;
use App\Models\Course;
use App\Models\Theme;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Components\Cells\DateTimeSplit;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Layouts\Persona;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class ThemeListLayout extends Table
{
    /**
     * @var string
     */
    public $target = 'themes';

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
                ->render(function (Theme $theme) {
                    return $theme->course->name; 
                })
                ->sort(),
            TD::make('chapter_id', __('Chapter'))
                ->render(function (Theme $theme) {
                    if ($theme->chapter)
                        return $theme->chapter->name;
                    else
                        return ''; 
                })
                ->sort(),
            /* TD::make('image', __('Image'))
                ->render(function (Course $course) {
                    $imageHref = $course->image;
                    return "<img src='$imageHref' width='100px' height='100px'>";
                })
                ->sort(), */
            TD::make('start_date', __('Start date'))
                ->render(function (Theme $theme) {
                    $start_date = $theme->start_date;
                    if ($start_date)
                        return \Carbon\Carbon::parse($start_date)->translatedFormat('d.m.y');
                    else 
                        return '';
                })->defaultHidden()
                /* ->usingComponent(DateTimeSplit::class) */
                ->sort(),
            TD::make('end_date', __('End date'))
                ->render(function (Theme $theme) {
                    $end_date = $theme->end_date;
                    if ($end_date)
                        return \Carbon\Carbon::parse($end_date)->translatedFormat('d.m.y'); 
                    else 
                        return '';
                })->defaultHidden()
                ->sort(),
            TD::make('start_time', __('Start time'))
                ->render(function (Theme $theme) {
                    $start_time = $theme->start_time;
                    if ($start_time)
                        return \Carbon\Carbon::parse($start_time)->translatedFormat('H:i');
                    else 
                        return '';
                })->defaultHidden()
                ->sort(),
            TD::make('end_time', __('End time'))
                ->render(function (Theme $theme) {
                    $end_time = $theme->end_time;
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
            TD::make('calendar_visibility', __('Calendar visibility'))
                ->render(function (Theme $theme) {
                    return $theme->calendar_visibility ? __('Yes') : __('No');
                })
                ->align(TD::ALIGN_RIGHT),
            
            TD::make(__('Actions'))
                ->align(TD::ALIGN_CENTER)
                ->width('100px')
                ->render(fn (Theme $theme) => DropDown::make()
                    ->icon('bs.three-dots-vertical')
                    ->list([

                        Link::make(__('Edit'))
                            ->route('platform.courses.chapters.themes.edit', $theme->id)
                            ->icon('bs.pencil'),

                        //Локализировать
                        Button::make(__('Delete'))
                            ->icon('bs.trash3')
                            ->confirm(__('Once the account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.'))
                            ->method('remove', [
                                'id' => $theme->id,
                            ]),
                    ])),
        ];
    }
}
