<?php

namespace App\Space\DataRows;

class CommentDataRows extends BaseDataRows
{
    public function create($groupDataQuery, \Closure $next)
    {
        $groupDataType = $groupDataQuery->where('slug', 'comments')->firstOrFail();

        $dataRow = $this->dataRow($groupDataType, 'id');
        if ( ! $dataRow->exists ) {
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

        $dataRow = $this->dataRow($groupDataType, 'comment');
        if ( ! $dataRow->exists ) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => __('seeders.data_rows.comment'),
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'order'        => 2,
                'details'      => [
                    'validation' => [
                        'rule' => ['required', 'min:3'],
                    ]
                ]
            ])->save();
        }

        $dataRow = $this->dataRow($groupDataType, 'is_approved');
        if ( ! $dataRow->exists ) {
            $dataRow->fill([
                'type'         => 'checkbox',
                'display_name' => __('seeders.data_rows.comment'),
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'order'        => 1,
                'details'      => [
                    "on"      => __("seeders.data_rows.enabled"),
                    "off"     => __("seeders.data_rows.disabled"),
                    "checked" => false,
                ],
            ])->save();
        }
    }
}
