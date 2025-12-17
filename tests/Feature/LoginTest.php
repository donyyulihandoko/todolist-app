<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use RefreshDatabase;
    public function test_login_view_can_be_randered()
    {
        $this->get(route('login'))
            ->assertStatus(200)
            ->assertSeeText('Halaman Login');
    }

    public function test_user_login_succes()
    {
        $user = User::factory()->create();
        $this->post(route('login'), [
            'email' => $user->email,
            'password' => 'password'
        ])->assertRedirect('/home');
    }

    public function test_user_login_failed_empty_field()
    {
        $user = User::factory()->create();
        $this->post(route('login'), [])
            ->assertSessionHasErrors([
                'email' => 'The email field is required.',
                'password' => 'The password field is required.'
            ]);
    }

    public function test_user_login_failed_wrong_password()
    {
        $user = User::factory()->create();
        $this->post(route('login'), [
            'email' => $user->email,
            'password' => 'wrong password'
        ])->assertSessionHasErrors([
            'email' => 'These credentials do not match our records.'
        ]);
    }
}
