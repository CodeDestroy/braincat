<?php

namespace App\Orchid\Screens\Course;

use App\Orchid\Layouts\Course\CourseEditLayout;
use Orchid\Screen\Screen;
use Orchid\Screen\Actions\Button;
use App\Models\Course;
use App\Models\Theme;
use App\Orchid\Layouts\Course\ThemeEditLayout;
use Illuminate\Http\Request;
use Orchid\Support\Facades\Toast;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Log;
class ThemeEditScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public $theme;
    public function query(Theme $theme): iterable
    {

        return [
            'theme' => $theme,
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return $this->theme->exists ? __('Edit') . ' ' . __('Theme') : __('Create') . ' ' . __('Theme');
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
                ->canSee($this->theme->exists),

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
            ThemeEditLayout::class,
        ];
    }


    /**
     * @throws \Exception
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function save(Request $request)
    {
        $this->theme->fill($request->get('theme'))->save();

        Toast::info(__('Theme') . __(' was saved'));

        return redirect()->route('platform.courses.chapters.themes');
    }
    public function remove(Theme $theme)
    {
        $theme->delete();

        Toast::info(__('Theme') . __(' was removed'));

        return redirect()->route('platform.courses.chapters.themes');
    }
}
