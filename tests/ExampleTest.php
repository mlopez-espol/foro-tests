<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ExampleTest extends TestCase
{
    use DatabaseTransactions;
    /**
     * A basic functional test example.
     *
     * @return void
     */
    public function testBasicExample()
    {
        $username = 'Miguel Lopez';
        $email = 'miguel.lopez@espol.cl';

        $user = factory(\App\User::class)->create([
            'name' => $username,
            'email' => $email
        ]);

        $this->actingAs($user, 'api')
             ->visit('api/user')
             ->see($username)
             ->see($email);
    }
}
