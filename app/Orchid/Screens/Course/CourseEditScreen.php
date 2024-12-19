<?php

namespace App\Orchid\Screens\Course;

use App\Orchid\Layouts\Course\CourseEditLayout;
use Orchid\Screen\Screen;
use Orchid\Screen\Actions\Button;
use App\Models\Course;
use Illuminate\Http\Request;
use Orchid\Support\Facades\Toast;
use Illuminate\Support\Facades\DB;

class CourseEditScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public $course;
    public function query(Course $course): iterable
    {

        return [
            'course' => $course,
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return $this->course->exists ? 'Course Edit' : 'Course Create';
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
                ->canSee($this->course->exists),

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
            CourseEditLayout::class,
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
        $attachment_id = $request->get('image');


        $image = DB::table('attachments')->where('id', $attachment_id)->first();
        
        $this->course->fill($request->get('event'));

        if ($image) {
            $this->course->image = ('/storage/' . $image->path . '/' . $image->name . '.' . $image->extension);
        }

        $this->course->save();
        Toast::info('You have successfully updated an course.');

        return redirect()->route('platform.courses');
    }
    public function remove(Course $course)
    {
        $course->delete();

        Toast::info(__('Event was removed'));

        return redirect()->route('platform.events');
    }
}
