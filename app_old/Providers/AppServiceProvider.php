<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\URL;
use Carbon\Carbon;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //\
        /* VerifyEmail::toMailUsing(function (object $notifiable, string $url) {
            return (new MailMessage)
                ->subject('Подтвердите адрес электронный почты')
                ->line('Нажмите на кнопку ниже, чтобы подтвердить почту.')
                ->action('Подтвердить адрес электронный почты', $url);
        }); */
        VerifyEmail::toMailUsing(function ($notifiable) {
        
            // Генерация ссылки для подтверждения письма
            $verifyUrl = URL::temporarySignedRoute(
                'verification.verify', Carbon::now()->addMinutes(60), [
                    'id' => $notifiable->getKey(),
                    'hash' => sha1($notifiable->getEmailForVerification())
                ]
            );
            
            // Переменные, которые будут доступны в шаблоне письма
            $vars = [
                'url' => $verifyUrl
            ];
    
            return (new MailMessage)
                ->subject('Подтверждение почты') // Тема письма
                ->markdown('emails.verify', $vars); // Шаблон письма
        });
    }
}
