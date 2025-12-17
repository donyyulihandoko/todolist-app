<?php

namespace App\Services\Impl;

use App\Models\Todolist;
use App\Services\TodolistService;

class TodolistServiceImpl implements TodolistService
{
    public function getTodolists()
    {
        return Todolist::all();
    }
}
