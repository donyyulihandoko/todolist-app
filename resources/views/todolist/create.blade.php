@extends('layouts.app')
@section('content')
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-sm-12 col-xl-6">
                <div class="bg-secondary rounded h-100 p-4">
                    <h6 class="mb-4">Create Todolist</h6>
                    <form action="{{ route('todolist.store') }}" method="POST">
                        @csrf
                        <div class=" mb-3">
                            <label for="todo" class="form-label">Todo</label>
                            <input type="text" class="form-control" id="todo" name="todo"
                                aria-describedby="emailHelp">
                            @error('todo')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class=" mb-3">
                            <label for="category_id" class="form-label">Category</label>
                            <select class="form-select" id="category_id" name="category_id"
                                aria-label="Floating label select example">
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Descriptyion</label>
                            <textarea class="form-control" placeholder="Description" id="description" name="description" style="height: 150px;"></textarea>
                            @error('description')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
