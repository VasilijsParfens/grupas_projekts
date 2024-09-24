<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trending Posts</title>
    <style>
        /* General Styling */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            transition: all 0.3s ease;
        }

        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #e0e0e0;
            padding: 10px 20px;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
            transition: background-color 0.3s ease;
        }

        header img {
            height: 40px;
        }

        .nav-links {
            display: flex;
            gap: 20px;
        }

        .nav-links img {
            width: 24px;
            cursor: pointer;
        }

        /* Tabs */
        .tabs {
            display: flex;
            justify-content: center;
            margin-top: 70px; /* Space for the fixed header */
            margin-bottom: 20px;
            gap: 15px;
        }

        .tab {
            padding: 10px 20px;
            background-color: #d0d0d0;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .tab.active {
            background-color: #888;
        }

        /* Post Grid with Slots */
        .content-slots {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            align-items: center;
            padding: 10px;
            margin: 0 auto;
            width: 90%; /* Adjust width to fit more slots */
        }

        .slot {
            width: 15%; /* Adjust for 6 posts per row */
            background-color: #ddd;
            border-radius: 5px;
            padding: 10px;
            box-sizing: border-box;
            text-align: center;
            margin-bottom: 20px;
            transition: background-color 0.3s ease;
        }

        .slot-image {
            width: 100%;
            height: 0;
            padding-bottom: 100%; /* Maintain square aspect ratio */
            background-color: #bbb;
            border-radius: 5px;
        }

        .slot-text {
            margin-top: 10px;
            font-size: 14px;
            color: #333;
        }

        /* Dark Theme */
        .dark-theme {
            background-color: #1e1e1e;
            color: #f0f0f0;
        }

        .dark-theme header {
            background-color: #333;
        }

        .dark-theme .tab {
            background-color: #444;
            color: #f0f0f0;
        }

        .dark-theme .tab.active {
            background-color: #888;
        }

        .dark-theme .slot {
            background-color: #444;
        }

        .dark-theme .slot-text {
            color: #f0f0f0;
        }

        /* Dark Theme Switcher */
        .dark-theme-switch {
            width: 30px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <header>
        <img src="logo.png" alt="Logo" id="logo">
        <div class="nav-links">
            <img src="create-post-icon.png" alt="Create post">
            <img src="profile-icon.png" alt="Profile">
            <img src="logout-icon.png" alt="Logout">
            <img src="dark-theme-icon.png" alt="Dark Theme Switch" class="dark-theme-switch" id="darkThemeSwitch">
        </div>
    </header>

    <div class="tabs">
        <div class="tab" id="newTab">New</div>
        <div class="tab" id="popularTab">Popular</div>
        <div class="tab" id="followingTab">Following</div>
        <div class="tab active" id="trendingTab">Trending</div>
    </div>

    <h2 style="text-align: center;">Trending posts</h2>

    <div class="content-slots">
        <!-- Post slots -->
        <div class="slot">
            <div class="slot-image"></div>
            <div class="slot-text">Post 1</div>
        </div>
        <div class="slot">
            <div class="slot-image"></div>
            <div class="slot-text">Post 2</div>
        </div>
        <div class="slot">
            <div class="slot-image"></div>
            <div class="slot-text">Post 3</div>
        </div>
        <div class="slot">
            <div class="slot-image"></div>
            <div class="slot-text">Post 4</div>
        </div>
        <div class="slot">
            <div class="slot-image"></div>
            <div class="slot-text">Post 5</div>
        </div>
        <div class="slot">
            <div class="slot-image"></div>
            <div class="slot-text">Post 6</div>
        </div>
        <div class="slot">
            <div class="slot-image"></div>
            <div class="slot-text">Post 7</div>
        </div>
        <div class="slot">
            <div class="slot-image"></div>
            <div class="slot-text">Post 8</div>
        </div>
        <div class="slot">
            <div class="slot-image"></div>
            <div class="slot-text">Post 9</div>
        </div>
        <div class="slot">
            <div class="slot-image"></div>
            <div class="slot-text">Post 10</div>
        </div>
        <div class="slot">
            <div class="slot-image"></div>
            <div class="slot-text">Post 11</div>
        </div>
        <div class="slot">
            <div class="slot-image"></div>
            <div class="slot-text">Post 12</div>
        </div>
    </div>

    <script>
        // Tab functionality
        const tabs = document.querySelectorAll('.tab');
        tabs.forEach(tab => {
            tab.addEventListener('click', function() {
                tabs.forEach(t => t.classList.remove('active'));
                tab.classList.add('active');
            });
        });

        // Dark Theme Toggle
        const themeSwitch = document.getElementById('darkThemeSwitch');
        themeSwitch.addEventListener('click', function() {
            document.body.classList.toggle('dark-theme');
            const logo = document.getElementById('logo');
            if (document.body.classList.contains('dark-theme')) {
                logo.src = 'logo-dark.png'; // Change to dark theme logo
                themeSwitch.src = 'light-theme-icon.png'; // Switch to light theme icon
            } else {
                logo.src = 'logo.png'; // Switch to light theme logo
                themeSwitch.src = 'dark-theme-icon.png'; // Switch to dark theme icon
            }
        });
    </script>
</body>
</html>
