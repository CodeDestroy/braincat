<?php

namespace App\Orchid\Screens\Course;

use App\Models\Chapter;
use App\Orchid\Layouts\Course\CourseEditLayout;
use Orchid\Screen\Screen;
use Orchid\Screen\Actions\Button;
use App\Models\Course;
use App\Orchid\Layouts\Course\ChapterEditLayout;
use Illuminate\Http\Request;
use Orchid\Support\Facades\Toast;
use Illuminate\Support\Facades\DB;

class ChapterEditScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public $chapter;
    public function query(Chapter $chapter): iterable
    {

        return [
            'chapter' => $chapter,
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return $this->chapter->exists ? __('Edit') . ' ' . __('Chapter')  : __('Create') . ' ' . __('Chapter') ;
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
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            //Сделать переход на страницу события
/*             Button::make(__('Impersonate user'))
                ->icon('bg.box-arrow-in-right')
                ->confirm(__('You can revert to your original state by logging out.'))
                ->method('loginAs')
                ->canSee($this->event->exists && $this->event->id !== \request()->user()->id),
 */
            Button::make(__('Remove'))
                ->icon('bs.trash3')
                ->confirm(__('Once the event is deleted, all of its resources and data will be permanently deleted.'))
                ->method('remove')
                ->canSee($this->chapter->exists),

            Button::make(__('Save'))
                ->icon('bs.check-circle')
                ->method('save'),
        ];
    }

    /**
     * The screen's layout elements.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): iterable
    {
        return [
            ChapterEditLayout::class,
        ];
    }
    /* public function save(Event $event, Request $request)
    {
        $request->validate([
            'event.name' => [
                'required'
            ],
            'event.course_id' => ['required'],
            'event.start_date' => ['required'],
            'event.end_date' => ['required'],
            'event.start_time' => ['required'],
            'event.end_time' => ['required'],
            'event.status' => ['required'],
                
        ]);
        $event->save($request->all());

        Toast::info(__('Event was saved.'));

        return redirect()->route('platform.events');
    } */

    /**
     * @throws \Exception
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function save(Request $request)
    {
        $chapter = $request->get('chapter');
        $this->chapter->fill($chapter);
        $this->chapter->color = $chapter['color'];
        $this->chapter->save();
        Toast::info(__('You have successfully updated a ') . __('chapter'));

        return redirect()->route('platform.courses.chapters');
    }
    public function remove(Chapter $chapter)
    {
        $chapter->delete();

        Toast::info(('Chapter') . __(' was removed'));

        return redirect()->route('platform.courses.chapters');
    }
}
