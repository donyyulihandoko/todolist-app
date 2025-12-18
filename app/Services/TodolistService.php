<?php

namespace App\Services;

interface TodolistService
{
    public function getTodolists();

    public function saveTodolist(array $data);

    public function getTodolistById(int $id);

    public function updateTodolist(int $id, array $data);

    public function removeTodolist(int $id);
}
