@extends('layouts.app')
@section('content')
    <div class="row g-4">
        <div class="col-12">
            <div class="bg-secondary rounded h-100 p-4">
                <h6 class="mb-4">Todolist</h6>
                <div class="mb-4">
                    <a href="{{ route('todolist.create') }}" class="btn btn-success">Create</a>
                </div>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Todo</th>
                                <th scope="col">Category</th>
                                <th scope="col">Description</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $a = 1;
                            @endphp
                            @foreach ($todolist as $todo)
                                <tr>
                                    <th scope="row">{{ $a++ }}</th>
                                    <td>{{ $todo->todo }}</td>
                                    <td>{{ $todo->category->name }}</td>
                                    <td>{{ $todo->description }}</td>
                                    <td>
                                        <a href="{{ route('todolist.edit', $todo->id) }}" class="btn btn-warning m-2"><i
                                                class="bi bi-pencil">Edit</i></a>
                                        <form action="{{ route('todolist.destroy', $todo->id) }}" method="POST">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="btn btn-danger m-2" id="deleteButton"
                                                onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')"><i
                                                    class="bi bi-trash">Delete</i></button>
                                        </form>
                                    </td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
