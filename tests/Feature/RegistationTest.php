<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RegistationTest extends TestCase
{
    use RefreshDatabase;

    public function test_register_page_can_be_randered()
    {
        $this->get(route('register'))
            ->assertStatus(200)
            ->assertSeeText('Halaman Register');
    }

    public function test_register_new_user_success()
    {
        $data = [
            'name' => 'user test',
            'email' => 'user@test.com',
            'password' => 'password',
            'password_confirmation' => 'password'
        ];

        $this->post(route('register'), $data)
            ->assertStatus(302)
            ->assertRedirect('/home');
    }

    public function test_register_new_user_failed_empty_field()
    {
        $this->post(route('register'), [])
            ->assertStatus(302)
            ->assertSessionHasErrors([
                'name' => 'The name field is required.',
                'email' => 'The email field is required.',
                'password' => 'The password field is required.'
            ]);
    }

    public function test_register_new_user_failed_password_confirmation_not_match()
    {
        $data = [
            'name' => 'user test',
            'email' => 'user@test.com',
            'password' => 'password',
            'password_confirmation' => 'wrong password'
        ];

        $this->post(route('register'), $data)
            ->assertStatus(302)
            ->assertSessionHasErrors([
                'password' => 'The password field confirmation does not match.'
            ]);
    }
}
