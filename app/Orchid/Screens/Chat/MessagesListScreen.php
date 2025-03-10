<?php

declare(strict_types=1);

namespace App\Orchid\Screens\Chat;

use App\Models\Chapter;
use App\Models\Message;
use App\Orchid\Layouts\Chat\MessagesListLayout;
use Orchid\Screen\Action;
use Orchid\Support\Facades\Layout;
use Orchid\Screen\Screen;
use Orchid\Screen\Fields\Input;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Orchid\Screen\Fields\Label;
use Orchid\Screen\Actions\Link;

use Orchid\Screen\Fields\TextArea;
use Orchid\Support\Facades\Toast;

class MessagesListScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            /* 'events' => Event::filters()->defaultSort('id', 'desc')->paginate(), */
            'messages' => Message::all(),
        ];
    }

    /**
     * The name of the screen displayed in the header.
     */
    public function name(): ?string
    {
        return __('Message') . ' ' . __('Management');
    }

    /**
     * Display header description.
     */
    public function description(): ?string
    {
        return 'A comprehensive list of all messages';
    }

    public function permission(): ?iterable
    {
        return [
            'platform.events',
        ];
    }

    /**
     * The screen's action buttons.
     *
     * @return Action[]
     */
    public function commandBar(): iterable
    {
        return [
            /* Link::make(__('Add'))
                ->icon('bs.plus-circle')
                ->href(route('platform.courses.chapters.create')), */
        ];
    }

    /**
     * The screen's layout elements.
     *
     * @return string[]|\Orchid\Screen\Layout[]
     */
    public function layout(): iterable
    {
        return [
            MessagesListLayout::class,
            Layout::modal('messageViewModal', Layout::rows([
                Label::make('user')
                    ->title('User'),
                Label::make('theme')
                    ->title('Theme'),
                Label::make('text')
                    ->title(value: 'Text'),
                Link::make('Скачать прикрепленный файл')
                    ->href('link')
            ]))
            ->title(__('Message view'))
            ->withoutApplyButton()
            /* ->deferred('getMessage') */
            ->async('asyncGetMessage'),
        ];
    }
    public function getMessage($user, $theme, $text): iterable
    {
        return [
            'user' => $user,
            'theme' => $theme,
            'text' => $text,
        ];
    }
    public function asyncGetMessage($user, $theme, $text, $link): iterable
    {
        
        return [
            'user' => $user,
            'theme' => $theme,
            'text' => $text,
            'link' => $link
        ];
    }
    public function remove(Request $request): void
    {
        Chapter::findOrFail($request->get('id'))->delete();

        Toast::info(__('Message') . ' ' . __('was removed'));
    }
}
