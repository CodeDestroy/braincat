<?php

declare(strict_types=1);

namespace App\Orchid\Screens\Course;

use App\Models\Chapter;
use App\Orchid\Layouts\Course\ChapterListLayout;
use App\Orchid\Layouts\Course\CourseListLayout;
use Orchid\Platform\Models\Role;
use App\Models\Course;
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

class ChapterListScreen extends Screen
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
            'chapters' => Chapter::all(),
        ];
    }

    /**
     * The name of the screen displayed in the header.
     */
    public function name(): ?string
    {
        return __('Chapters') . ' ' . __('Management');
    }

    /**
     * Display header description.
     */
    public function description(): ?string
    {
        return 'A comprehensive list of all chapters';
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
            Link::make(__('Add'))
                ->icon('bs.plus-circle')
                ->href(route('platform.courses.chapters.create')),
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
            ChapterListLayout::class,
        ];
    }

    public function remove(Request $request): void
    {
        Chapter::findOrFail($request->get('id'))->delete();

        Toast::info(__('User was removed'));
    }
}
