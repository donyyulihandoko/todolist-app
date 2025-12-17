@extends('layouts.app')
@section('content')
    <div class="row g-4">
        <div class="col-12">
            <div class="bg-secondary rounded h-100 p-4">
                <h6 class="mb-4">Todolist</h6>
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
                                        <a href="" class="btn btn-primary m-2"><i class="bi bi-pencil"></i></a>
                                        <form action="">
                                            <button type="submit" class="btn btn-danger m-2"><i
                                                    class="bi bi-trash"></i></button>
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
