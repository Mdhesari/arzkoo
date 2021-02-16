<?php

namespace Modules\Admin\Tests\Feature\Payments;

use App\Models\MainUser;
use App\Models\Payment\Payment;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreatePaymentTest extends BasePaymentCase
{
    /**
     * can_see_create_payment
     *
     * @return void
     * @test
     */
    public function can_see_create_payment()
    {
        $this->giveCreatePaymentPermission();

        $response = $this->get(route('admin.payments.add'));

        $response->assertSuccessful();
    }

    /**
     * can_not_see_create_payment
     *
     * @return void
     * @test
     */
    public function can_not_see_create_payment_without_permission()
    {
        $response = $this->get(route('admin.payments.add'));

        $response->assertForbidden();
    }

    /**
     * can_create_payment
     *
     * @return void
     * @test
     */
    public function can_create_payment()
    {
        $this->giveCreatePaymentPermission();

        $payment = new Payment;
        $payment->title = "Charge user account";
        $payment->description = "Payment Verification : " . random_int(1, 5);
        $payment->amount = 12000;
        $payment->user()->associate(MainUser::factory()->create());

        $response = $this->post(route('admin.payments.add'), $payment->toArray());

        $response->assertSessionHasNoErrors()
            ->assertRedirect()
            ->assertSessionHas('success');
    }
}
