<?php

namespace Tests\Feature;

use App\Models\DiscountCoupon;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class DiscountCouponTest extends TestCase
{
    use DatabaseTransactions;

    public function test_applies_discount_with_valid_code()
    {
        // Crear un descuento de prueba en la base de datos
        $discountCoupon = DiscountCoupon::factory()->create([
            'code' => 'TESTCODE',
            'percentage' => 10,
            'uses_limit' => 5,
        ]);

        // Crear un usuario autenticado para la prueba
        $user = User::factory()->create();
        $this->actingAs($user);

        // Asociar el código de descuento con el usuario
        $discountCoupon->users()->attach($user, ['created_at' => now(), 'updated_at' => now()]);

        // Enviar una solicitud POST al método applyDiscount con un código de descuento válido
        $response = $this->post('/cesta/discount', [
            'discount_code' => 'TESTCODE',
        ]);

        // Verificar que la respuesta redirija de vuelta
        $response->assertRedirect();

        // Verificar que se muestre un mensaje de éxito
        $response->assertSessionHas('message', 'Código de descuento aplicado con éxito.');

        // Verificar que el descuento aplicado coincida con el descuento creado en la base de datos
        $response->assertSessionHas('discount_id', $discountCoupon->id);
    }

    public function test_displays_error_message_for_invalid_or_limit_exceeded_discount()
    {
        // Crear un usuario autenticado para la prueba
        $user = User::factory()->create();
        $this->actingAs($user);

        // Enviar una solicitud POST al método applyDiscount con un código de descuento no disponible
        $response = $this->post('/cesta/discount', [
            'discount_code' => 'INVALIDCODE',
        ]);

        // Verificar que la respuesta redirija de vuelta
        $response->assertRedirect();

        // Verificar que se muestre un mensaje de error
        $response->assertSessionHas('error', 'El código de descuento es inválido o ha alcanzado su límite de uso.');
    }

    public function test_displays_error_message_for_invalid_dicount_for_user()
    {
        // Crear un descuento de prueba en la base de datos
        $discountCoupon = DiscountCoupon::factory()->create([
            'code' => 'TESTCODE',
            'percentage' => 10,
            'uses_limit' => 5,
        ]);

        // Crear un usuario autenticado para la prueba
        $user = User::factory()->create();
        $this->actingAs($user);

        // Enviar una solicitud POST al método applyDiscount con un código de descuento válido
        $response = $this->post('/cesta/discount', [
            'discount_code' => 'TESTCODE',
        ]);

        // Verificar que la respuesta redirija de vuelta
        $response->assertRedirect();

        // Verificar que se muestre un mensaje de error
        $response->assertSessionHas('error', 'El código de descuento no está disponible.');
    }
}
