<?php

namespace App\Models;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class MailToCompany extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'company_id',
        'user_id'
    ];

    /**
     * Get the company that the mailto email owns.
     *
     * @return BelongsTo
     */
    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }

    /**
     * Get the user that the mailto email owns.
     *
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get all users for the admin dashboard.
     *
     * @param int $company_id
     * @return Collection
     */
    public static function findCompanyId(int $company_id): Collection
    {
        return DB::table('mail_to_companies')
            ->where('company_id', '=', $company_id)
            ->get();
    }

    /**
     * Get all emails for the customer support.
     *
     * @param int $company_id
     * @return Collection
     */
    public static function getSEOByCompanyId(int $company_id): Collection
    {
        $seo_employees = DB::table('users')
            ->join('mail_to_companies', 'mail_to_companies.user_id', '=', 'users.id')
            ->where('mail_to_companies.company_id', '=', $company_id)
            ->get();

        if (count($seo_employees) > 0) {
            return $seo_employees;
        }

        return User::getAllSEOUsers();
    }

    /**
     * Get all customer service mails of a company.
     *
     * @param int $company_id
     * @return LengthAwarePaginator
     */
    public static function getMailsByCompanyId(int $company_id): LengthAwarePaginator
    {
        return DB::table('mail_to_companies')
            ->join('users', 'users.id', '=', 'mail_to_companies.user_id')
            ->join('companies', 'companies.id', '=', 'mail_to_companies.company_id')
            ->where('mail_to_companies.company_id', '=', $company_id)
            ->select('users.email')
            ->paginate(20);
    }
}
