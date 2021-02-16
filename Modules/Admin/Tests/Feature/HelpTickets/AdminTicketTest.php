<?php

namespace Modules\Admin\Tests\Feature\HelpTickets;

use App\Models\HelpTicket;
use App\Models\TicketMessage;
use Arr;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Modules\Admin\Entities\Admin;
use Modules\Admin\Entities\User;

class AdminTicketTest extends TestCase
{

    /**
     * Setup the test environment.
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->artisan('db:seed');

        $this->helpticket = HelpTicket::first();

        $this->actingAs(Admin::first());
    }

    /**
     * Can view ticket
     *
     * @return void
     * @test
     */
    public function can_view_ticket()
    {

        $response = $this->get(route('admin.helpdesk.show', $this->helpticket));

        $response->assertSuccessful();
    }

    /**
     * Can view ticket
     *
     * @return void
     * @test
     */
    public function can_answer_ticket()
    {

        $response = $this->post(route('admin.helpdesk.store', $this->helpticket), [
            'message' => $message = 'Hey how can I help you?!'
        ]);

        $this->assertTrue(TicketMessage::whereBody($message)->exists());

        $response->assertSessionHasNoErrors()
            ->assertRedirect();
    }

    /**
     * Can view ticket
     *
     * @return void
     * @test
     */
    public function can_answer_ticket_with_uploading_files()
    {

        $files = [
            UploadedFile::fake()->image('test.jpg'),
            UploadedFile::fake()->image('test2.jpg')
        ];

        $response = $this->post(route('admin.helpdesk.store', $this->helpticket), [
            'message' => $text = 'Hey how can I help you?!',
            'files' => $files
        ]);

        $message = $this->helpticket->messages()->whereBody($text)->first();

        $this->assertEquals(count($files), $message->getMedia()->count());

        $response->assertSessionHasNoErrors()
            ->assertRedirect();
    }
}
