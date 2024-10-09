<?php

namespace Tests\Feature;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Validator;
use Tests\TestCase;

class UserRequestTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function testValidationPasses()
    {
        $data = [
            'prenom' => $this->faker->firstName,
            'nom' => $this->faker->lastName,
            'email' => $this->faker->unique()->safeEmail,
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ];

        $request = new UserRequest;
        $validator = Validator::make($data, $request->rules());

        $this->assertTrue($request->authorize());
        $this->assertTrue($validator->passes());
    }

    public function testPrenomIsRequired()
    {
        $data = [
            'nom' => $this->faker->lastName,
            'email' => $this->faker->unique()->safeEmail,
        ];

        $request = new UserRequest;
        $validator = Validator::make($data, $request->rules());

        $this->assertFalse($validator->passes());
        $this->assertTrue($validator->fails());
        $this->assertArrayHasKey('prenom', $validator->errors()->toArray());
    }

    public function testNomIsRequired()
    {
        $data = [
            'prenom' => $this->faker->firstName,
            'email' => $this->faker->unique()->safeEmail,
        ];

        $request = new UserRequest;
        $validator = Validator::make($data, $request->rules());

        $this->assertFalse($validator->passes());
        $this->assertTrue($validator->fails());
        $this->assertArrayHasKey('nom', $validator->errors()->toArray());
    }

    public function testEmailIsUnique()
    {
        $existingUser = User::factory()->create();

        $data = [
            'prenom' => $this->faker->firstName,
            'nom' => $this->faker->lastName,
            'email' => $existingUser->email,
        ];

        $request = new UserRequest;
        $request->setRouteResolver(function () {
            return new class
            {
                public function parameter($name)
                {
                    return null;
                }
            };
        });

        $validator = Validator::make($data, $request->rules());

        $this->assertFalse($validator->passes());
        $this->assertTrue($validator->fails());
        $this->assertArrayHasKey('email', $validator->errors()->toArray());
    }

    public function testEmailCanBeSameForExistingUser()
    {
        $existingUser = User::factory()->create();

        $data = [
            'prenom' => $this->faker->firstName,
            'nom' => $this->faker->lastName,
            'email' => $existingUser->email,
        ];

        $request = new UserRequest;
        $request->setRouteResolver(function () use ($existingUser) {
            return new class($existingUser)
            {
                protected $user;

                public function __construct($user)
                {
                    $this->user = $user;
                }

                public function parameter($name)
                {
                    return $name === 'user' ? $this->user : null;
                }
            };
        });

        $validator = Validator::make($data, $request->rules());

        $this->assertTrue($validator->passes());
    }

    public function testPasswordConfirmation()
    {
        $data = [
            'prenom' => $this->faker->firstName,
            'nom' => $this->faker->lastName,
            'email' => $this->faker->unique()->safeEmail,
            'password' => 'password123',
            'password_confirmation' => 'different_password',
        ];

        $request = new UserRequest;
        $validator = Validator::make($data, $request->rules());

        $this->assertFalse($validator->passes());
        $this->assertTrue($validator->fails());
        $this->assertArrayHasKey('password', $validator->errors()->toArray());
    }
}
