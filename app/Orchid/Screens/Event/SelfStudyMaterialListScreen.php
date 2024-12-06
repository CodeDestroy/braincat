<?php

namespace App\Orchid\Screens\Event;

use Orchid\Screen\Screen;
use App\Models\SelfStudyMaterial;
class SelfStudyMaterialListScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        return ['selfStudyMaterials' => SelfStudyMaterial::all(),];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'SelfStudyMaterialListScreen';
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
        return [];
    }

    /**
     * The screen's layout elements.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): iterable
    {
        return [];
    }
}
