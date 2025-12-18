<?php

namespace App\Http\Controllers;

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
    public function store(Request $request): RedirectResponse
    {
        $this->todolistService->saveTodolist($request->only([
            'name',
            'description',
            'category_id'
        ]));

        return redirect()->route('todolist.index');
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
