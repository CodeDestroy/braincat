<?php

declare(strict_types=1);

use App\Orchid\Layouts\Course\ThemeListLayout;
use App\Orchid\Screens\Chat\MessagesListScreen;
use App\Orchid\Screens\Course\ChapterEditScreen;
use App\Orchid\Screens\Course\ChapterListScreen;
use App\Orchid\Screens\Course\CourseEditScreen;
use App\Orchid\Screens\Course\CourseListScreen;
use App\Orchid\Screens\Course\ThemeEditScreen;
use App\Orchid\Screens\Course\ThemeListScreen;
use App\Orchid\Screens\Examples\ExampleActionsScreen;
use App\Orchid\Screens\Examples\ExampleCardsScreen;
use App\Orchid\Screens\Examples\ExampleChartsScreen;
use App\Orchid\Screens\Examples\ExampleFieldsAdvancedScreen;
use App\Orchid\Screens\Examples\ExampleFieldsScreen;
use App\Orchid\Screens\Examples\ExampleGridScreen;
use App\Orchid\Screens\Examples\ExampleLayoutsScreen;
use App\Orchid\Screens\Examples\ExampleScreen;
use App\Orchid\Screens\Examples\ExampleTextEditorsScreen;
use App\Orchid\Screens\PlatformScreen;
use App\Orchid\Screens\Role\RoleEditScreen;
use App\Orchid\Screens\Role\RoleListScreen;
use App\Orchid\Screens\User\UserEditScreen;
use App\Orchid\Screens\User\UserListScreen;
use App\Orchid\Screens\User\UserProfileScreen;
use Illuminate\Support\Facades\Route;
use Tabuna\Breadcrumbs\Trail;

use App\Orchid\Screens\Event\EventListScreen;
use App\Orchid\Screens\Event\EventEditScreen;
use App\Orchid\Screens\Event\SelfStudyMaterialListScreen;
use App\Orchid\Screens\Event\SelfStudyMaterialEditScreen;
use App\Orchid\Screens\Event\VebinarListScreen;
use App\Orchid\Screens\Event\VebinarEditScreen;
/*
|--------------------------------------------------------------------------
| Dashboard Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the need "dashboard" middleware group. Now create something great!
|
*/

// Main
Route::screen('/main', PlatformScreen::class)
    ->name('platform.main');

// Platform > Profile
Route::screen('profile', UserProfileScreen::class)
    ->name('platform.profile')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.index')
        ->push(__('Profile'), route('platform.profile')));

// Platform > System > Users > User
Route::screen('users/{user}/edit', UserEditScreen::class)
    ->name('platform.systems.users.edit')
    ->breadcrumbs(fn (Trail $trail, $user) => $trail
        ->parent('platform.systems.users')
        ->push($user->name, route('platform.systems.users.edit', $user)));

// Platform > System > Users > Create
Route::screen('users/create', UserEditScreen::class)
    ->name('platform.systems.users.create')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.systems.users')
        ->push(__('Create'), route('platform.systems.users.create')));

// Platform > System > Users
Route::screen('users', UserListScreen::class)
    ->name('platform.systems.users')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.index')
        ->push(__('Users'), route('platform.systems.users')));

// Platform > System > Roles > Role
Route::screen('roles/{role}/edit', RoleEditScreen::class)
    ->name('platform.systems.roles.edit')
    ->breadcrumbs(fn (Trail $trail, $role) => $trail
        ->parent('platform.systems.roles')
        ->push($role->name, route('platform.systems.roles.edit', $role)));

// Platform > System > Roles > Create
Route::screen('roles/create', RoleEditScreen::class)
    ->name('platform.systems.roles.create')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.systems.roles')
        ->push(__('Create'), route('platform.systems.roles.create')));

// Platform > System > Roles
Route::screen('roles', RoleListScreen::class)
    ->name('platform.systems.roles')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.index')
        ->push(__('Roles'), route('platform.systems.roles')));

// Platform > Events
Route::screen('events', EventListScreen::class)
    ->name('platform.events')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.index')
        ->push(__('Events'), route('platform.events')));

//Platform > Events > Edit
Route::screen('events/{event}/edit', EventEditScreen::class)
    ->name('platform.event.edit')
    ->breadcrumbs(fn (Trail $trail, $event): Trail => $trail
        ->parent('platform.events')
        ->push(__('Edit'), route('platform.event.edit', $event)));

//Platform > Events > Create
Route::screen('events/create', EventEditScreen::class)
    ->name('platform.events.create')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.events')
        ->push(__('Create'), route('platform.events.create')));


// Platform > Events > SelfStudyMaterials
Route::screen('selfStudyMaterials', SelfStudyMaterialListScreen::class)
    ->name('platform.events.selfStudyMaterials')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.events')
        ->push(__('SelfStudyMaterials'), route('platform.events.selfStudyMaterials')));

//Platform > Events > SelfStudyMaterials > Edit
Route::screen('selfStudyMaterials/{selfStudyMaterial}/edit', SelfStudyMaterialEditScreen::class)
    ->name('platform.events.selfStudyMaterials.edit')
    ->breadcrumbs(fn (Trail $trail, $event): Trail => $trail
        ->parent('platform.events.selfStudyMaterials')
        ->push(__('Edit'), route('platform.events.selfStudyMaterials.edit', $event)));

//Platform > Events > SelfStudyMaterials > Create
Route::screen('selfStudyMaterials/create', SelfStudyMaterialEditScreen::class)
    ->name('platform.events.selfStudyMaterials.create')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.events.selfStudyMaterials')
        ->push(__('Create'), route('platform.events.selfStudyMaterials.create')));


// Platform > Events > Vebinars
Route::screen('vebinars', VebinarListScreen::class)
->name('platform.events.vebinars')
->breadcrumbs(fn (Trail $trail) => $trail
    ->parent('platform.events')
    ->push(__('Vebinars'), route('platform.events.vebinars')));

//Platform > Events > Vebinars > Edit
Route::screen('vebinars/{vebinar}/edit', VebinarEditScreen::class)
->name('platform.events.vebinar.edit')
->breadcrumbs(fn (Trail $trail, $event): Trail => $trail
    ->parent('platform.events.vebinars')
    ->push(__('Edit'), route('platform.events.vebinar.edit', $event)));

//Platform > Events > Vebinars > Create
Route::screen('vebinars/create', VebinarEditScreen::class)
->name('platform.events.vebinar.create')
->breadcrumbs(fn (Trail $trail) => $trail
    ->parent('platform.events.vebinars')
    ->push(__('Create'), route('platform.events.vebinar.create')));

// Platform > Courses 
Route::screen('messages', MessagesListScreen::class)
->name('platform.users.messages')
->breadcrumbs(fn (Trail $trail) => $trail
    ->parent('platform.index')
    ->push(__('Messages'), route('platform.users.messages')));


// Platform > Courses 
Route::screen('courses', CourseListScreen::class)
->name('platform.courses')
->breadcrumbs(fn (Trail $trail) => $trail
    ->parent('platform.index')
    ->push(__('Courses'), route('platform.courses')));

//Platform > Courses > Edit
Route::screen('courses/{course}/edit', CourseEditScreen::class)
->name('platform.courses.edit')
->breadcrumbs(fn (Trail $trail, $course): Trail => $trail
    ->parent('platform.courses')
    ->push(__('Edit'), route('platform.courses.edit', $course)));

//Platform > Courses > Create
Route::screen('vebinars/create', CourseEditScreen::class)
->name('platform.courses.create')
->breadcrumbs(fn (Trail $trail) => $trail
    ->parent('platform.courses')
    ->push(__('Create'), route('platform.courses.create')));

// Platform > Courses > Chapters
Route::screen('chapters', ChapterListScreen::class)
->name('platform.courses.chapters')
->breadcrumbs(fn (Trail $trail) => $trail
    ->parent('platform.courses')
    ->push(__('Chapters'), route('platform.courses.chapters')));

//Platform > Courses > Chapters > Edit
Route::screen('chapters/{chapter}/edit', ChapterEditScreen::class)
->name('platform.courses.chapters.edit')
->breadcrumbs(fn (Trail $trail, $chapter): Trail => $trail
    ->parent('platform.courses.chapters')
    ->push(__('Edit'), route('platform.courses.chapters.edit', $chapter)));

//Platform > Courses > Chapters > Create
Route::screen('chapters/create', ChapterEditScreen::class)
->name('platform.courses.chapters.create')
->breadcrumbs(fn (Trail $trail) => $trail
    ->parent('platform.courses')
    ->push(__('Create'), route('platform.courses.create')));

// Platform > Courses > Chapters > Themes
Route::screen('themes', ThemeListScreen::class)
->name('platform.courses.chapters.themes')
->breadcrumbs(fn (Trail $trail) => $trail
    ->parent('platform.courses.chapters')
    ->push(__('Chapters'), route('platform.courses.chapters.themes')));

//Platform > Courses > Chapters > Themes > Edit
Route::screen('themes/{theme}/edit', ThemeEditScreen::class)
->name('platform.courses.chapters.themes.edit')
->breadcrumbs(fn (Trail $trail, $chapter): Trail => $trail
    ->parent('platform.courses.chapters.themes')
    ->push(__('Edit'), route('platform.courses.chapters.themes.edit', $chapter)));

//Platform > Courses > Chapters > Themes > Create
Route::screen('themes/create', ThemeEditScreen::class)
->name('platform.courses.chapters.themes.create')
->breadcrumbs(fn (Trail $trail) => $trail
    ->parent('platform.courses.chapters.themes')
    ->push(__('Create'), route('platform.courses.chapters.themes.create')));

    //platform.courses.themes.create

// Example...
Route::screen('example', ExampleScreen::class)
    ->name('platform.example')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.index')
        ->push('Example Screen'));

Route::screen('/examples/form/fields', ExampleFieldsScreen::class)->name('platform.example.fields');
Route::screen('/examples/form/advanced', ExampleFieldsAdvancedScreen::class)->name('platform.example.advanced');
Route::screen('/examples/form/editors', ExampleTextEditorsScreen::class)->name('platform.example.editors');
Route::screen('/examples/form/actions', ExampleActionsScreen::class)->name('platform.example.actions');

Route::screen('/examples/layouts', ExampleLayoutsScreen::class)->name('platform.example.layouts');
Route::screen('/examples/grid', ExampleGridScreen::class)->name('platform.example.grid');
Route::screen('/examples/charts', ExampleChartsScreen::class)->name('platform.example.charts');
Route::screen('/examples/cards', ExampleCardsScreen::class)->name('platform.example.cards');

//Route::screen('idea', Idea::class, 'platform.screens.idea');
