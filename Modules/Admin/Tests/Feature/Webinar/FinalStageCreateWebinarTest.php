<?php

namespace Modules\Admin\Tests\Feature\Webinar;

use App\Models\Webinar\Webinar;
use Database\Seeders\DatabaseSeeder;
use Database\Seeders\WebinarPriceSeeder;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Main\Entities\User\User;

class FinalStageCreateWebinarTest extends BaseWebinarCase
{

    protected $webinar;

    /**
     * Setup the test environment.
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->webinar = Webinar::factory()->state([
            'admin_id' => $this->user->id,
            'status' => Webinar::SUBMITTED,
        ])->create();
    }

    /**
     * Test creating webinar
     *
     * @test
     */
    public function can_see_final_stage_page()
    {
        $response = $this->get(route('admin.webinars.add-final', $this->webinar));

        $response->assertSuccessful();
    }

    /**
     * Test creating webinar
     *
     * @test
     */
    public function can_not_see_final_stage_page_while_webinar_is_not_submited()
    {
        $this->webinar->status = Webinar::CREATED;

        $this->webinar->save();

        $response = $this->get(route('admin.webinars.add-final', $this->webinar));

        $response->assertStatus(403);
    }

    /**
     * Test creating webinar
     *
     * @test
     */
    public function can_get_price()
    {
        $this->artisan('db:seed --class=WebinarPriceSeeder');

        $data = [
            'number' => 1,

            'is_supported' => 1,

            'sell_video' => 1,

            'webinar_id' => $this->webinar->id,

            'webinar' => $this->webinar,
        ];

        $route = route('admin.webinars.get-price', $data);

        $response = $this->get($route);

        $response->assertSuccessful();
    }

    /**
     * Test creating webinar
     *
     * @test
     */
    public function can_redirect_to_gate_way()
    {
        $data = [
            'is_supported' => 1,

            'sell_video' => 1,

            'number' => 1,

            'mobile' => '09025050634'
        ];

        $response = $this->post(route('admin.webinars.final-submit', $this->webinar), $data);

        $response->assertSuccessful();
    }

    /**
     * Test creating webinar
     *
     * @test
     */
    public function paid_webinar_can_not_redirect_to_gate_way()
    {
        $this->webinar->status = Webinar::PENDING;

        $this->webinar->save();

        $data = [
            'is_supported' => 1,

            'sell_video' => 1,

            'number' => 1,

            'mobile' => '09025050634'
        ];

        $response = $this->post(route('admin.webinars.final-submit', $this->webinar), $data);

        $response->assertStatus(403);
    }
}
