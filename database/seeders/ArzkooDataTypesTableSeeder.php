<?php

namespace Database\Seeders;

use App\Http\Controllers\Admin\AdminExchangeController;
use App\Http\Controllers\LotController;
use App\Http\Controllers\LotGroupController;
use App\Http\Controllers\OwnerController;
use App\Models\Exchanges\Exchange;
use App\Models\Lot;
use App\Models\LotGroup;
use App\Models\Owner;
use App\Policies\OwnerPolicy;
use Illuminate\Database\Seeder;
use TCG\Voyager\Models\DataType;

class ArzkooDataTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dataType = $this->dataType('slug', 'exchanges');
        if (!$dataType->exists) {
            $dataType->fill([
                'name'                  => 'exchanges',
                'display_name_singular' => __('seeders.data_types.exchanges.singular'),
                'display_name_plural'   => __('seeders.data_types.exchanges.plural'),
                'icon'                  => 'voyager-images',
                'model_name'            => Exchange::class,
                // 'controller'            => AdminExchangeController::class,
                'generate_permissions'  => 1,
                'description'           => '',
            ])->save();
        }
    }

    /**
     * [dataType description].
     *
     * @param [type] $field [description]
     * @param [type] $for   [description]
     *
     * @return [type] [description]
     */
    protected function dataType($field, $for)
    {
        return DataType::firstOrNew([$field => $for]);
    }
}
