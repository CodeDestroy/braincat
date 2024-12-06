<?php

declare(strict_types=1);

namespace App\Orchid\Screens\Event;

use App\Orchid\Layouts\Event\EventListLayout;
use Orchid\Platform\Models\Role;
use App\Models\Event;
use Orchid\Screen\Action;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Components\Cells\DateTimeSplit;
use Orchid\Screen\Layout;
use Orchid\Screen\Screen;
use Orchid\Screen\TD;
use Illuminate\Http\Request;
use Orchid\Support\Facades\Toast;

class EventListScreen extends Screen
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
            'events' => Event::all(),
        ];
    }

    /**
     * The name of the screen displayed in the header.
     */
    public function name(): ?string
    {
        return 'Event Management';
    }

    /**
     * Display header description.
     */
    public function description(): ?string
    {
        return 'A comprehensive list of all events';
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
                ->href(route('platform.events.create')), */
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
            EventListLayout::class,
        ];
    }

    public function remove(Request $request): void
    {
        Event::findOrFail($request->get('id'))->delete();

        Toast::info(__('User was removed'));
    }
}
