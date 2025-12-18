<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Services\TodolistService;
use Database\Seeders\CategorySeeder;
use Database\Seeders\TodolistSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class TodolistServiceTest extends TestCase
{
    use RefreshDatabase;

    private TodolistService $todolistService;

    protected function setUp(): void
    {
        parent::setUp();
        DB::table('todolists')->truncate();
        $this->seed([CategorySeeder::class]);
        $this->todolistService = $this->app->make(TodolistService::class);
    }

    public function test_service_container_not_null()
    {
        $this->assertNotNull($this->todolistService);
    }

    public function test_get_todolists()
    {
        $this->seed([CategorySeeder::class, TodolistSeeder::class]);
        $todolist = $this->todolistService->getTodolists();
        self::assertNotNull($todolist);
        self::assertEquals(9, sizeof($todolist));
    }

    public function testSaveTodolist()
    {
        $data = [
            'todo' => 'test todo',
            'category_id' => 1,
            'description' => 'description test todo'
        ];

        $this->todolistService->saveTodolist($data);
        $todolist = $this->todolistService->getTodolists();

        $this->assertNotNull($todolist);
        foreach ($todolist as $todo) {
            $this->assertEquals('test todo', $todo->todo);
            $this->assertEquals(1, $todo->category_id);
            $this->assertEquals('description test todo', $todo->description);
        }
    }

    public function test_get_todolists_by_id()
    {
        $this->seed([CategorySeeder::class, TodolistSeeder::class]);
        $todolist =  $this->todolistService->getTodolistById(1);
        $this->assertEquals(1, $todolist->id);
    }

    public function test_update_todolist()
    {
        $this->seed([CategorySeeder::class, TodolistSeeder::class]);

        $data = [
            'todo' => 'test todo update',
            'category_id' => 1,
            'description' => 'description test todo update'
        ];

        $this->todolistService->updateTodolist(1, $data);

        $todolist = $this->todolistService->getTodolistById(1);

        $this->assertEquals('test todo update', $todolist->todo);
        $this->assertEquals(1, $todolist->category_id);
        $this->assertEquals('description test todo update', $todolist->description);
    }

    public function test_remove_todolist()
    {
        $data = [
            'todo' => 'test todo',
            'category_id' => 1,
            'description' => 'description test todo'
        ];

        $this->todolistService->saveTodolist($data);
        $this->todolistService->removeTodolist(1);
        $todolist = $this->todolistService->getTodolists();

        $this->assertEquals(0, sizeof($todolist));
    }
}
