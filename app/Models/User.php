<?php

namespace App\Models;

use Orchid\Filters\Types\Like;
use Orchid\Filters\Types\Where;
use Orchid\Filters\Types\WhereDateStartEnd;
use Orchid\Platform\Models\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use App\Traits\HasRolesAndPermissions;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Auth\MustVerifyEmail;
class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable, HasRolesAndPermissions;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
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
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'permissions',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'permissions'          => 'array',
        'email_verified_at'    => 'datetime',
        'password' => 'hashed',
    ];
    /* protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    } */

    /**
     * The attributes for which you can use filters in url.
     *
     * @var array
     */
    protected $allowedFilters = [
           'id'         => Where::class,
           'name'       => Like::class,
           'secondName' => Like::class,  
           'phone'      => Like::class,
           'snils'      => Like::class,
           'email'      => Like::class,
           'updated_at' => WhereDateStartEnd::class,
           'created_at' => WhereDateStartEnd::class,
    ];

    /**
     * The attributes for which can use sort in url.
     *
     * @var array
     */
    protected $allowedSorts = [
        'id',
        'name',
        'email',
        'updated_at',
        'created_at',
    ];
    public function getAllTestTries($date = null, $test_id = null)
    {
        $query = DB::table('user_test_try_view')
            ->where('user_id', $this->id);
            

        if ($date) {
            $query->whereDate('test_date', $date);
        }
        if ($test_id) {
            $query->where('test_id', $test_id);
        }

        return $query->orderBy('test_date', 'desc')->get();
    }
    public function documents()
    {
        return $this->hasMany(UserDocument::class, 'user_id', 'id');
    }

    public function payments()
    {
        return $this->hasMany(Payment::class, 'user_id', 'id');
    }
}
