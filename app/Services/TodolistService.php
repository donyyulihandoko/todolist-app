<?php

namespace App\Services;

interface TodolistService
{
    public function getTodolists();

    public function saveTodolist(array $data);
}
