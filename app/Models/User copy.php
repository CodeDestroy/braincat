<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Traits\HasRolesAndPermissions;
use App\Models\UserTestTryView;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable implements MustVerifyEmail
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasRolesAndPermissions;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'secondName',
        'patronymicName',
        'birthday',
        'gender',
        'address',
        'workPlace',
        'city',
        'street',
        'house',
        'flat',
        'postIndex',
        'email',
        'tgNickname',
        'hasWhatsApp',
        'password',
        'phone',
        'confirmed',
        'passportSeria',
        'passpoortNumber',
        'SNILS',
        'workPost',
        'spetiality',
        'hasSecondStep'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /* public function getAllTestTries()
    {
        // Предполагаем, что записи тестов хранятся в таблице user_test_try_view
        return $this->hasMany(UserTestTryView::class, 'user_id')->get();
    } */

    public function getAllTestTries($date = null)
    {
        $query = DB::table('user_test_try_view')
            ->where('user_id', $this->id);

        if ($date) {
            $query->whereDate('test_date', $date);
        }

        return $query->orderBy('test_date', 'desc')->get();
    }
    /* public function getAllTestTries() 
    {
        $test_tries = UserTestTryView::select('*')->get();
        return $test_tries;
    }

    public function getTestTriesByDate($date) 
    {
        $test_tries = UserTestTryView::select('*')->whereDate('test_date', '=', $date)->get();
        return $test_tries;
    } */
    
}
