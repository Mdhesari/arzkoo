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

        $dataRow = $this->dataRow($groupDataType, 'logo');
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
                'order'        => 2,
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
                'order'        => 2,
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
                    'validation' => [
                        'rule' => ['nullable', 'url']
                    ]
                ]
            ])->save();
        }

        return $next($groupDataType);
    }
}
