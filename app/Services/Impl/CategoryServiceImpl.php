<?php

namespace App\Services\Impl;

use App\Services\CategoryService;
use App\Models\Category;

class CategoryServiceImpl implements CategoryService
{
    public function getCategories()
    {
        return Category::all();
    }
}
