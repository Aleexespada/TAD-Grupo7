<?php

namespace Tests\Feature;

use App\Models\CartItem;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class CartTest extends TestCase
{
    use DatabaseTransactions;

    public function test_decrease_product()
    {
        // Crear un usuario autenticado para la prueba
        $user = User::factory()->create();
        $this->actingAs($user);

        // Crear el producto para la valoración
        $product = Product::factory()->create();

        // Crea el CartItem para la prueba
        $cartItem = CartItem::factory()->create([
            'user_id' => $user->id,
            'product_id' => $product->id,
            'quantity' => 2
        ]);

        // Ejecutar el método
        $response = $this->post(route('cart.decrease', $product->id), [
            'size' => $cartItem->size
        ]);

        // Verificar el resultado
        $response->assertRedirect(route('cart.index'));
        $this->assertDatabaseHas('cart_items', ['id' => $cartItem->id, 'quantity' => 1]); // Verificar que la cantidad se haya disminuido
    }
}
