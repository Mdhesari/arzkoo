<?php

namespace Modules\Admin\Tests\Feature\Payments;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Admin\Entities\Admin;

class BasePaymentCase extends TestCase
{
    protected $admin;

    /**
     * Setup the test environment.
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->app->make(\Spatie\Permission\PermissionRegistrar::class)->registerPermissions();

        $this->artisan('db:seed');

        $this->admin = Admin::factory()->create();

        $this->actingAs($this->admin);
    }

    /**
     * giveCreatePaymentPermission
     *
     * @return void
     */
    public function giveCreatePaymentPermission()
    {

        $this->admin->givePermissionTo('create payment');
    }

    /**
     * giveCreateAdminPermission
     *
     * @return void
     */
    public function giveReadPaymentPermission()
    {

        $this->admin->givePermissionTo('read payment');
    }
}
