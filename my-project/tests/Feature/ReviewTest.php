<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Validation\ValidationException;
use Tests\TestCase;

class ReviewTest extends TestCase
{
    use DatabaseTransactions;

    public function test_creates_review_with_valid_data()
    {
        // Crear un usuario autenticado para la prueba
        $user = User::factory()->create();
        $this->actingAs($user);

        // Crear el producto para la valoración
        $product = Product::factory()->create();

        // Simular una solicitud POST válida al método rate()
        $response = $this->post('/productos/valorar', [
            'product' => $product->id,
            'rating' => 4,
            'email' => $user->email,
            'comment' => '¡Excelente producto!',
        ]);

        // Verificar que se haya creado la valoración en la base de datos
        $this->assertDatabaseHas('reviews', [
            'user_id' => $user->id,
            'product_id' => $product->id,
            'rating' => 4,
            'comment' => '¡Excelente producto!',
        ]);

        // Verificar la redirección y el mensaje de éxito
        $response->assertRedirect();
        $response->assertSessionHas('message', 'Valoración creada con éxito');
    }

    public function test_returns_error_with_invalid_data()
    {
        // Crear un usuario autenticado para la prueba
        $user = User::factory()->create();
        $this->actingAs($user);

        // Crear el producto para la valoración
        $product = Product::factory()->create();

        // Simular una solicitud POST inválida al método rate()
        $response = $this->post('/productos/valorar', [
            'product' => $product->id,
            'rating' => 6, // Rating inválido
            'email' => 'correo_invalido', // Email inválido
        ]);

        // Verificar que se haya redirigido de vuelta
        $response->assertRedirect();

        // Obtener los errores de validación
        $errors = $response->getSession()->get('errors')->getBag('default');

        // Obtener las claves de errores
        $errorKeys = $errors->keys();

        // Verificar las claves de errores esperadas
        $expectedErrorKeys = ['rating', 'email'];
        $this->assertEquals($expectedErrorKeys, $errorKeys);
    }
}
