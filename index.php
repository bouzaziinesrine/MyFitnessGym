<?php
session_start();

    include("connection.php");
    include("functions.php");

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $nom_et_prenom = $_POST['nom_et_prenom'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    // Prepare the SQL query to insert data into the database
    $query = "INSERT INTO contacts (nom_et_prenom, email, message) VALUES (?, ?, ?)";

    // Prepare the statement
    $stmt = mysqli_prepare($con, $query);

    // Bind parameters
    mysqli_stmt_bind_param($stmt, 'sss', $nom_et_prenom, $email, $message);

    // Execute the statement
    if (mysqli_stmt_execute($stmt)) {
        // Redirect to the index page with a success parameter
        header("Location: index.php?success=true");
        exit(); // Ensure script execution stops here
    } else {
        // Display error message if query execution fails
        echo "Erreur lors de l'envoi du message : " . mysqli_error($con);
    }


    // Close the statement
    mysqli_stmt_close($stmt);
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome To FITNESS GYM</title>
    <link href="styles.css" type="text/css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"/>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;600;700&display=swap" rel="stylesheet"/>

    <!-- <link href="bootstrap-5.0.2-dist/css/bootstrap.css" rel="stylesheet" /> -->
</head>
<body>
    <div class="main">
        <header class="header">
            <!-- <img src="logoo.png" alt="logo" class="logo"
            style=" width: 150px;
                    height: 120px;
                    margin:5px 50px 0px 50px;"
        > -->
        <h1 class="Fitness" >FITNESS GYM</h1>
            <nav class="navbar">
                    <a href="#" class="active">Accueil</a>
                    <a href="#"  >A propos</a>
                    <a href="#Nos">Services</a>
                <!-- <a href="#bmi">BMI Calculate</a> -->
                <!-- <a href="">Ressources</a> -->
                <!-- <a href="login.php" class="pop" ><span style="color:white;">Inscrivez-vous</span> </a> -->
                <!-- onclick="openPopup()" -->
                
            </nav>
            <a href="#Create" class="btn2">Contactez-nous</a>
            <div id="menu-btn" class="fas fa-bars"></div>
        </header>
        <section class="home" id="back">
            <div class="home-content">
                <h1>BIENVENUE À <span style="color: white;">FITNESS GYM</span></h1>
                <p>Entrez dans notre salle de sport et embarquons pour un voyage pour libérer votre plein potentiel. Bienvenue dans un endroit où la sueur, la détermination et le progrès se rencontrent ! </p>
                <a href="login.php" class="pop" >Inscrivez-vous</a>
                
            </div>
        </section>

        <section class="home2">
            <div class="para">
                <p class="titre">UN OBJECTIF A ATTEINDRE?</p>
                <p class="desc">Quel que soit votre parcours, votre objectif d’entraînement ou votre niveau de pratique,
                    vous trouverez des activités qui vous aideront à atteindre votre but.
                </p>
            </div>
            <div class="slidercontainer">
                <div class="slider">
                    <div class="swiper-slide">
                        <img class="slide" src="musculation.jpg" alt="Slide 1">
                        <div class="slide-content">
                            <h1 class="slide-title">Musculation</h1>
                            <div class="slide-paragraph">
                            Strength training, or musculation, involves exercises like weightlifting that build muscle strength and tone. It's key for overall fitness, improving metabolism and bone density while reducing the risk of injury. Incorporating musculation into your routine enhances physical performance and supports long-term health.
                            </div>
                            <button class="btn-more" onclick="redirectToDetailsPage('musculation.html')">En savoir plus</button>
                        </div>
                    </div>

                    <div class="swiper-slide">
                        <img class="slide" src="cardio.jpg" alt="Slide 2">
                        <div class="slide-content">
                            <h1 class="slide-title">Cardio</h1>
                            <div class="slide-paragraph">
                                Cardio, short for cardiovascular exercise, is a vital component of fitness routines. It includes activities like running, cycling, and swimming, aimed at elevating heart rate and improving endurance. Regular cardio workouts enhance heart health, boost metabolism, and aid weight management. 
                            </div>
                            <button class="btn-more" onclick="redirectToDetailsPage('cardio.html')">En savoir plus</button>
                        </div>
                    </div>

                    <div class="swiper-slide">
                        <img class="slide" src="yoga.jpg" alt="Slide 3">
                        <div class="slide-content">
                            <h1 class="slide-title">Yoga</h1>
                            <div class="slide-paragraph">
                            Yoga is an ancient practice originating from India, blending physical postures, breathing exercises, and meditation to promote well-being. It enhances flexibility, strength, and mental clarity while reducing stress and fostering inner peace.
                            </div>
                            <button class="btn-more" onclick="redirectToDetailsPage('yoga.html')">En savoir plus</button>
                        </div>
                    </div>
                </div>
                <button class="prev" onclick="changeSlide(-1)" id="kkk">&#10094;</button>
                <button class="next" onclick="changeSlide(1)" id="kkk">&#10095;</button>
            </div>
        </section>


        <section id="Nos" class="home5">
            <div>
                <p class="titre">Nos Services</p>
                <p class="desc">Quel que soit votre parcours, votre objectif d’entraînement ou votre niveau de pratique,
                    vous trouverez des activités qui vous aideront à atteindre votre but.
                </p>
            </div>
            <div class="services-section">
                <div class="service-column">
                    <!-- Contenu de la première colonne -->
                    <h3>Équipements de fitness</h3>
                    <p> Des machines cardio aux poids libres, chaque outil est soigneusement sélectionné pour soutenir votre parcours vers la force, l'endurance et le bien-être global. Entrez, relevez le défi et sculptons ensemble un vous plus sain et plus fort !</p>
                    <button class="btn-service">En savoir plus</button>
                </div>
                <div class="service-column">
                    <!-- Contenu de la deuxième colonne -->
                    <h3>Cours collectifs</h3>
                    <p>Des sessions de cardio énergisantes aux séances de renforcement musculaire, chaque cours est animé par des instructeurs passionnés qui vous guideront à chaque mouvement. Rejoignez-nous et laissez-vous emporter par l'énergie collective vers des résultats époustouflants!</p>
                    <button class="btn-service">En savoir plus</button>
                </div>
                <div class="service-column">
                    <!-- Contenu de la troisième colonne -->
                    <h3>Coaching personnalisé</h3>
                    <p>FITNESS GYM LA FABRIQUE FITNESS met à votre disposition des coachs sportifs sélectionnés afin de vous accompagner pendant vos séances ou grâce à des suivis personnalisés.</p>
                    <button class="btn-service" onclick="openPopup()">En savoir plus</button>
                </div>
            </div>
        </section>

        <section class="home3" id="bmi">
        <div class="title">
            <h1 >CALCULEZ VOTRE BMI</h1>
            <p>Calculez votre indice de masse corporel (BMI) et découvrez votre poids idéal !.</p>
        </div>
            <div class="bmi">
                <h2>BMI Calculator</h2>
                <div class="input-group">
                    <label for="height">Height (cm):</label>
                    <input type="number" id="height" placeholder="Enter height in cm">
                </div>
                <div class="input-group">
                    <label for="weight">Weight (kg):</label>
                    <input type="number" id="weight" placeholder="Enter weight in kg">
                </div>
                <button class="btn" onclick="calculateBMI()">Calculate BMI</button>
                <div id="result"></div>
            </div>
        
        </section>
        <section class="home4">
            <div class="title">
                <h1>À LA UNE</h1>
                <p>Découvrez les derniers articles sur notre blog</p>
            </div>
            <div class="wrapper">
                <i id="left" class="fa-solid fa-angle-left"></i>
                <div class="carousel">
                    <img src="boutique.png" alt="img" draggable="false">
                    <img src="sauna.png" alt="img" draggable="false">
                    <img src="nutrition.png" alt="img" draggable="false">
                    <img src="smallgrp.png" alt="img" draggable="false">
                    <img src="cardioo.png" alt="img" draggable="false">
                    <img src="mus.png" alt="img" draggable="false">
                </div>
                <i id="right" class="fa-solid fa-angle-right"></i>
            </div>
        </section>
        <div class="container" id="Create">
            <div class="form-wrapper">
                <form class="signup-form" method="post" action="index.php">
                    <h1 >Contactez-nous</h1>
                    <div class="social-media">
                        <i class="fab fa-facebook-f"></i>
                        <i class="fab fa-instagram"></i>
                        <i class="fab fa-linkedin-in"></i>
                    </div>
                        <div class="input-group">
                            <i class="fas fa-user"></i>
                            <input type="text" name="nom_et_prenom" placeholder="Nom Et Prenom" />
                        </div>
                        <div class="input-group">
                            <i class="fas fa-envelope"></i>
                            <input type="email" name="email" placeholder="Email" />
                        </div>
                            <div class="input-group ">
                            <i class="fas fa-comment "></i>
                            <input type="text" name="message" class="message" placeholder="Message" />
                        </div>
                    <button type="submit">Envoyer</button>
                </form>
            </div>
        </div>
        <footer>
            <div class="footerContainer">
                <div class="socialIcons">
                    <a href="#"><i class="fab fa-facebook"></i><span style="font-size: 0px;">F</span></a>
                    <a href="#"><i class="fab fa-instagram"></i><span style="font-size: 0px;">F</span></a>
                    <a href="#"><i class="fab fa-twitter"></i><span style="font-size: 0px;">F</span></a>
                    <a href="#"><i class="fab fa-google-plus"></i><span style="font-size: 0px;">F</span></a>
                    <a href="#"><i class="fab fa-youtube"></i><span style="font-size: 0px;">F</span></a>
                </div>
                <div class="footerNav">
                    <ul><li><a href="">Home</a></li>
                        <li><a href="">About us</a></li>
                        <li><a href="">BMI Calculate</a></li>
                        <li><a href="">Contact Us</a></li>
                    </ul>
                </div>
                <footer class="footer-info">
                    <div class="contact-info">
                        <h3>CONTACTEZ NOUS</h3>
                        <p>Rue El Hsinet Montplaisir Tunis</p>
                        <p>Tél : 71 905 378</p>
                        <p>Mobile : 92 788 034</p>
                        <p>07 Rue Ibn El Jazzar, Lafayette - Tunis</p>
                        <p>92 788 031</p>
                    </div>
                    <div class="horaires-info">
                        <h3>HORAIRES </h3>
                        <p>Lundi 06:30 – 21:30</p>
                        <p>Mardi 06:30 – 21:30</p>
                        <p>Mercredi 06:30 – 21:30</p>
                        <p>Jeudi 06:30 – 21:30</p>
                        <p>Vendredi 06:30 – 21:30</p>
                        <p>Samedi 08:00 – 16:00</p>
                        <p>Dimanche 08:00 – 16:00</p>
                    </div>
                </footer>
            <div class="footerBottom">
                <p>Copyright &copy;2024;  <span class="designer"> Nesrine Bouzazi</span></p>
            </div>
        </footer>
    </div>
    <script src="script.js"></script>
</body>
</html>