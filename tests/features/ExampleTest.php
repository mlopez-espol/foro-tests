<?php

class ExampleTest extends FeatureTestCase
{
    function test_basic_example()
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
