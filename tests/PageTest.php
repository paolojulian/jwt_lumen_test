<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class PageTest extends TestCase
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
    public function receive_201status_upon_creating_a_page()
    {
        $body = [
            'name' => 'client',
            'url' => 'admin123',
            'parent_page_id' => 4,
        ];
        $response = $this->post('/pages', $body, $this->header);
        $response->seeStatusCode(201);
    }
}
