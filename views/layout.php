<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Karol Zielinski - Développeur d'application PHP/Symfony</title>
        <link rel="icon" type="image/x-icon" href="/p5-ocr/public/assets/img/kz-logo.JPG" />
        <!-- Font Awesome icons (free version)-->
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic" rel="stylesheet" type="text/css" />
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800" rel="stylesheet" type="text/css" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="<?= SCRIPTS . 'css' . DIRECTORY_SEPARATOR . 'styles.css' ?>" rel="stylesheet" />
        <link href="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" />
    </head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light" id="mainNav">
        <div class="container px-4 px-lg-5">
            <img src="/p5-ocr/public/assets/img/kz-logo.JPG" alt="Logo KZ" width="5%" height="5%">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                Menu
                <i class="fas fa-bars"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ms-auto py-4 py-lg-0">
                    <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="/p5-ocr/">Accueil</a></li>
                    <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="/p5-ocr/posts">Articles</a></li>
                    <?php if (isset($_SESSION['auth'])): ?>
                        <img src="/p5-ocr/public/assets/img/avatar-default.png" class="rounded-circle shadow-4" style="width: 50px; height: 50px; margin-top: 2%; margin-left: 10%" alt="Avatar" />
                        <div class="dropdown" style="margin-top: 1%">
                        <div class="dropdown show">
                            <a class="btn dropdown-toggle .text-white" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color: white">
                                <?= $_SESSION['auth']['firstname'] .' '. $_SESSION['auth']['lastname']  ?>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="/p5-ocr/profil/<?= $_SESSION['auth']['id'] ?>">Mon profil</a>
                                <a class="dropdown-item" href="/p5-ocr/logout">Se déconnecter</a>
                            </div>
                        </div>
                    <?php else: ?>
                        <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="/p5-ocr/signin">Inscription</a></li>
                    <li class="nav-item"><a class="nav-link px-lg-3 py-3 py-lg-4" href="/p5-ocr/login">Connexion</a></li>
                    <?php endif ?>
                </ul>
            </div>
        </div>
    </nav>
    <?= $content ?>
</body>
</html>