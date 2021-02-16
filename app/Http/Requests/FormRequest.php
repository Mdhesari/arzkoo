<?php

namespace App\Http\Requests;

use Exception;
use Illuminate\Foundation\Http\FormRequest as BaseFromRequest;
use Str;
use Verta;

class FormRequest extends BaseFromRequest
{

    protected function prepareForValidation(): void
    {

        $data = collect($this->all());

        $data = $data->filter(fn ($field, $key) => Str::endsWith($key, ['_at', 'time']));

        $data = $data->map(function ($field) {

            try {
            if ($field && !empty($field))
                return Verta::parse($field)->datetime();
            } catch(Exception $e) {

                report($e);

                return $field;
            }

            return $field;
        });

        $this->merge($data->toArray());
    }
}
