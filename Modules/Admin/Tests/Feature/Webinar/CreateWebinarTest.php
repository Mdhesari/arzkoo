<?php

namespace Modules\Admin\Tests\Feature\Webinar;

use App\Models\Webinar\Webinar;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateWebinarTest extends BaseWebinarCase
{
    /**
     * Test creating webinar
     *
     * @test
     */
    public function can_see_create_webinar()
    {
        

        $response = $this->get(route('admin.webinars.add'));

        $response->assertSuccessful()
            ->assertSee(' Submit a new webinar ');
    }

    /**
     * Test creating webinar
     *
     * @test
     */
    public function can_create_webinar()
    {

        $count = $this->repository->count();

        $response = $this->createWebinar();

        $response->assertSessionHasNoErrors();

        // make sure webinar is created
        $this->assertEquals(++$count, $this->repository->count());

        $data = $response->decodeResponseJson();

        $webinar = $this->repository->find([
            'id' => $data['webinar']['id']
        ]);

        $this->assertIsObject($webinar);
    }
}
