<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Post View</title>
    <style>
        :root {
            --background-color: #f0f0f0;
            --text-color: #000;
            --primary-color: #4a90e2;
            --secondary-color: #fff;
            --meta-text-color: gray;
            --button-bg-color: #007bff;
            --button-text-color: white;
        }

        /* Dark theme variables */
        .dark-theme {
            --background-color: #121212;
            --text-color: #e0e0e0;
            --primary-color: #1f1f1f;
            --secondary-color: #1c1c1c;
            --meta-text-color: #bbbbbb;
            --button-bg-color: #007bff;
            --button-text-color: white;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: var(--background-color);
            color: var(--text-color);
            margin: 0;
            padding: 0;
        }

        /* Top Bar */
        .top-row {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            background-color: var(--primary-color);
            color: var(--secondary-color);
            padding: 10px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            z-index: 1000;
            transition: background-color 0.3s;
        }

        .logo {
            height: 40px;
            transition: all 0.3s ease;
        }

        .search-panel {
            padding: 5px;
            background-color: var(--secondary-color);
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
            color: var(--text-color);
            background-color: var(--secondary-color);
        }

        .top-row-right img {
            height: 30px;
            width: 30px;
            margin-left: 15px;
            cursor: pointer;
        }

        .post-container {
            background-color: var(--secondary-color);
            width: 80%;
            max-width: 1200px;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin: 100px auto;
        }

        .top-section {
            display: flex;
            align-items: flex-start;
            margin-bottom: 20px;
        }

        .cover-image {
            width: 300px;
            height: 300px;
            background-color: #e0e0e0;
            margin-right: 20px;
        }

        .post-details {
            flex-grow: 1;
        }

        .profile-info {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }

        .profile-info img {
            border-radius: 50%;
            width: 60px;
            height: 60px;
            margin-right: 20px;
        }

        .metadata {
            color: var(--meta-text-color);
            font-size: 14px;
            margin-bottom: 15px;
        }

        .metadata span {
            margin-right: 15px;
        }

        .post-description {
            font-size: 16px;
            margin-bottom: 20px;
        }

        /* Like Button */
        .like-button {
            background-color: var(--button-bg-color);
            color: var(--button-text-color);
            border: none;
            padding: 10px 20px;
            font-size: 14px;
            border-radius: 5px;
            cursor: pointer;
        }

        /* Scrollable Files Section */
        .files {
            background-color: var(--background-color);
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
            max-height: 150px;
            overflow-y: scroll;
            color: var(--text-color);
        }

        .files .file {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }

        .files .file img {
            width: 40px;
            height: 40px;
            margin-right: 10px;
        }

        /* Scrollable and Threaded Comments */
        .comments {
            background-color: var(--background-color);
            padding: 15px;
            border-radius: 5px;
            max-height: 300px;
            overflow-y: scroll;
            color: var(--text-color);
        }

        .comment {
            display: flex;
            align-items: flex-start;
            margin-bottom: 10px;
            margin-left: 0;
        }

        .comment.reply {
            margin-left: 40px;
        }

        .comment img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            margin-right: 10px;
        }

        .comment-text {
            flex-grow: 1;
            background-color: var(--secondary-color);
            padding: 10px;
            border-radius: 5px;
            color: var(--text-color);
        }

        .comment-actions {
            color: var(--meta-text-color);
            font-size: 12px;
            margin-top: 5px;
        }

        .comment-actions span {
            margin-right: 10px;
            cursor: pointer;
        }

    </style>
</head>
<body>

    <!-- Top Bar -->
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

    <!-- Post Container -->
    <div class="post-container">
        <div class="top-section">
            <div class="cover-image">
                <img src="cover-image.png" alt="Cover image" style="width: 100%; height: 100%;">
            </div>

            <div class="post-details">
                <div class="profile-info">
                    <img src="user-image.png" alt="User image">
                    <div class="profile-details">
                        <h2>Author</h2>
                        <div class="metadata">
                            <span>18 Likes</span>
                            <span>4 comments</span>
                            <span>Posted 31.02.2024</span>
                        </div>
                    </div>
                </div>
                <div class="post-description">
                    This is the post description or comment. It can contain up to 200 characters. Example of a detailed post description.
                </div>
                <button class="like-button">Like Post</button>
            </div>
        </div>

        <!-- Scrollable Files Section -->
        <div class="files">
            <h3>Files:</h3>
            <div class="file">
                <img src="file-icon.png" alt="File">
                <span>image1.png</span>
            </div>
            <div class="file">
                <img src="file-icon.png" alt="File">
                <span>song1.mp3</span>
            </div>
        </div>

        <!-- Scrollable Comments Section with Threaded Comments -->
        <div class="comments">
            <h3>Comments:</h3>
            <div class="comment">
                <img src="avatar.png" alt="User avatar">
                <div class="comment-text">
                    <div>This is an awesome post!</div>
                    <div class="comment-actions">
                        <span>👍</span>
                        <span>👎</span>
                    </div>
                </div>
            </div>

            <div class="comment reply">
                <img src="avatar.png" alt="User avatar">
                <div class="comment-text">
                    <div>I totally agree!</div>
                    <div class="comment-actions">
                        <span>👍</span>
                        <span>👎</span>
                    </div>
                </div>
            </div>

            <div class="comment">
                <img src="avatar.png" alt="User avatar">
                <div class="comment-text">
                    <div>Thanks for sharing this!</div>
                    <div class="comment-actions">
                        <span>👍</span>
                        <span>👎</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const darkThemeSwitch = document.getElementById('darkThemeSwitch');
        const body = document.body;

        darkThemeSwitch.addEventListener('click', () => {
            body.classList.toggle('dark-theme');
			const logo = document.getElementById('logo');
            if (document.body.classList.contains('dark-theme')) {
                logo.src = 'logo-dark.png'; // Change to dark theme logo
				darkThemeSwitch.src = 'light-theme-icon.png';
            } else {
                logo.src = 'logo.png'; // Change back to light theme logo
				darkThemeSwitch.src = 'dark-theme-icon.png';
            }
        });
    </script>

</body>
</html>
