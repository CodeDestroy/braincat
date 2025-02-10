<?php

namespace App\Orchid\Screens\Event;

use Orchid\Screen\Screen;
use App\Models\SelfStudyMaterial;
use Illuminate\Http\Request;
use Orchid\Support\Facades\Toast;
use App\Orchid\Layouts\Event\SelfStudyMaterialListLayout;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\Link;
class SelfStudyMaterialListScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */


    /* public function query(): iterable
    {
        $selfStudyMaterial =  SelfStudyMaterial::all();
        return ['selfStudyMaterial' => $selfStudyMaterial,];
    } */
    public function query(): iterable
    {
        return ['selfStudyMaterials' =>  SelfStudyMaterial::all(),];
    }
    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Self Study Material Management';
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function permission(): ?iterable
    {
        return [
            'platform.events',
        ];
    }
    public function commandBar(): iterable
    {
        return [
            Link::make(__('Add'))
                ->icon('bs.plus-circle')
                ->href(route('platform.events.selfStudyMaterials.create')),
        ];
    }

    /**
     * The screen's layout elements.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): iterable
    {
        return [SelfStudyMaterialListLayout::class];
    }
    public function remove(Request $request): void
    {
        SelfStudyMaterial::findOrFail($request->get('id'))->delete();

        Toast::info(__('Material was removed'));
    }
}
