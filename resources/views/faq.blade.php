@extends('layout')

@section('content')
    <style>
        @import url("https://fonts.googleapis.com/css2?family=Roboto&display=swap");

        * {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
            font-family: "Roboto", sans-serif;
        }

        .wrapper {
            max-width: 75%;
            margin: auto;
        }

        .wrapper>p,
        .wrapper>h1 {
            margin: 1.5rem 0;
            text-align: center;
        }

        .wrapper>h1 {
            letter-spacing: 3px;
        }

        .accordion {
            background-color: white;
            color: rgba(0, 0, 0, 0.8);
            cursor: pointer;
            font-size: 1.2rem;
            width: 100%;
            padding: 2rem 2.5rem;
            border: none;
            outline: none;
            transition: 0.4s;
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-weight: bold;
        }

        .accordion i {
            font-size: 1.6rem;
        }

        .active,
        .accordion:hover {
            background-color: #f1f7f5;
        }

        .pannel {
            padding: 0 2rem 2.5rem 2rem;
            background-color: white;
            overflow: hidden;
            background-color: #f1f7f5;
            display: none;
        }

        .pannel p {
            color: rgba(0, 0, 0, 0.7);
            font-size: 1.2rem;
            line-height: 1.4;
        }

        .faq {
            border: 1px solid rgba(0, 0, 0, 0.2);
            margin: 10px 0;
        }

        .faq.active {
            border: none;
        }
    </style>
</head>

<body>
    <div class="wrapper">

        <h1>Frequently Asked Questions</h1>

        <div class="faq">
            <button class="accordion">
                How to create a new account?
                <i class="fa-solid fa-chevron-down"></i>
            </button>
            <div class="pannel">
                <p>
                    To create a new account, go to the registration page and fill in all the required fields. Enter your name, email and password and confirm the password. You also have the option to upload a profile picture that will appear on your profile. Once all the fields are filled, click the "Register" button to complete the registration process. If there are any errors, they will be shown and you can make corrections before submitting.
                </p>
            </div>
        </div>

        <div class="faq">
            <button class="accordion">
                How to log in?
                <i class="fa-solid fa-chevron-down"></i>
            </button>
            <div class="pannel">
                <p>
                    To log in, go to the login page and enter your email address and the password you provided during registration. Click the "Login" button to confirm your details and access your account. In case of successful login, you will be redirected to the home page or a section accessible to other authorized users.
                </p>
            </div>
        </div>

        <div class="faq">
            <button class="accordion">
                How to create a new post?
                <i class="fa-solid fa-chevron-down"></i>
            </button>
            <div class="pannel">
                <p>
                    To create a new post, first click on "Create post" or go to the /posts/create page. Here you will see the form you need to fill out. Enter the title of the publication, a description, choose a cover image to be displayed in the publication, and add additional files if necessary (maximum five files). When you're ready, hit the "Create Post" button to publish your post.
                </p>
            </div>
        </div>

        <div class="faq">
            <button class="accordion">
                How to search for publications?
                <i class="fa-solid fa-chevron-down"></i>
            </button>
            <div class="pannel">
                <p>
                    To find a publication, the user must click on the search field at the top of the website. The user can filter/search publications with keywords that the publication contains, i.e. the author's name, title and description.
                </p>
            </div>
        </div>

        <div class="faq">
            <button class="accordion">
                How to rate publication?
                <i class="fa-solid fa-chevron-down"></i>
            </button>
            <div class="pannel">
                <p>
                    To rate a publication, the user should open the required publication and press the "Like" rating button, and then the "Like" button will change color. If the user no longer likes the publication, or the user simply wants to remove his rating, the user must press the "Like" button next to the publication again and then the rating will be removed.
                </p>
            </div>
        </div>

        <div class="faq">
            <button class="accordion">
                How to edit publication?
                <i class="fa-solid fa-chevron-down"></i>
            </button>
            <div class="pannel">
                <p>
                    If you want to edit an existing publication, first go to its page. If you are the author of the post, an "Edit Post" button will be displayed. Click on it and an edit form will open. Here you can change the post title, description, cover image or upload new files. When you're done making your changes, hit the "Update Post" button to save them.
                </p>
            </div>
        </div>

        <div class="faq">
            <button class="accordion">
                How to delete publication?
                <i class="fa-solid fa-chevron-down"></i>
            </button>
            <div class="pannel">
                <p>
                    If you need to delete a publication, you will also see the "Delete Post" button while on its page. Clicking on it will prompt you for confirmation to avoid accidental deletion. Confirm your choice and the publication will be permanently deleted from the system.
                </p>
            </div>
        </div>

        <div class="faq">
            <button class="accordion">
                 How to add a comment?
                <i class="fa-solid fa-chevron-down"></i>
            </button>
            <div class="pannel">
                <p>
                    To add a comment to a publication, open the publication, press the comment field and type your comment (up to 500 characters) and click "save". If the comment is successfully added, you will see a confirmation message, but if signs of spam are detected, you will receive an error message.
                </p>
            </div>
        </div>

        <div class="faq">
            <button class="accordion">
                How to edite and delete a comment?
                <i class="fa-solid fa-chevron-down"></i>
            </button>
            <div class="pannel">
                <p>
                    To edit your comment, find it next to the publication, click the edit button, make the necessary changes and press 'save'. If the comment is valid, you will see a confirmation message. To delete your comment, press the "delete" button, confirm the deletion, and if the deletion is successful, you will receive a confirmation message. Note that only the author or administrator of a comment can delete it.
                </p>
            </div>
        </div>

        <div class="faq">
            <button class="accordion">
                How to viewe and edite your profile?
                <i class="fa-solid fa-chevron-down"></i>
            </button>
            <div class="pannel">
                <p>
                    To view or edit your profile, go to your profile page by clicking the "profile" button. Here you will be able to view your username, profile picture, number of followers and all your publications. Press "Edit profile" to make changes. You can change your username and upload a new profile picture (up to 5 MB). After making the changes, save them and if the process is successful, you will see a confirmation message.
                </p>
            </div>
        </div>
    </div>

    <script>
        var acc = document.getElementsByClassName("accordion");
        var i;

        for (i = 0; i < acc.length; i++) {
            acc[i].addEventListener("click", function () {
                this.classList.toggle("active");
                this.parentElement.classList.toggle("active");

                var pannel = this.nextElementSibling;

                if (pannel.style.display === "block") {
                    pannel.style.display = "none";
                } else {
                    pannel.style.display = "block";
                }
            });
        }
    </script>
@endsection
