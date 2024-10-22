<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/style.css')}}">
    <script src="https://kit.fontawesome.com/c35bfed5f0.js" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <title>Document</title>
</head>
<body>
    <div class="top-row">
        <a href="/"><img id="logo" src="{{ asset('assets/logo.png') }}" alt="Logo" class="logo"></a>
        <div class="search-container">
            <form action="{{ route('search') }}" method="GET" style="text-align: center;">
                <input type="text" name="keywords" placeholder="Search posts..." required>
            </form>
        </div>
        <div class="top-row-right">
            <!-- Theme Switch Button -->
            <i class="fa-solid fa-moon dark-theme-switch" id="darkThemeSwitch" style="margin-right: 30px; font-size: 28px"></i>
            @auth
                <a href="/posts/create" title="Post" class="create-post-icon">
                    <i class="fa-solid fa-plus"></i>
                    <span style="margin-left: 5px;">Create post</span>
                </a>
            @endauth
            @auth
                <a href="{{ route('profile.show', auth()->user()->id) }}" title="Account" class="profile-icon">
                    <i class="fa-solid fa-user"></i>
                    <span style="margin-left: 5px;">Profile</span>
                </a>
            @endauth
            @auth
                @if (auth()->user()->is_admin)
                    <a href="/admin/users" title="Admin" class="admin">
                        <i class="fa-solid fa-hammer"></i>
                        <span style="margin-left: 5px;">Admin panel</span>
                    </a>
                @endif
            @endauth
            @auth
                <form action="/logout" method="POST">
                    @csrf
                    <button style="width: 100px; height: 30px; font-size: 16px;">
                        <i class="fa-solid fa-door-open"></i>
                        <span style="margin-left: 5px;">Logout</span>
                    </button>
                </form>
            @else
                <a href="/login" title="Account" class="login"><i class="fa-solid fa-right-to-bracket fa-xl"></i> Login</a>
                <a href="/register" title="Account" class="register"><i class="fa-solid fa-user-plus"></i> Register</a>
            @endauth
        </div>
    </div>
    @yield('content')
</body>
<script>
    // Check for saved theme preference on page load
    window.onload = function() {
        const savedTheme = localStorage.getItem('theme');
        const theme_picker = document.getElementById('darkThemeSwitch');
        const logo = document.getElementById('logo');

        if (savedTheme === 'dark') {
            document.body.classList.add('dark-theme');
            logo.src = '{{ asset('assets/logo-dark.png') }}'; // Set dark theme logo
            theme_picker.classList.remove('fa-moon'); // Remove moon icon
            theme_picker.classList.add('fa-sun'); // Add sun icon
        }
    };

    // Toggle dark theme and logo
    const theme_picker = document.getElementById('darkThemeSwitch');
    theme_picker.addEventListener('click', function() {
        document.body.classList.toggle('dark-theme');
        const logo = document.getElementById('logo');

        // Change theme icons based on the current theme
        if (document.body.classList.contains('dark-theme')) {
            logo.src = '{{ asset('assets/logo-dark.png') }}'; // Change to dark theme logo
            theme_picker.classList.remove('fa-moon'); // Remove moon icon
            theme_picker.classList.add('fa-sun'); // Add sun icon
            localStorage.setItem('theme', 'dark'); // Save dark theme preference
        } else {
            logo.src = '{{ asset('assets/logo.png') }}'; // Change back to light theme logo
            theme_picker.classList.remove('fa-sun'); // Remove sun icon
            theme_picker.classList.add('fa-moon'); // Add moon icon
            localStorage.setItem('theme', 'light'); // Save light theme preference
        }
    });
</script>


<script>
    function toggleEditForm(commentId) {
        const editForm = document.querySelector(`#comment-${commentId} .post-page-edit-comment-form`);
        editForm.style.display = (editForm.style.display === 'block') ? 'none' : 'block';
    }
</script>
</html>
