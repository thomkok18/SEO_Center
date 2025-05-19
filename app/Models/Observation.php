<?php

namespace App\Models;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Observation extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name_en',
        'name_nl',
    ];

    /**
     * Get search results of promotion urls from the promotion urls list.
     *
     * @param Request $request
     * @return LengthAwarePaginator
     */
    public static function getObservationSearchResults(Request $request): LengthAwarePaginator
    {
        return DB::table('observations')
            ->where('name', 'like', '%' . $request->name . '%')
            ->paginate(20);
    }
}
