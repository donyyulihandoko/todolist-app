<?php

namespace App\Http\Controllers;

use App\Http\Requests\TodolistRequest;
use App\Models\Todolist;
use App\Services\CategoryService;
use App\Services\TodolistService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\Test\Constraint\ResponseIsRedirected;

class TodolistController extends Controller
{
    private TodolistService $todolistService;
    private CategoryService $categoryService;

    public function __construct(TodolistService $todolistService, CategoryService $categoryService)
    {
        $this->todolistService = $todolistService;
        $this->categoryService = $categoryService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        $todolist = $this->todolistService->getTodolists();
        return response()->view('todolist.index', [
            'title' => 'Halaman Todolist',
            'todolist' => $todolist
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response
    {
        $categories = $this->categoryService->getCategories();
        return response()->view('todolist.create', [
            'title' => 'Halaman Create Todolist',
            'categories' => $categories
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TodolistRequest $request): RedirectResponse
    {
        $this->todolistService->saveTodolist($request->only([
            'todo',
            'description',
            'category_id'
        ]));

        return response()->redirectToRoute('todolist.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id): Response
    {
        $todolist = $this->todolistService->getTodolistById($id);
        $categories = $this->categoryService->getCategories();

        return response()->view('todolist.edit', [
            'title' => 'Hamalan Edit Todolist',
            'todolist' => $todolist,
            'categories' => $categories
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TodolistRequest $request, int $id): RedirectResponse
    {
        $this->todolistService->updateTodolist($id, $request->only([
            'todo',
            'description',
            'category_id'
        ]));

        // $todo = Todolist::find($id);
        // $todo->update([
        //     'todo' => $request->input('todo'),
        //     'category_id' => $request->input('category_id'),
        //     'description' => $request->input('description'),
        // ]);

        return response()->redirectToRoute('todolist.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        // $todo = Todolist::find($id);
        // $todo->delete();

        $this->todolistService->removeTodolist($id);

        return response()->redirectToRoute('todolist.index');
    }
}
