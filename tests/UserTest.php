<?php
use Laravel\Lumen\Testing\DatabaseTransactions;

class UserTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function NewUserReceivesASuccessMsgAnd201Status()
    {
        $body = [
            'name' => 'Pipz',
            'username' => 'pipz',
            'password' => 'admin123',
            'email' => 'scottypipz@gmail.com'
        ];
        $this->json('POST', '/auth/create', $body)
            ->seeStatusCode(201)
            ->seeJson([
                'Pipz has been successfully created'
            ]);
    }

    /* @test */
    public function a_user_receives_token_upon_login()
    {
        $user = factory('App\User')->create();
        $this->actingAs($user)
            ->get('/user');
    }

}