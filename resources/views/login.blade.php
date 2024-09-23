@extends('layout')
@section('content')
    <div class="container">
        @if ($errors->any())
            <div>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="login-container">
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="login-inputs">
                    <div class="log-input">
                        <label for="email">E-mail</label>
                        <input placeholder="E-mail:" type="email" id="email" name="email" required>
                    </div>
                    <div class="log-input">
                        <label for="password">Password</label>
                        <input placeholder="Password:" type="password" id="password" name="password" required>
                    </div>
                    <div class="log-input">
                        <button type="submit" class="btn btn-primary">Login</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
