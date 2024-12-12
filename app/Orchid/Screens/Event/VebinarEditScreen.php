<?php

namespace App\Orchid\Screens\Event;

use App\Orchid\Layouts\Event\VebinarEditLayout;
use Orchid\Screen\Screen;
use Orchid\Screen\Actions\Button;
use App\Models\Vebinar;
use Illuminate\Http\Request;
use Orchid\Support\Facades\Toast;
use Illuminate\Support\Facades\DB;

class VebinarEditScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public $vebinar;
    public function query(Vebinar $vebinar): iterable
    {

        return [
            'vebinar' => $vebinar,
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return $this->vebinar->exists ? 'Self study material Edit' : 'Self study material Create';
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
                ->canSee($this->vebinar->exists),

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
            VebinarEditLayout::class,
        ];
    }

    /**
     * @throws \Exception
     *
     * @return \Illuminate\Http\RedirectResponse
     */

    public function save(Request $request, Vebinar $vebinar)
    {

        $vebinar->fill($request->get('vebinar'))->save();

        Toast::info(__('SelfStudyMaterial was saved'));

        return redirect()->route('platform.events.vebinars');
    }

    /**
     * @throws \Exception
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function remove(Vebinar $vebinar)
    {
        $vebinar->delete();

        Toast::info(__('SelfStudyMaterial was removed'));

        return redirect()->route('platform.events.vebinars');
    }

}
