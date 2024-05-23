<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    // If not logged in, redirect to login page
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Welcome and Upload Excel File</title>
    <style>
        /* CSS for menu bar */
		.menu {
			overflow: hidden;
			position: relative;
		}

		.menu ul {
			list-style-type: none;
			margin: 0;
			padding: 0;
		}

		.menu li {
			float: left;
		}

		.menu li.logo {
			float: left; /* Keep the logo to the left */
		}

		.menu li a {
			display: block;
			color: #333;
			text-align: center;
			padding: 14px 16px;
			text-decoration: none;
		}

		.menu li a:hover {
			background-color: #ddd;
			color: black;
		}

		.menu .right-links {
			float: right; /* Align right */
			margin-left: 10px; /* Add a small margin between links */
		}

        /* CSS for centering login form */
        .login-container {
            text-align: center;
            margin-top: 100px;
        }

        body {
            font-family: Arial, sans-serif;
            margin: 0;
        }

        .gallery {
            width: 700px;
            height: 380px;
            overflow: hidden;
            position: relative;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            background: transparent;
            cursor: pointer;
            margin: auto; /* Center the gallery */
            position: relative;
        }

        .slides {
            display: flex;
            transition: transform 0.5s ease;
        }

        .slide {
            min-width: 100%;
            box-sizing: border-box;
            position: relative;
        }

        .slide img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        .text {
            position: absolute;
            bottom: 10px;
            left: 10px;
            color: white;
            background-color: rgba(0, 0, 0, 0.5);
            padding: 5px;
            border-radius: 3px;
        }

        .nav-button {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background-color: rgba(255, 255, 255, 0.5);
            color: white;
            border: none;
            padding: 10px;
            cursor: pointer;
            z-index: 1;
        }

        .nav-button.left {
            left: 0;
        }

        .nav-button.right {
            right: 0;
        }

        .get-started-button {
			position: absolute;
			bottom: 60px;
			left: 50%;
			transform: translateX(-50%);
			background-color: white;
			color: black;
			border: none;
			padding: 10px 20px;
			cursor: pointer;
			box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
			z-index: 1;
		}

    </style>
</head>
<body>
    <!-- Menu Bar -->
    <div class="menu">
        <ul>
            <li class="logo"><a href="landing_page.php">Logo</a></li>
            <li class="right-links"><a href="logout.php">Logout</a></li>
			<li class="right-links"><a href="user_profile.php">Profile</a></li>
            <li class="right-links"><a href="about.php">About Us</a></li>
            <li class="right-links"><a href="contact_us.php">Contact Us</a></li>
        </ul>
    </div>
    <br>
    <br>
	<br>
    <div id="gallery" class="gallery" onclick="moveSlide(1)">
        <div class="slides">
            <div class="slide">
                <img src="image1.jpg" alt="Image 1">
                <div class="text">Text for Image 1</div>
            </div>
            <div class="slide">
                <img src="image2.jpg" alt="Image 2">
                <div class="text">Text for Image 2</div>
            </div>
            <div class="slide">
                <img src="image3.jpg" alt="Image 3">
                <div class="text">Text for Image 3</div>
            </div>
            <div class="slide">
                <img src="image4.jpg" alt="Image 3">
                <div class="text">Text for Image 3</div>
            </div>
        </div>
        <button class="nav-button left" onclick="moveSlide(-1); event.stopPropagation();">&#10094;</button>
        <button class="nav-button right" onclick="moveSlide(1); event.stopPropagation();">&#10095;</button>
    </div>
		<button class="get-started-button" onclick="window.location.href = 'upload_page.php';">Get Started</button>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const slides = document.querySelector('.slides');
            const slideCount = slides.children.length;
            let index = 0;

            function nextSlide() {
                index = (index + 1) % slideCount;
                slides.style.transform = `translateX(-${index * 100}%)`;
            }

            let interval = setInterval(nextSlide, 3000);

            document.querySelector('.gallery').addEventListener('mouseover', () => {
                clearInterval(interval);
            });

            document.querySelector('.gallery').addEventListener('mouseout', () => {
                interval = setInterval(nextSlide, 3000);
            });

            window.moveSlide = (direction) => {
                index = (index + direction + slideCount) % slideCount;
                slides.style.transform = `translateX(-${index * 100}%)`;
            };
        });
    </script>
</body>
</html>
