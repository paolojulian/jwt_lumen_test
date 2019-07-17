<?php
use Laravel\Lumen\Testing\DatabaseTransactions;

class UserTest extends TestCase
{
    use DatabaseTransactions;

    protected $token, $header;
    public function setUp(): void
    {
        parent::setUp();
        $this->token = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJodHRwOlwvXC9sb2NhbGhvc3Q6ODAwMFwvYXV0aFwvbG9naW4iLCJpYXQiOjE1NjMyNjcyMjUsImV4cCI6MTU2MzI3MDgyNSwibmJmIjoxNTYzMjY3MjI1LCJqdGkiOiJtV0tQZWI2MjhQV3pKaDcwIiwic3ViIjoxLCJwcnYiOiI4N2UwYWYxZWY5ZmQxNTgxMmZkZWM5NzE1M2ExNGUwYjA0NzU0NmFhIn0.4wNJbQWt_6LV4q3jQ5e0y3IjJRFhSqLPZx6CzzSxUt4';
        $this->header = [
            'Authorization' => "Bearer $this->token"
        ];
    }

    /** @test */
    public function new_user_receives_success_message_and_201()
    {
        $body = [
            'name' => 'Pipz',
            'username' => 'pipz',
            'password' => 'admin123',
            'email' => 'scottypipz@gmail.com'
        ];
        $this->json('POST', '/auth/create', $body)
            ->seeStatusCode(201);
    }

    /** @test TODO */
    public function user_receives_token_upon_login()
    {
        $body = [
            'username' => 'client',
            'password' => 'admin123'
        ];
        $response = $this->post('/auth/login', $body, $this->header);
        $response->seeStatusCode(200);
        $response->seeJson(compact($this->token));

    }


    /** @test */
    public function user_can_get_all_pages()
    {
        $response = $this->get('/users/1/pages', $this->header);
        $response->seeStatusCode(200);
    }

}