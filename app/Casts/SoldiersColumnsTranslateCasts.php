<?php

namespace App\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Database\Eloquent\Model;

class SoldiersColumnsTranslateCasts implements CastsAttributes
{
    /**
     * Cast the given value.
     *
     * @param  array<string, mixed>  $attributes
     */
    public function get(Model $model, string $key, mixed $value, array $attributes): mixed
    {
        if ($key === 'rank') {
            if ($value === 'soldiers')
                return "جندي";
            if ($value === 'non_commissioned_officers')
                return "ضابط صف";

            return "ضابط";
        }

        if ($key === 'marital_status') {
            if ($value === 'married')
                return "متزوج";

            return "اعزب";
        }
        return '';
    }

    /**
     * Prepare the given value for storage.
     *
     * @param  array<string, mixed>  $attributes
     */
    public function set(Model $model, string $key, mixed $value, array $attributes): mixed
    {
        return $value;
    }
}
