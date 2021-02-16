<?php

namespace Modules\Admin\Tests\Feature\Webinar;

use App\Models\Webinar\Webinar;
use App\Repository\WebinarRepositoryInterface;
use ftp;
use Hash;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Admin\Entities\Admin;
use Modules\Admin\Entities\User;

class BaseWebinarCase extends TestCase
{

    protected $user;

    protected $repository;

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

        $this->user = Admin::factory()->create();

        $this->repository = $this->app->make(WebinarRepositoryInterface::class);

        $this->actingAs($this->user);

        $this->user->givePermissionTo('create webinar');
        

    }

    protected function createWebinar()
    {
        $data = [
            'title' => 'وبینار کارآفرینی',
            'description' => 'کارآفرینی و سازندگی',
            'is_public' => true
        ];

        $response = $this->postJson(route('admin.webinar.store'), $data);

        return $response;
    }

    public function getFakeWebinar()
    {

        return $this->repository->factory()->create([
            'admin_id' => $this->user->id
        ]);
    }
}
