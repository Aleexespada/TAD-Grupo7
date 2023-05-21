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
    public function testUserCreation()
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
        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'name' => 'John',
            'last_name' => 'Doe',
            'email' => 'john@example.com',
        ]);

        $this->assertTrue(Hash::check('password123', $user->password));

        $role = Role::where('name', 'user')->first();
        $this->assertTrue($user->roles->contains($role));
    }
}
