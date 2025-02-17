<?php

declare(strict_types=1);

namespace App\Orchid\Layouts\Chat;

use App\Models\Chapter;
use App\Models\Course;
use App\Models\Message;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Actions\ModalToggle;
use Orchid\Screen\Components\Cells\DateTimeSplit;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Layouts\Persona;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class MessagesListLayout extends Table
{
    /**
     * @var string
     */
    public $target = 'messages';

    /**
     * @return TD[]
     */
    public function columns(): array
    {
        return [
            TD::make('id', __('ID'))->defaultHidden()->sort(),
            TD::make('user_id', __('User'))
                ->render(function (Message $message) {
                    return ($message->user->secondName) . ' ' . ($message->user->name); 
                })
                ->sort(),
            TD::make('theme_id', __('Theme'))
                ->render(function (Message $message) {
                    return $message->theme->name; 
                })
                ->sort(),
            TD::make( 'text', __('Text'))->sort(),
            /* TD::make('image', __('Image'))
                ->render(function (Course $course) {
                    $imageHref = $course->image;
                    return "<img src='$imageHref' width='100px' height='100px'>";
                })
                ->sort(), */
            TD::make('attachments', __('Theme'))
                ->render(function (Message $message) {
                    if (count($message->attachments) > 0)
                        return '<a target="_blank" href="/storage/' . $message->attachments->first()->file . '">' . $message->attachments->first()->file . '</a>';
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
                ->align(TD::ALIGN_RIGHT)
                ->width('100px')
                ->render(function (Message $message) {
                    return ModalToggle::make(__('View'))
                        ->modal('messageViewModal')
                        ->method('view')
                        ->icon('bs.eye')
                        ->asyncParameters([
                            'user' => ($message->user->secondName) . ' ' . ($message->user->name),
                            'theme' => $message->theme->name,
                            'text' => $message->text,
                            'link' => count($message->attachments) > 0 ? '/storage/' . $message->attachments->first()->file : ''
                        ]);
                        /* ->parameters([
                            'user' => ($message->user->secondName) . ' ' . ($message->user->name),
                            'theme' => $message->theme->name,
                            'text' => $message->text,
                        ]); */
                }),
        
        ];
    }
}
