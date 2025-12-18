<?php

namespace Tests\Feature;

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
}
