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

    public function saveTodolist(array $data)
    {
        $formTodo = $this->mapTodolistForm($data);
        Todolist::query()->create($formTodo);
    }

    private function mapTodolistForm(array $data)
    {
        return [
            'todo' => $data['todo'],
            'description' => $data['description'],
            'category_id' => $data['category_id']
        ];
    }
}
