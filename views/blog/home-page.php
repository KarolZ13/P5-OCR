<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Karol Zielinski - Développeur d'application PHP/Symfony</title>
        <style>
        .btn-primary {
            --bs-btn-bg: #5155599e;
            --bs-btn-border-color: #515559;
            --bs-btn-hover-bg: #515559;
            --bs-btn-hover-border-color: #ffffff;
            --bs-btn-active-bg: none;
            --bs-btn-active-border-color: #ffffff;
        }
        </style>
    </head>
    <body style="background: linear-gradient(90deg, rgba(0,0,0,1) 0%, rgba(255,255,255,1) 20%, rgba(255,255,255,1) 80%, rgba(0,0,0,1) 100%);">

        <!-- Page Header-->
        <header class="masthead" style="background:url(/p5-ocr/public/assets/img/old-black-background-grunge-texture-dark-wallpaper-blackboard-chalkboard-room-wall.jpg) no-repeat center; background-size:cover;">
            <div class="box">
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
                <div></div>
            </div>
            <div class="container position-relative px-4 px-lg-5">
                <div class="row gx-4 gx-lg-5 justify-content-center">
                    <div class="col-md-10 col-lg-8 col-xl-7">
                        <div class="site-heading">
                            <?php if (isset($_GET['success'])): ?>
                                <div class="alert alert-success">Vous êtes connecté!</div>
                            <?php endif ?>
                            <?php if (isset($_GET['contact_success']) && $_GET['contact_success'] === 'true'): ?>
                                <div class="alert alert-success">Message envoyé avec succès!</div>
                            <?php endif ?>
                            <h1>Karol Zielinski</h1>
                            <span class="subheading">Développeur d'application PHP/Symfony</span>
                            <div class="box">
                                <div></div>
                                <div></div>
                                <div></div>
                                <div></div>
                                <div></div>
                                <div></div>
                                <div></div>
                                <div></div>
                                <div></div>
                                <div></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- Main Content-->
        <main class="mb-4">
            <div class="container px-4 px-lg-5">
                <div class="row gx-4 gx-lg-5 justify-content-center">
                    <div class="col-md-10 col-lg-8 col-xl-7">
                        <p>Vous voulez me contacter? Remplissez le formulaire ci-dessous et je vous répondrais le plus rapidement possible!</p>
                        <div class="my-5">
                            <form id="contactForm" action="/P5-OCR/src/controllers/mail.php" method="post">
                                <div class="form-floating">
                                        <input class="form-control" id="name" type="text" name="name" placeholder="Entrer votre nom..." required />
                                        <label for="name">Nom et prénom</label>
                                    </div>
                                    <div class="form-floating">
                                        <input class="form-control" id="email" type="email" name="email" placeholder="Entrer votre adresse mail..." required />
                                        <label for="email">Adresse mail</label>
                                    </div>
                                    <div class="form-floating">
                                        <textarea class="form-control" id="message" name="message" placeholder="Enter your message here..." style="height: 12rem" required></textarea>
                                        <label for="message">Votre message</label>
                                    </div>
                                    <br />
                                    <button class="btn btn-primary" id="submitButton" type="submit">Envoyer</button>
                                </div>
                            </form>    
                            <p>Vous pouvez télécharger mon CV en cliquant <a href="/p5-ocr/public/assets/img/CV-Karol-ZIELINSKI.pdf" target="_blank">ici.</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <!-- Footer-->
        <footer class="border-top" style="background:url(/p5-ocr/public/assets/img/old-black-background-grunge-texture-dark-wallpaper-blackboard-chalkboard-room-wall.jpg) no-repeat center; background-size:cover;">
            <div class="container px-4 px-lg-5">
                <div class="row gx-4 gx-lg-5 justify-content-center">
                    <div class="col-md-10 col-lg-8 col-xl-7 text-center">
                        <?php if (isset($_SESSION['auth']) && $_SESSION['auth']['is_admin']): ?>
                            <div class="margin" style="margin-bottom: 5%;">
                                <a href="/P5-OCR/admin">
                                    <button type="submit" class="btn btn-primary">Administration du site</button>
                                </a>
                            </div>
                        <?php endif; ?>
                        <ul class="list-inline text-center">
                            <li class="list-inline-item">
                                <a href="https://www.linkedin.com/in/karol-zielinski-78a044149/" target="_blank">
                                    <span class="fa-stack fa-lg">
                                        <i class="fas fa-circle fa-stack-2x"></i>
                                        <i class="fa-brands fa-linkedin fa-stack-1x fa-inverse"></i>
                                    </span>
                                </a>
                            </li>
                            <li class="list-inline-item">
                                <a href="https://www.facebook.com/karol.zielinski.90/" target="_blank">
                                    <span class="fa-stack fa-lg">
                                        <i class="fas fa-circle fa-stack-2x"></i>
                                        <i class="fab fa-facebook-f fa-stack-1x fa-inverse"></i>
                                    </span>
                                </a>
                            </li>
                            <li class="list-inline-item">
                                <a href="https://github.com/KarolZ13" target="_blank">
                                    <span class="fa-stack fa-lg">
                                        <i class="fas fa-circle fa-stack-2x"></i>
                                        <i class="fab fa-github fa-stack-1x fa-inverse"></i>
                                    </span>
                                </a>
                            </li>
                        </ul>
                        <div class="small text-center text-muted fst-italic">Copyright &copy; Karol Zielinski - 2023</div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="/blog-php/public/js/scripts.js"></script>
    </body>
</html>