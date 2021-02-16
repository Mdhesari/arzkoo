<?php

namespace Modules\Admin\Tests\Feature\Payments;

use App\Models\Payment\Payment;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Main\Entities\User\User;

class ReadPaymentTest extends BasePaymentCase
{
    /**
     * can_see_create_payment
     *
     * @return void
     * @test
     */
    public function can_see_payment()
    {
        $this->giveReadPaymentPermission();

        $payment = Payment::factory()->create();

        $response = $this->get(route('admin.payments.show', $payment));

        $response->assertSuccessful();
    }

    /**
     * cant_see_create_payment_without_permission
     *
     * @return void
     * @test
     */
    public function cant_see_payment_without_permission()
    {
        $payment = Payment::factory()->create();

        $response = $this->get(route('admin.payments.show', $payment));

        $response->assertForbidden();
    }
}
