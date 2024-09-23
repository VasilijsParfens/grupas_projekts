@extends('layout')
@section('content')
    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="register-container">
        <form action="{{ route('register') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="register-inputs">
                <div class="reg-input">
                    <label for="name">Name</label>
                    <input placeholder="Name:" type="text" id="name" name="name" value="{{ old('name') }}" required>
                </div>
                <div class="reg-input">
                    <label for="email">E-mail</label>
                    <input placeholder="E-mail:" type="email" id="email" name="email" value="{{ old('email') }}" required>
                </div>
                <div class="reg-input">
                    <label for="password">Password</label>
                    <input placeholder="Password:" type="password" id="password" name="password" required>
                </div>
                <div class="reg-input">
                    <label for="password_confirm">Confirm password</label>
                    <input placeholder="Confirm password:" type="password" id="password_confirmation" name="password_confirmation" required>
                </div>
                <div class="reg-input">
                    <label for="profile_picture">Upload picture:</label>
                    <input placeholder="Upload picture" type="file" name="profile_picture" accept="image/*">
                </div>
                <div class="reg-input">
                    <button type="submit">Register</button>
                </div>
            </div>
        </form>
    </div>
@endsection
