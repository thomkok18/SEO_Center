<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class ObservationCheck extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'observation_id',
        'check_id',
    ];

    /**
     * Get the observation that the promotion url owns.
     *
     * @return HasMany
     */
    public function observation(): HasMany
    {
        return $this->hasMany(Observation::class);
    }

    /**
     * Get the check that the promotion url owns.
     *
     * @return HasMany
     */
    public function check(): HasMany
    {
        return $this->hasMany(Check::class);
    }

    /**
     * Get observations from a promotion url.
     *
     * @param int $id
     * @return array
     */
    public static function getObservationChecksByPromotionUrl(int $id): array
    {
       $observations = DB::table('observation_checks')
            ->join('observations', 'observation_checks.observation_id', '=', 'observations.id')
            ->join('checks', 'observation_checks.check_id', '=', 'checks.id')
            ->join('promotion_url_checks', 'promotion_url_checks.check_id', '=', 'checks.id')
            ->select('observations.*')
            ->where('promotion_url_checks.promotion_url_id', '=', $id)
            ->get()
            ->toArray();

       if (count($observations) > 0) {
           $observationResults = [];

           foreach($observations as $observation) {
               array_push($observationResults, (array) $observation);
           }

           return $observationResults;
       } else {
           return [
               ['id' => '-']
           ];
       }
    }
}
