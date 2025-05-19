<?php

namespace App\Models;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class Company extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'debtor_number',
        'account_manager_email',
        'archived'
    ];

    /**
     * Get the user that the company owns.
     *
     * @return HasMany
     */
    public function user(): HasMany
    {
        return $this->hasMany(User::class);
    }

    /**
     * Get the company that the website owns.
     *
     * @return BelongsTo
     */
    public function website(): BelongsTo
    {
        return $this->belongsTo(Website::class);
    }

    /**
     * Get the mailTo email that the company owns.
     *
     * @return HasMany
     */
    public function mailToCompany(): HasMany
    {
        return $this->hasMany(MailToCompany::class);
    }

    /**
     * Get the competitor website that the company owns.
     *
     * @return HasMany
     */
    public function competitorWebsite(): HasMany
    {
        return $this->hasMany(CompetitorWebsite::class);
    }

    /**
     * Get company name of a user.
     *
     * @param int $userId
     * @return array
     */
    public static function getCompanyByUserId(int $userId): array
    {
        return DB::table('companies')
            ->join('users', 'companies.id', '=', 'users.company_id')
            ->where('users.id', '=' ,$userId)
            ->select('companies.name')
            ->get()
            ->toArray();
    }

    /**
     * Get company name of a user.
     *
     * @param string $companyName
     * @return array
     */
    public static function getCompanyByCompanyId(string $companyName): array
    {
        return DB::table('companies')
            ->where('companies.name', '=' ,$companyName)
            ->select('companies.id')
            ->get()
            ->toArray();
    }

    /**
     * Get all promotion urls by company name for the supplier.
     *
     * @return LengthAwarePaginator
     */
    public static function getAllCustomerCompanies(): LengthAwarePaginator
    {
        return DB::table('companies')
            ->join('users', 'companies.id', '=', 'users.company_id')
            ->where('companies.archived', false)
            ->where('users.role_id', Role::CUSTOMER)
            ->select('companies.id', 'companies.name')
            ->groupBy('companies.name', 'companies.id')
            ->paginate(20);
    }

    /**
     * Get all websites by company for the supplier.
     *
     * @param int|null $customer_id
     * @return LengthAwarePaginator|array
     */
    public static function getCustomerWebsitesByCompanies(int|null $customer_id): LengthAwarePaginator|array
    {
        if ($customer_id) {
            return DB::table('companies')
                ->join('users', 'companies.id', '=', 'users.company_id')
                ->join('websites', 'companies.id', '=', 'websites.company_id')
                ->where('users.role_id', Role::CUSTOMER)
                ->where('websites.company_id', $customer_id)
                ->select('websites.*')
                ->groupBy(
                    'websites.id',
                    'websites.company_id',
                    'websites.url',
                    'websites.created_at',
                    'websites.updated_at',
                )
                ->paginate(20);
        }

        return [];
    }

    /**
     * Get search results of companies from the companies overview.
     *
     * @param $request
     * @return LengthAwarePaginator
     */
    public static function getCompanySearchResults($request): LengthAwarePaginator
    {
        return DB::table('companies')
            ->where('name', 'like', '%' . $request->search . '%')
            ->where('archived', '=', false)
            ->paginate(20);
    }

    /**
     * Get search results of companies from the companies overview.
     *
     * @return LengthAwarePaginator
     */
    public static function getCompanyArchivedResults(): LengthAwarePaginator
    {
        return DB::table('companies')
            ->where('archived', '=', true)
            ->paginate(20);
    }
}
