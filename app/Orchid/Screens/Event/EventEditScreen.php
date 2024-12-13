<?php

namespace App\Orchid\Screens\Event;

use App\Orchid\Layouts\Event\EventEditLayout;
use Orchid\Screen\Screen;
use Orchid\Screen\Actions\Button;
use App\Models\Event;
use Illuminate\Http\Request;
use Orchid\Support\Facades\Toast;
use Illuminate\Support\Facades\DB;

class EventEditScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public $event;
    public function query(Event $event): iterable
    {

        return [
            'event' => $event,
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return $this->event->exists ? 'Event Edit' : 'Event Create';
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
                ->canSee($this->event->exists),

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
            EventEditLayout::class,
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
        $type = $request->event['type'];

        $image = DB::table('attachments')->where('id', $attachment_id)->first();
        
        $this->event->fill($request->get('event'));
        $this->event->type = $type;
        if ($image) {
            $this->event->image = ('/storage/' . $image->path . '/' . $image->name . '.' . $image->extension);
        }

        $this->event->save();
        Toast::info('You have successfully updated an event.');

        return redirect()->route('platform.events');
    }
    public function remove(Event $event)
    {
        $event->delete();

        Toast::info(__('Event was removed'));

        return redirect()->route('platform.events');
    }
}
