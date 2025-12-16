@extends('layouts.app')
@section('content')

    <div class="container col-xl-10 col-xxl-8 px-4 py-5">
        @if ($errors->any())
            <ul>
                @foreach ($errors->all() as $error)
                    <div class="row">
                        <div class="alert alert-danger" role="alert">
                            {{ $error }}
                        </div>
                    </div>
                @endforeach
            </ul>
        @endif
        <div class="row align-items-center g-lg-5 py-5">
            <div class="col-lg-7 text-center text-lg-start">
                <h1 class="display-4 fw-bold lh-1 mb-3">{{ $title ?? env('APP_NAME') }}</h1>
                <p class="col-lg-10 fs-4">by <a target="_blank" href="https://www.programmerzamannow.com/">Programmer Zaman
                        Now</a></p>
            </div>
            <div class="col-md-10 mx-auto col-lg-5">
                <form class="p-4 p-md-5 border rounded-3 bg-light" method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="form-floating mb-3">
                        <input name="name" type="text" class="form-control" id="name" placeholder="name">
                        <label for="name">Username</label>
                        @error('name')
                            <span style="color: red"">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-floating mb-3">
                        <input name="email" type="email" class="form-control" id="email" placeholder="email">
                        <label for="email">Email</label>
                        @error('email')
                            <span style="color: red"">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-floating mb-3">
                        <input name="password" type="password" class="form-control" id="password" placeholder="password">
                        <label for="password">Password</label>
                        @error('password')
                            <span style="color: red"">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-floating mb-3">
                        <input name="password_confirmation" type="password" class="form-control" id="password_confirmation"
                            placeholder="password_confirmation">
                        <label for="password_confirmation">Password Confirmation</label>
                        @error('password_confirmation')
                            <span style="color: red"">{{ $message }}</span>
                        @enderror
                    </div>
                    <button class="w-100 btn btn-lg btn-primary" type="submit">Sign Up</button>
                </form>
            </div>
        </div>
    </div>
@endsection
