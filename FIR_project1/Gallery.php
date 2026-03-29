<?php
session_start();
include "DBconfig.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Photo Gallery | Gujarat Police</title>
    <link rel="icon" href="img\weblogo1.ico" type="image/icon">
    <link rel="stylesheet" href="modern_efir.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        .gallery-container {
            max-width: 1000px;
            margin: 60px auto;
            padding: 20px;
            position: relative;
        }
        .slider-wrapper {
            background: var(--glass-bg);
            backdrop-filter: var(--glass-blur);
            border: 1px solid var(--glass-border);
            border-radius: 24px;
            padding: 20px;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
            overflow: hidden;
            position: relative;
            height: 500px;
        }
        .mySlides {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 15px;
            display: none;
            animation: fadeIn 0.8s ease-in-out;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: scale(1.05); }
            to { opacity: 1; transform: scale(1); }
        }
        .nav-btn {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background: rgba(255, 255, 255, 0.1);
            color: white;
            border: 1px solid rgba(255, 255, 255, 0.2);
            width: 50px;
            height: 50px;
            border-radius: 50%;
            cursor: pointer;
            z-index: 10;
            display: flex;
            align-items: center;
            justify-content: center;
            backdrop-filter: blur(5px);
            transition: all 0.3s ease;
        }
        .nav-btn:hover {
            background: var(--accent-blue);
            border-color: var(--accent-blue);
            transform: translateY(-50%) scale(1.1);
        }
        .btn-left { left: 40px; }
        .btn-right { right: 40px; }
        
        .gallery-grid {
            margin-top: 40px;
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
            gap: 15px;
        }
        .thumb {
            aspect-ratio: 16/9;
            border-radius: 12px;
            cursor: pointer;
            border: 2px solid transparent;
            transition: all 0.3s ease;
            opacity: 0.6;
            object-fit: cover;
            width: 100%;
        }
        .thumb.active, .thumb:hover {
            opacity: 1;
            border-color: var(--accent-blue);
        }
    </style>
</head>
<body>

    <?php include "common/_navbar.php"; ?>

    <div class="gallery-container">
        <div class="page-header">
            <h1>Police Academy & Events</h1>
            <p>Visual Highlights of Training and Departmental Milestones</p>
        </div>

        <div class="slider-wrapper">
            <img class="mySlides" src="img/71507996.png">
            <img class="mySlides" src="img/AKADEMI.jpg">
            <img class="mySlides" src="img/AKADEMI2.jpg">
            <img class="mySlides" src="img/AKADEMI3.jpg">
            <img class="mySlides" src="img/AKADEMI4.jpg">
            <img class="mySlides" src="img/AKADEMI5.jpg">
            
            <button class="nav-btn btn-left" onclick="plusDivs(-1)"><i class="fas fa-chevron-left"></i></button>
            <button class="nav-btn btn-right" onclick="plusDivs(1)"><i class="fas fa-chevron-right"></i></button>
        </div>

        <div class="gallery-grid">
            <img class="thumb" src="img/71507996.png" onclick="currentSlide(1)">
            <img class="thumb" src="img/AKADEMI.jpg" onclick="currentSlide(2)">
            <img class="thumb" src="img/AKADEMI2.jpg" onclick="currentSlide(3)">
            <img class="thumb" src="img/AKADEMI3.jpg" onclick="currentSlide(4)">
            <img class="thumb" src="img/AKADEMI4.jpg" onclick="currentSlide(5)">
            <img class="thumb" src="img/AKADEMI5.jpg" onclick="currentSlide(6)">
        </div>
    </div>

    <script>
        var slideIndex = 1;
        showDivs(slideIndex);

        function plusDivs(n) {
            showDivs(slideIndex += n);
        }

        function currentSlide(n) {
            showDivs(slideIndex = n);
        }

        function showDivs(n) {
            var i;
            var x = document.getElementsByClassName("mySlides");
            var dots = document.getElementsByClassName("thumb");
            if (n > x.length) {slideIndex = 1}
            if (n < 1) {slideIndex = x.length}
            for (i = 0; i < x.length; i++) {
                x[i].style.display = "none";
                dots[i].classList.remove("active");
            }
            x[slideIndex-1].style.display = "block";
            dots[slideIndex-1].classList.add("active");
        }

        // Auto play
        setInterval(function() {
            plusDivs(1);
        }, 5000);
    </script>

    <?php include "common/_footer.php"; ?>
</body>
</html>