<?php

declare(strict_types=1);

namespace App\Orchid\Layouts\User;

use Orchid\Screen\Field;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\CheckBox;
use Orchid\Screen\Layouts\Rows;

class UserEditLayout extends Rows
{
    /**
     * The screen's layout elements.
     *
     * @return Field[]
     */
    public function fields(): array
    {
        return [
            Input::make('user.secondName')
                ->type('text')
                ->max(255)
                ->title(__('secondName'))
                ->placeholder(__('secondName')),
            Input::make('user.name')
                ->type('text')
                ->max(255)
                ->required()
                ->title(__('Name'))
                ->placeholder(__('Name')),
            Input::make('user.patronymicName')
                ->type('text')
                ->max(255)
                ->title(__('patronymicName'))
                ->placeholder(__('patronymicName')),
            Input::make('user.birthday')
                ->type('date')
                ->max(255)
                ->title(__('birthday'))
                ->placeholder(__('birthday')),
/*             Input::make('user.gender')
                ->type('text')
                ->max(255)
                ->title(__('gender'))
                ->placeholder(__('gender')), */
            
            Input::make('user.address')
                ->type('text')
                ->max(255)
                ->title(__('address'))
                ->placeholder(__('address')),    
                
            
            Input::make('user.email')
                ->type('email')
                ->required()
                ->title(__('Email'))
                ->placeholder(__('Email')),
            Input::make('user.tgNickname')
                ->type('text')
                ->max(255)
                ->title(__('tgNickname'))
                ->placeholder(__('tgNickname')),
            CheckBox::make('user.hasWhatsApp')
                ->sendTrueOrFalse()
                ->title(__('hasWhatsApp'))
                ->placeholder(__('hasWhatsApp')),
        ];
    }
}
