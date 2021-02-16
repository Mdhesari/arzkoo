<?php

namespace Modules\Admin\Tests\Feature\Webinar;

use App\Models\Webinar\Webinar;
use Illuminate\Http\UploadedFile;
use Modules\Main\Entities\User\User;
use Storage;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile as FileUploadedFile;

class ContinueCreateWebinarTest extends BaseWebinarCase
{
    /**
     * Test continue creating webinar
     *
     * @return void
     * @test
     */
    public function can_see_continue_create_webinar()
    {

        $webinar = $this->getFakeWebinar();

        $response = $this->get(route('admin.webinars.add.continue', [
            'webinar' => $webinar,
        ]));

        $response->assertSuccessful();
    }

    /**
     * Test create lesson
     *
     * @return void
     * @test
     */
    public function can_continue_create_lessons()
    {
        $webinar = $this->getFakeWebinar();

        $data = [
            'title' => 'درس اول',
            'start_time_at' => now()->addDays(5)->hour(1),
            'end_time_at' => now()->addDays(5)->hour(2),
        ];

        $response = $this->post(route('admin.lesson.store', $webinar), $data);

        $response->assertSessionHasNoErrors()
            ->assertSessionHas('success');
    }

    /**
     * Test create lesson ticket
     *
     * @return void
     * @test
     */
    public function can_continue_create_tickets()
    {

        $webinar = $this->getFakeWebinar();

        $data = [
            'title' => 'دانشجویی',
            'limit' => 1,
            'price' => 23000,
            'start_sell_time' => now()->addDays(5)->hour(3),
            'end_sell_time' => now()->addDays(5)->hour(5),
        ];

        $response = $this->post(route('admin.ticket.store', $webinar), $data);

        $response->assertSessionHasNoErrors()
            ->assertSessionHas('success');
    }

    /**
     * Test attach moderators
     *
     * @return void
     * @test
     */
    public function can_continue_attach_moderators()
    {

        $webinar = $this->getFakeWebinar();

        User::factory()->count(5)->create();

        $data = [
            'moderators' => User::limit(3)->pluck('id')->toArray()
        ];

        $response = $this->post(route('admin.webinar.add-moderator', $webinar), $data);

        $response->assertSessionHasNoErrors()
            ->assertSessionHas('success');
    }

    /**
     * Test attach moderators
     *
     * @return void
     * @test
     */
    public function can_continue_add_cover()
    {

        $webinar = $this->getFakeWebinar();

        $this->assertNull($webinar->cover);

        Storage::fake('public');

        $response = $this->post(route('admin.webinar.add-cover', $webinar), [
            'cover' => UploadedFile::fake('public')->image('cover.jpg')
        ]);

        $webinar->refresh();

        $this->assertNotNull($webinar->mediaCover());

        $response->assertSessionHasNoErrors();
    }
}
