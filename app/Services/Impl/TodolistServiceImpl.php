<?php

namespace App\Services\Impl;

use App\Models\Todolist;
use App\Services\TodolistService;
use Illuminate\Support\Facades\DB;

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

    public function getTodolistById(int $id)
    {
        return Todolist::query()->find($id);
    }

    public function updateTodolist(int $id, array $data)
    {
        $formTodo = $this->mapTodolistForm($data);
        $todo = $this->getTodolistById($id);
        if ($todo !== null) {
            $todo->update($formTodo);
        }
    }

    public function removeTodolist(int $id)
    {
        // $getTodolistById = $this->getTodolistById($id);
        // if ($getTodolistById !== null) {
        //     $getTodolistById->query()->delete();
        // }
        $todo = $this->getTodolistById($id);
        if ($todo !== null) $todo->delete();
    }
}
