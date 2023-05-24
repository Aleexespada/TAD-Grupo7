<?php

namespace Tests\Feature;

use App\Actions\Fortify\CreateNewUser;
use App\Models\Role;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class UserTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * Prueba la creación de un usuario.
     *
     * @return void
     */
    public function test_user_creation()
    {
        // Arrange
        $input = [
            'name' => 'John',
            'last_name' => 'Doe',
            'email' => 'john@example.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ];

        // Act
        $createNewUserAction = new CreateNewUser();
        $user = $createNewUserAction->create($input);

        // Assert
        // Comprueba que la tabla users contiene el usuario creado
        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'name' => 'John',
            'last_name' => 'Doe',
            'email' => 'john@example.com',
        ]);

        // Comprueba que el Hash se ha realizado correctamente
        $this->assertTrue(Hash::check('password123', $user->password));

        // Comprueba que el usuario tiene el rol user
        $role = Role::where('name', 'user')->first();
        $this->assertTrue($user->roles->contains($role));
    }
}
