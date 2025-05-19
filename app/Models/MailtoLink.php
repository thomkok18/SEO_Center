<?php

namespace App\Models;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MailtoLink extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'firstname',
        'inserts',
        'lastname',
        'email',
    ];

    /**
     * Get search results of mails from the mail index page.
     *
     * @param Request $request
     * @return LengthAwarePaginator
     */
    public static function getMailSearchResults(Request $request): LengthAwarePaginator
    {
        return DB::table('mailto_links')
            ->where(function($query) use ($request) {
                $query->orWhere('email', 'like', '%' . $request->search . '%');
            })
            ->paginate(20);
    }
}
