<?php

namespace App\Http\Controllers;

use App\Http\Requests\TodolistRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\Todolist;
use App\Services\CategoryService;
use App\Services\TodolistService;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\Test\Constraint\ResponseIsRedirected;
use Illuminate\Support\Facades\Log;

class TodolistController extends Controller
{
    private TodolistService $todolistService;
    private CategoryService $categoryService;

    public function __construct(TodolistService $todolistService, CategoryService $categoryService)
    {
        $this->todolistService = $todolistService;
        $this->categoryService = $categoryService;
    }

    public function index(): Response
    {
        $todolist = $this->todolistService->getTodolists();
        return response()->view('todolist.index', [
            'title' => 'Halaman Todolist',
            'todolist' => $todolist
        ]);
    }


    public function create(): Response
    {
        $categories = $this->categoryService->getCategories();
        return response()->view('todolist.create', [
            'title' => 'Halaman Create Todolist',
            'categories' => $categories
        ]);
    }

    public function store(TodolistRequest $request): RedirectResponse
    {
        try {
            Log::info('store data todolist', [
                'user_id' => Auth::user()->id,
                'data' => $request->all()
            ]);

            $this->todolistService->saveTodolist($request->validated());

            return to_route('todolist.index')->with('success', 'Todolist created successfully!');
        } catch (Exception $e) {

            Log::error('Todolist created failed', [
                'message' => $e->getMessage()
            ]);

            return redirect()->back()
                ->withInput()
                ->with('error', 'Todolist create faliled');
        }
    }


    public function edit(int $id): Response
    {
        return response()->view('todolist.edit', [
            'title' => 'Halaman Edit Todolist',
            'todolist' => $this->todolistService->getTodolistById($id),
            'categories' => $this->categoryService->getCategories()
        ]);
    }


    public function update(TodolistRequest $request, int $id): RedirectResponse
    {
        try {
            $this->todolistService->updateTodolist($id, $request->validated());
            return to_route('todolist.index')->with('success', 'Todolist  update successfully!');
        } catch (Exception $e) {

            Log::error('Todolist update failed', [
                'message' => $e->getMessage()
            ]);
            return redirect()->back()->with('error', 'Todolist update faliled');
        }
    }


    public function destroy(int $id): RedirectResponse
    {
        try {
            $this->todolistService->removeTodolist($id);
            return redirect()->back()->with('success', 'Todolist deleted successfully');
        } catch (Exception $e) {

            Log::error('Todolist deleted failed', [
                'message' => $e->getMessage()
            ]);
            return redirect()->back()->with('error', 'Todolist deleted faliled');
        }
    }
}
