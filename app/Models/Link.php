<?php

namespace App\Models;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class Link extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'website',
        'anchor_text',
        'anchor_url',
    ];

    /**
     * Get all website urls based on links.
     *
     * @return Collection
     */
    public static function getAllUniqueWebsiteUrls(): Collection
    {
        return DB::table('links')
            ->select('website')
            ->groupBy('website')
            ->get();
    }

    /**
     * Get search results of links from the link index page.
     *
     * @param Request $request
     * @return LengthAwarePaginator
     */
    public static function getLinkSearchResults(Request $request): LengthAwarePaginator
    {
        return DB::table('links')
            ->where(function($query) use ($request) {
                $query->orWhere('website', 'like', '%' . $request->search . '%')
                    ->orWhere('anchor_text', 'like', '%' . $request->search . '%')
                    ->orWhere('anchor_url', 'like', '%' . $request->search . '%');
            })
            ->paginate(20);
    }
}
