<?php

namespace Tests\Feature;

use App\Services\CategoryService;
use Database\Seeders\CategorySeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class CategoryServiceTest extends TestCase
{
    use RefreshDatabase;

    private CategoryService $categoryService;

    protected function setUp(): void
    {
        parent::setUp();
        // DB::table('categories')->truncate();
        $this->categoryService = $this->app->make(CategoryService::class);
    }

    public function test_service_container_not_null()
    {
        self::assertNotNull($this->categoryService);
    }

    public function test_getCategories()
    {
        $this->seed([CategorySeeder::class]);
        $todolist = $this->categoryService->getCategories();

        $this->assertNotNull($todolist);
        $this->assertEquals(9, sizeof($todolist));
    }
}
