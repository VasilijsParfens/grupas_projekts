@extends('layout')

@section('content')
    <div class="register-container">
        <form action="{{ route('register') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="register-inputs">
                <div class="reg-input">
                    <label for="name">Name</label>
                    <input placeholder="Name:" type="text" id="name" name="name" value="{{ old('name') }}" required>
                    @error('name')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="reg-input">
                    <label for="email">E-mail</label>
                    <input placeholder="E-mail:" type="email" id="email" name="email" value="{{ old('email') }}" required>
                    @error('email')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="reg-input">
                    <label for="password">Password</label>
                    <input placeholder="Password:" type="password" id="password" name="password" required>
                    @error('password')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="reg-input">
                    <label for="password_confirmation">Confirm password</label>
                    <input placeholder="Confirm password:" type="password" id="password_confirmation" name="password_confirmation" required>
                    @error('password_confirmation')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="reg-input">
                    <label for="profile_picture">Upload picture:</label>
                    <input placeholder="Upload picture" type="file" name="profile_picture" accept="image/*">
                    @error('profile_picture')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="reg-input">
                    <button type="submit">Register</button>
                </div>
            </div>
        </form>
    </div>
@endsection
