<?php

use App\User;

class ApiTest extends TestCase
{

    public function testValidation()
    {

        $this->json('POST', 'tasks', [])
            ->seeJson([
                'number' => ['The number field is required.'],
                'array' => ['The array field is required.'],
                'email' => ['The email field is required.'],
                'token' => ['The token field is required.'],
            ])->assertResponseStatus(400);
    }

    public function testUserNotFound()
    {
        $input = [
            'number' => 1,
            'array' => [1],
            'email' => 'invalid@example.com',
            'token' => 'invalid'
        ];

        $this->json('POST', 'tasks', $input)
            ->seeJson([
                'User not found'
            ])->assertResponseStatus(400);
    }

    public function testInvalidToken()
    {
        $user = User::first();

        $input = [
            'number' => 1,
            'array' => [1],
            'email' => $user->email,
            'token' => 'invalid'
        ];

        $this->json('POST', 'tasks', $input)
            ->seeJson([
                'Access denied'
            ])->assertResponseStatus(403);
    }


    public function testCreate()
    {
        $user = User::first();

        $tasks_count = $user->tasks()->count();

        $input = [
            'number' => 5,
            'array' => [5, 5, 1, 7, 2, 3, 5],
            'email' => $user->email,
            'token' => $user->token
        ];


        $this->json('POST', 'tasks', $input)
            ->seeJson([
                4
            ]);

        $this->assertEquals($tasks_count + 1, $user->tasks()->count());
    }

}