<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use Database\Seeders\UserSeeder;

class AuthenticationTest extends TestCase
{
    use RefreshDatabase;

    public function test_login_page()
    {
        $this->get(route('login'))
            ->assertSeeText('Halaman Login')
            ->assertStatus(200);
    }

    public function test_login_success()
    {
        $this->seed([UserSeeder::class]);
        $this->post(route('login'), [
            'email' => 'user1@example.com',
            'password' => 'password'
        ])->assertRedirectToRoute('home');
    }
}
