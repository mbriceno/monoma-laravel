<?php

namespace Tests\Unit\Models;

use App\Models\User;
use App\Repositories\UserRepository;
use Tests\TestCase;

class UserTest extends TestCase
{
    private UserRepository $userRepository;

    protected const USER_DATA = [
        'name' => 'John Doe',
        'username' => 'johnDoe2022',
        'email' => 'john.doe22@example.com',
        'password' => 'secret',
        'role' => UserRepository::MANAGER_ROLE,
    ];

    public function setUp(): void
    {
        parent::setUp();

        $this->userRepository = app(UserRepository::class);
    }

    public function test_it_can_fill_fillable_attributes()
    {
        $user = $this->userRepository->create(self::USER_DATA);

        $this->assertEquals(self::USER_DATA['name'], $user->name);
        $this->assertEquals(self::USER_DATA['email'], $user->email);
        $this->assertTrue(app('hash')->check('secret', $user->password)); // Verify password is hashed
        $this->assertEquals(self::USER_DATA['role'], $user->role);
    }

    public function test_it_hides_sensitive_attributes_when_serialized()
    {
        $user = new User(self::USER_DATA);

        $serializedUser = json_encode($user);
        $userData = json_decode($serializedUser, true);

        $this->assertArrayNotHasKey('password', $userData);
        $this->assertArrayNotHasKey('remember_token', $userData);
    }

    public function test_it_returns_the_id_as_jwt_identifier()
    {
        $user = new User(self::USER_DATA);

        $this->assertEquals($user->id, $user->getJWTIdentifier());
    }
}
