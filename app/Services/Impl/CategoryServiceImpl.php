<?php

namespace App\Services\Impl;

use App\Models\Category;
use App\Services\CategoryService;

class CategoryServiceImpl implements CategoryService
{
    public function getCategories()
    {
        return Category::all();
    }
}
