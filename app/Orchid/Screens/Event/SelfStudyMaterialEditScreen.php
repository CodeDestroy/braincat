<?php

namespace App\Orchid\Screens\Event;

use App\Orchid\Layouts\Event\SelfStudyMaterialEditLayout;
use Orchid\Screen\Screen;
use Orchid\Screen\Actions\Button;
use App\Models\SelfStudyMaterial;
use Illuminate\Http\Request;
use Orchid\Support\Facades\Toast;
use Illuminate\Support\Facades\DB;

class SelfStudyMaterialEditScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public $selfStudyMaterial;
    public function query(SelfStudyMaterial $selfStudyMaterial): iterable
    {

        return [
            'selfStudyMaterial' => $selfStudyMaterial,
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return $this->selfStudyMaterial->exists ? 'Self study material Edit' : 'Self study material Create';
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
                ->canSee($this->selfStudyMaterial->exists),

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
            SelfStudyMaterialEditLayout::class,
        ];
    }

    /**
     * @throws \Exception
     *
     * @return \Illuminate\Http\RedirectResponse
     */

    public function save(Request $request, SelfStudyMaterial $selfStudyMaterial)
    {

        $selfStudyMaterial->fill($request->get('selfStudyMaterial'))->save();

        Toast::info(__('SelfStudyMaterial') . __(' was saved'));

        return redirect()->route('platform.events.selfStudyMaterials');
    }

    /**
     * @throws \Exception
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function remove(SelfStudyMaterial $selfStudyMaterial)
    {
        $selfStudyMaterial->delete();

        Toast::info(__('SelfStudyMaterial') . __(' was removed'));

        return redirect()->route('platform.events.selfStudyMaterials');
    }

}
