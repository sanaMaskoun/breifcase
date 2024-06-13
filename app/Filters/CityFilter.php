<?php

namespace App\Filters;

use App\Enums\CountryEnum;
use App\Enums\SaudiCityEnum;
use App\Enums\UAECityEnum;
use Spatie\QueryBuilder\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;

class CityFilter implements Filter
{
    public function __invoke(Builder $query, $value, string $property)
    {
        $saudi_cities = SaudiCityEnum::getValues();
        $uae_cities = UAECityEnum::getValues();

        if (!is_array($value)) {
            $value = [$value];
        }

        $valid_saudi_cities = array_intersect($value, $saudi_cities);
        $valid_uae_cities = array_intersect($value, $uae_cities);

        if (!empty($valid_saudi_cities)) {
            $query->orWhere(function ($query) use ($valid_saudi_cities) {
                $query->where('country', CountryEnum::Saudi)
                      ->whereIn('city', $valid_saudi_cities);
            });
        }

        if (!empty($valid_uae_cities)) {
            $query->orWhere(function ($query) use ($valid_uae_cities) {
                $query->where('country', CountryEnum::UAE)
                      ->whereIn('city', $valid_uae_cities);
            });
        }
    }
}
