<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Main Page</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f0f0f0; /* Light gray background */
            transition: background-color 0.3s, color 0.3s;
            color: #000;
        }

        .top-row {
            position: fixed; /* Keeps the top row fixed on scroll */
            top: 0;
            left: 0;
            right: 0;
            background-color: #4a90e2; /* Slightly darker and blue-ish */
            color: white;
            padding: 10px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            z-index: 1000; /* Ensure it's on top of other content */
            transition: background-color 0.3s;
        }

        .logo {
            height: 40px;
            transition: all 0.3s ease; /* Smooth transition for logo change */
        }

        .search-panel {
            padding: 5px;
            background-color: white;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            display: flex;
            align-items: center;
        }

        .search-panel input {
            border: none;
            outline: none;
            padding: 5px;
            font-size: 14px;
        }

        .top-row-right {
            display: flex;
            align-items: center;
        }

        .top-row-right img {
            height: 30px;
            width: 30px;
            margin-left: 15px;
            cursor: pointer;
        }

        .scrollable-container {
            overflow-y: auto;
            padding: 20px;
            box-sizing: border-box;
            margin-top: 60px; /* Space for the fixed top row */
        }

        .wide-container {
            background-color: white;
            margin-bottom: 20px;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            height: 300px; /* Fixed height for content blocks */
            transition: background-color 0.3s, color 0.3s;
        }

        .block-title {
            font-weight: bold;
            margin-bottom: 10px;
            font-size: 20px;
        }

        .content-slots {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px;
            height: calc(100% - 30px); /* Adjust for padding and title */
        }

        .slot {
            width: 14%; /* Space 5 slots evenly */
            background-color: #ddd;
            border-radius: 5px;
            padding: 10px;
            box-sizing: border-box;
            text-align: center;
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

        .dark-theme {
            background-color: #1e1e1e;
            color: #f0f0f0;
        }

        .dark-theme .top-row {
            background-color: #333;
        }

        .dark-theme .wide-container {
            background-color: #2c2c2c;
        }

        .dark-theme .search-panel {
            background-color: #444;
            color: #f0f0f0;
        }

        .dark-theme .search-panel input {
            background-color: #444;
            color: #f0f0f0;
        }

        .dark-theme .slot {
            background-color: #444;
        }

        .dark-theme .slot-text {
            color: #f0f0f0;
        }
    </style>
</head>
<body>
    <div class="top-row">
        <img src="logo.png" alt="Logo" class="logo" id="logo">
        <div class="search-panel">
            <input type="text" placeholder="Search...">
        </div>
        <div class="top-row-right">
            <img src="dark-theme-icon.png" alt="Dark Theme Switch" class="dark-theme-switch" id="darkThemeSwitch">
            <img src="settings-icon.png" alt="Settings">
            <img src="profile-icon.png" alt="Profile">
        </div>
    </div>

    <div class="scrollable-container">
        <div class="wide-container">
            <div class="block-title">Popular</div>
            <div class="content-slots">
                <div class="slot">
                    <div class="slot-image"></div>
                    <div class="slot-text">Slot 1</div>
                </div>
                <div class="slot">
                    <div class="slot-image"></div>
                    <div class="slot-text">Slot 2</div>
                </div>
                <div class="slot">
                    <div class="slot-image"></div>
                    <div class="slot-text">Slot 3</div>
                </div>
                <div class="slot">
                    <div class="slot-image"></div>
                    <div class="slot-text">Slot 4</div>
                </div>
                <div class="slot">
                    <div class="slot-image"></div>
                    <div class="slot-text">Slot 5</div>
                </div>
                <div class="slot">
                    <div class="slot-image"></div>
                    <div class="slot-text">Slot 6</div>
                </div>
            </div>
        </div>
        <div class="wide-container">
            <div class="block-title">Trending</div>
            <div class="content-slots">
                <div class="slot">
                    <div class="slot-image"></div>
                    <div class="slot-text">Slot 1</div>
                </div>
                <div class="slot">
                    <div class="slot-image"></div>
                    <div class="slot-text">Slot 2</div>
                </div>
                <div class="slot">
                    <div class="slot-image"></div>
                    <div class="slot-text">Slot 3</div>
                </div>
                <div class="slot">
                    <div class="slot-image"></div>
                    <div class="slot-text">Slot 4</div>
                </div>
                <div class="slot">
                    <div class="slot-image"></div>
                    <div class="slot-text">Slot 5</div>
                </div>
                <div class="slot">
                    <div class="slot-image"></div>
                    <div class="slot-text">Slot 6</div>
                </div>
            </div>
        </div>
        <div class="wide-container">
            <div class="block-title">Following</div>
            <div class="content-slots">
                <div class="slot">
                    <div class="slot-image"></div>
                    <div class="slot-text">Slot 1</div>
                </div>
                <div class="slot">
                    <div class="slot-image"></div>
                    <div class="slot-text">Slot 2</div>
                </div>
                <div class="slot">
                    <div class="slot-image"></div>
                    <div class="slot-text">Slot 3</div>
                </div>
                <div class="slot">
                    <div class="slot-image"></div>
                    <div class="slot-text">Slot 4</div>
                </div>
                <div class="slot">
                    <div class="slot-image"></div>
                    <div class="slot-text">Slot 5</div>
                </div>
                <div class="slot">
                    <div class="slot-image"></div>
                    <div class="slot-text">Slot 6</div>
                </div>
            </div>
        </div>
        <div class="wide-container">
            <div class="block-title">Recommended</div>
            <div class="content-slots">
                <div class="slot">
                    <div class="slot-image"></div>
                    <div class="slot-text">Slot 1</div>
                </div>
                <div class="slot">
                    <div class="slot-image"></div>
                    <div class="slot-text">Slot 2</div>
                </div>
                <div class="slot">
                    <div class="slot-image"></div>
                    <div class="slot-text">Slot 3</div>
                </div>
                <div class="slot">
                    <div class="slot-image"></div>
                    <div class="slot-text">Slot 4</div>
                </div>
                <div class="slot">
                    <div class="slot-image"></div>
                    <div class="slot-text">Slot 5</div>
                </div>
                <div class="slot">
                    <div class="slot-image"></div>
                    <div class="slot-text">Slot 6</div>
                </div>
            </div>
        </div>
        <div class="wide-container">
            <div class="block-title">Recent</div>
            <div class="content-slots">
                <div class="slot">
                    <div class="slot-image"></div>
                    <div class="slot-text">Slot 1</div>
                </div>
                <div class="slot">
                    <div class="slot-image"></div>
                    <div class="slot-text">Slot 2</div>
                </div>
                <div class="slot">
                    <div class="slot-image"></div>
                    <div class="slot-text">Slot 3</div>
                </div>
                <div class="slot">
                    <div class="slot-image"></div>
                    <div class="slot-text">Slot 4</div>
                </div>
                <div class="slot">
                    <div class="slot-image"></div>
                    <div class="slot-text">Slot 5</div>
                </div>
                <div class="slot">
                    <div class="slot-image"></div>
                    <div class="slot-text">Slot 6</div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Toggle dark theme and logo
        const theme_picker = document.getElementById('darkThemeSwitch');
        theme_picker.addEventListener('click', function() {
            document.body.classList.toggle('dark-theme');
            const logo = document.getElementById('logo');
            if (document.body.classList.contains('dark-theme')) {
                logo.src = 'logo-dark.png'; // Change to dark theme logo
				theme_picker.src = 'light-theme-icon.png';
            } else {
                logo.src = 'logo.png'; // Change back to light theme logo
				theme_picker.src = 'dark-theme-icon.png';
            }
        });
    </script>
</body>
</html>
