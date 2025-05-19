<?php

namespace App\Models;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'role_id',
        'language_id',
        'status_id',
        'company_id',
        'firstname',
        'inserts',
        'lastname',
        'phone',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Get the role that the user owns.
     *
     * @return BelongsTo
     */
    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }

    /**
     * Get the language that the user owns.
     *
     * @return BelongsTo
     */
    public function language(): BelongsTo
    {
        return $this->belongsTo(Language::class);
    }

    /**
     * Get the status that the user owns.
     *
     * @return BelongsTo
     */
    public function status(): BelongsTo
    {
        return $this->belongsTo(Status::class);
    }

    /**
     * Get the company that the user owns.
     *
     * @return BelongsTo
     */
    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    /**
     * Get the mailTo email that the user owns.
     *
     * @return HasMany
     */
    public function mailToCompany(): HasMany
    {
        return $this->hasMany(MailToCompany::class);
    }

    /**
     * When password is changed encrypt it.
     *
     * @param $value
     */
    public function setPasswordAttribute($value){
        $this->attributes['password'] = bcrypt($value);
    }

    /**
     * Get all users for the admin dashboard.
     *
     * @return LengthAwarePaginator
     */
    public static function getAllUsers(): LengthAwarePaginator
    {
        return DB::table('users')
            ->join('roles', 'users.role_id', '=', 'roles.id')
            ->join('languages', 'users.language_id', '=', 'languages.id')
            ->join('statuses', 'users.status_id', '=', 'statuses.id')
            ->select('users.*', 'roles.name as role', 'languages.code as language', 'statuses.name as status')
            ->paginate(20);
    }

    /**
     * Get all users for the admin dashboard.
     *
     * @return Collection
     */
    public static function getAllSEOUsers(): Collection
    {
        return DB::table('users')
            ->join('roles', 'users.role_id', '=', 'roles.id')
            ->join('languages', 'users.language_id', '=', 'languages.id')
            ->join('statuses', 'users.status_id', '=', 'statuses.id')
            ->select('users.*', 'roles.name as role', 'languages.code as language', 'statuses.name as status')
            ->where('roles.id', '=', Role::SEO)
            ->get();
    }

    /**
     * Get search results of users from the admin dashboard.
     *
     * @param Request $request
     * @return LengthAwarePaginator
     */
    public static function getAdminSearchResults(Request $request): LengthAwarePaginator
    {
        return DB::table('users')
            ->join('roles', 'users.role_id', '=', 'roles.id')
            ->join('languages', 'users.language_id', '=', 'languages.id')
            ->join('statuses', 'users.status_id', '=', 'statuses.id')
            ->select('users.*', 'roles.name as role', 'languages.code as language', 'statuses.name as status')
            ->where('users.role_id', 'like', '%' . $request->role_id . '%')
            ->where('users.status_id', 'like', '%' . $request->status_id . '%')
            ->where(function($query) use ($request) {
                $query->orWhere('firstname', 'like', '%' . $request->search . '%')
                    ->orWhere('inserts', 'like', '%' . $request->search . '%')
                    ->orWhere('lastname', 'like', '%' . $request->search . '%')
                    ->orWhere('phone', 'like', '%' . $request->search . '%')
                    ->orWhere('email', 'like', '%' . $request->search . '%')
                    ->orWhere('languages.code', 'like', '%' . $request->search . '%');
            })
            ->paginate(20);
    }

    /**
     * Get search results of users from the admin dashboard.
     *
     * @param Request $request
     * @return LengthAwarePaginator
     */
    public static function getCustomerSearchResults(Request $request): LengthAwarePaginator
    {
        return DB::table('websites')
            ->where('company_id', '=', auth()->user()->company_id)
            ->where('url', 'like', '%' . $request->search . '%')
            ->paginate(20);
    }
}
