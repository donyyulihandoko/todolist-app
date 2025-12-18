<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use Database\Seeders\CategorySeeder;
use Database\Seeders\TodolistSeeder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TodolistControllerTest extends TestCase
{
    use RefreshDatabase;
    protected function setUp(): void
    {
        parent::setUp();
        DB::table('todolists')->truncate();
        $this->seed([CategorySeeder::class]);
    }
    public function test_index()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route('todolist.index'));
        $response->assertStatus(200)
            ->assertSeeText('Halaman Todolist');
    }

    public function test_create()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route('todolist.create'));
        $response->assertStatus(200)
            ->assertSeeText('Create Todolist');
    }

    public function test_store_success()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->post(route('todolist.store'), [
            'todo' => 'test todo',
            'category_id' => 1,
            'description' => 'description test todo'
        ]);

        $response->assertStatus(302)
            ->assertRedirectToRoute('todolist.index');
    }

    public function test_store_failed_empty_form()
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)->post(route('todolist.store'), [
            'todo' => '',
            'category_id' => '',
            'description' => ''
        ]);

        $response->assertSessionHasErrors([
            'todo' => 'The todo field is required.',
            'category_id' => 'The category id field is required.',
            'description' => 'The description field is required.'
        ]);
    }

    public function test_edit()
    {
        $this->seed([CategorySeeder::class, TodolistSeeder::class]);
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route('todolist.edit', 1));

        $response->assertStatus(200)
            ->assertSeeText('Edit Todolist');
    }

    public function test_update_success()
    {
        $this->seed([CategorySeeder::class, TodolistSeeder::class]);
        $user = User::factory()->create();

        $response = $this->actingAs($user)->put(route('todolist.update', 1), [
            'todo' => 'test todo update',
            'category_id' => 1,
            'description' => 'description test todo'
        ]);

        $response->assertStatus(302)
            ->assertRedirectToRoute('todolist.index');
    }

    public function test_update_failed_empty_form()
    {
        $this->seed([CategorySeeder::class, TodolistSeeder::class]);
        $user = User::factory()->create();

        $response = $this->actingAs($user)->put(route('todolist.update', 1), []);

        $response->assertSessionHasErrors([
            'todo' => 'The todo field is required.',
            'category_id' => 'The category id field is required.',
            'description' => 'The description field is required.'
        ]);
    }

    public function test_destroy()
    {
        $this->seed([CategorySeeder::class, TodolistSeeder::class]);
        $user = User::factory()->create();

        $response = $this->actingAs($user)->delete(route('todolist.destroy', 1));
        $response->assertStatus(302)
            ->assertRedirectToRoute('todolist.index');
    }
}
