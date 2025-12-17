<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class TodolistControllerTest extends TestCase
{
    use RefreshDatabase;
    public function test_index()
    {
        $user = User::factory()->create();

        $this->actingAs($user)->get(route('todolist.index'))
            ->assertStatus(200)
            ->assertSeeText('Halaman Todolist');
    }
}
