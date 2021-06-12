<?php

namespace App\Space\DataRows;

use App\Models\Exchanges\Exchange;
use App\Models\Lot;
use Closure;

class CryptoDataRows extends BaseDataRows
{
    public function create($groupDataQuery, Closure $next)
    {
        $groupDataType = $groupDataQuery->where('slug', 'cryptos')->firstOrFail();

        $dataRow = $this->dataRow($groupDataType, 'id');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'number',
                'display_name' => __('voyager::seeders.data_rows.id'),
                'required'     => 1,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'order'        => 1,
            ])->save();
        }

        $dataRow = $this->dataRow($groupDataType, 'symbol');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => __('seeders.data_rows.symbol'),
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'order'        => 2,
                'details' => [
                    'validation' => [
                        'rule' => ['required', 'max:8'],
                    ]
                ]
            ])->save();
        }

        $dataRow = $this->dataRow($groupDataType, 'name');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => __('voyager::seeders.data_rows.name'),
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'order'        => 2,
                'details' => [
                    'validation' => [
                        'rule' => ['required', 'max:32'],
                    ]
                ]
            ])->save();
        }

        $dataRow = $this->dataRow($groupDataType, 'symbol');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => __('seeders.data_rows.symbol'),
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'order'        => 2,
            ])->save();
        }

        $dataRow = $this->dataRow($groupDataType, 'image');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'media_picker',
                'display_name' => __('seeders.data_rows.pictures'),
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'order'        => 2,
                'details' => [
                    'allowed' => ['image'],
                    'max' => 2,
                    'min' => 1,
                ]
            ])->save();
        }

        $dataRow = $this->dataRow($groupDataType, 'price');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'number',
                'display_name' => __('seeders.data_rows.price'),
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'order'        => 2,
                'details' => [
                    'validation' => [
                        'rule' => ['required', 'min:1']
                    ]
                ]
            ])->save();
        }

        $dataRow = $this->dataRow($groupDataType, 'volume');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'number',
                'display_name' => __('seeders.data_rows.volume'),
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'order'        => 2,
                'details' => [
                    'validation' => [
                        'rule' => ['required', 'min:1']
                    ]
                ]
            ])->save();
        }

        $dataRow = $this->dataRow($groupDataType, 'market_cap');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'number',
                'display_name' => __('seeders.data_rows.market_cap'),
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'order'        => 2,
                'details' => [
                    'validation' => [
                        'rule' => ['required', 'min:1']
                    ]
                ]
            ])->save();
        }

        return $next($groupDataType);
    }
}
