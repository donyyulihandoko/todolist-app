@extends('layouts.app')
@section('content')
    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-sm-12 col-xl-6">
                <div class="bg-secondary rounded h-100 p-4">
                    <h6 class="mb-4">Edit Todolist</h6>
                    <form action="{{ route('todolist.update', $todolist->id) }}" method="POST">
                        @csrf @method('PUT')
                        <div class=" mb-3">
                            <label for="todo" class="form-label">Todo</label>
                            <input type="text" class="form-control" id="todo" name="todo"
                                aria-describedby="emailHelp" value="{{ $todolist->todo }}">
                            @error('todo')
                                {{ $message }}
                            @enderror
                        </div>
                        <div class=" mb-3">
                            <label for="category_id" class="form-label">Category</label>
                            <select class="form-select" id="category_id" name="category_id"
                                aria-label="Floating label select example">
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" @if ($category->id === $todolist->category->id) selected @endif :>
                                        {{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" placeholder="Description" id="description" name="description" style="height: 150px;">{{ $todolist->description }}</textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
