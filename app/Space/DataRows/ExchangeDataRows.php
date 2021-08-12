<?php

namespace App\Space\DataRows;

use App\Models\Exchanges\Exchange;
use App\Models\Lot;
use Closure;

class ExchangeDataRows extends BaseDataRows
{
    public function create($groupDataQuery, Closure $next)
    {
        $groupDataType = $groupDataQuery->where('slug', 'exchanges')->firstOrFail();

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

        $dataRow = $this->dataRow($groupDataType, 'status');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'select_dropdown',
                'display_name' => __('voyager::seeders.data_rows.status'),
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'details'      => [
                    'default' => 'DRAFT',
                    'options' => [
                        Exchange::STATUS_PUBLISHED => __('seeders.data_rows.status.published'),
                        Exchange::STATUS_DRAFT     => __('seeders.data_rows.status.draft'),
                        Exchange::STATUS_PENDING   => __('seeders.data_rows.status.pending'),
                        Exchange::STATUS_CLOSED   => __('seeders.data_rows.status.closed'),
                    ],
                ],
                'order' => 1,
            ])->save();
        }

        $dataRow = $this->dataRow($groupDataType, 'title');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => __('voyager::seeders.data_rows.title'),
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'order'        => 1,
            ])->save();
        }

        $dataRow = $this->dataRow($groupDataType, 'persian_title');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => __('seeders.data_rows.persian_title'),
                'required'     => 0,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'order'        => 1,
            ])->save();
        }

        $dataRow = $this->dataRow($groupDataType, 'description');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text_area',
                'display_name' => __('seeders.data_rows.description'),
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'order'        => 1,
            ])->save();
        }

        $dataRow = $this->dataRow($groupDataType, 'physcial_address');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text_area',
                'display_name' => __('seeders.data_rows.physcial_address'),
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'order'        => 2,
            ])->save();
        }

        $dataRow = $this->dataRow($groupDataType, 'logo');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'image',
                'display_name' => __('seeders.data_rows.pictures'),
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'order'        => 1,
                'details' => [
                    // 'allowed' => ['image'],
                    // 'max' => 2,
                    // 'min' => 1,
                ]
            ])->save();
        }

        $dataRow = $this->dataRow($groupDataType, 'site');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => __('seeders.data_rows.website'),
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'order'        => 2,
                'details' => [
                    'display' => [
                        'width' => 6,
                    ],
                    'validation' => [
                        'rule' => ['nullable', 'url']
                    ]
                ]
            ])->save();
        }

        $dataRow = $this->dataRow($groupDataType, 'site_with_query');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => __('seeders.data_rows.site_with_query'),
                'required'     => 0,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'order'        => 2,
                'details' => [
                    'display' => [
                        'width' => 6,
                    ],
                    'validation' => [
                        'rule' => ['nullable', 'url']
                    ]
                ]
            ])->save();
        }

        $checkbox_arr = [
            'two_factor_auth', 'app_android', 'app_ios', 'affiliate_support', 'cold_storage', 'integrated_wallet'
        ];

        foreach ($checkbox_arr as $checkbox) {

            $dataRow = $this->dataRow($groupDataType, $checkbox);
            if (!$dataRow->exists) {
                $dataRow->fill([
                    'type'         => 'checkbox',
                    'display_name' => __("seeders.data_rows.$checkbox"),
                    'required'     => 0,
                    'browse'       => 1,
                    'read'         => 1,
                    'edit'         => 1,
                    'add'          => 1,
                    'delete'       => 1,
                    'order'        => 3,
                    'details' => [
                        "on" => __("seeders.data_rows.enabled"),
                        "off" => __("seeders.data_rows.disabled"),
                        "checked" => false,
                    ]
                ])->save();
            }
        }

        $dataRow = $this->dataRow($groupDataType, 'irr_min_fee_percent');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'number',
                'display_name' => __('seeders.data_rows.irr_min_fee_percent'),
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'order'        => 3,
                'details' => [
                    'display' => [
                        'width' => 6,
                    ],
                    'validation' => [
                        'rule' => ['required', 'min:0.1']
                    ]
                ]
            ])->save();
        }

        $dataRow = $this->dataRow($groupDataType, 'irr_max_fee_percent');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'number',
                'display_name' => __('seeders.data_rows.irr_max_fee_percent'),
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'order'        => 3,
                'details' => [
                    'display' => [
                        'width' => 6,
                    ],
                    'validation' => [
                        'rule' => ['required']
                    ]
                ]
            ])->save();
        }

        $dataRow = $this->dataRow($groupDataType, 'usdt_min_fee_percent');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'number',
                'display_name' => __('seeders.data_rows.usdt_min_fee_percent'),
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'order'        => 3,
                'details' => [
                    'display' => [
                        'width' => 6,
                    ],
                    'validation' => [
                        'rule' => ['required']
                    ]
                ]
            ])->save();
        }

        $dataRow = $this->dataRow($groupDataType, 'usdt_max_fee_percent');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'number',
                'display_name' => __('seeders.data_rows.usdt_max_fee_percent'),
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'order'        => 3,
                'details' => [
                    'display' => [
                        'width' => 6,
                    ],
                    'validation' => [
                        'rule' => ['required']
                    ]
                ]
            ])->save();
        }

        $dataRow = $this->dataRow($groupDataType, 'verification_days');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'number',
                'display_name' => __('seeders.data_rows.verification_days'),
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'order'        => 3,
                'details' => [
                    'validation' => [
                        'rule' => ['required']
                    ]
                ]
            ])->save();
        }

        return $next($groupDataType);
    }
}
