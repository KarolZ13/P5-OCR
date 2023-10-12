<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Connexion</title>
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
                        <div class="page-heading">
                            <?php if (isset($_GET['success'])): ?>
                                <div class="alert alert-success">Vous êtes inscrit! Vous pouvez maintenant vous connecter</div>
                            <?php endif ?>
                            <?php if (isset($_GET['error'])): ?>
                                <div class="alert alert-danger">Connexion échouée!</div>
                            <?php endif ?>
                            <h1>Connexion</h1>
                            <span class="subheading">Connectez-vous en remplissant le formulaire.</span>
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
                        <div class="my-5">
                            <form id="contactForm" action="/P5-OCR/login" method="POST">
                                <div class="form-floating">
                                    <input class="form-control" id="email" type="email" name="email" placeholder="Entrer votre adresse mail..." required />
                                    <label for="email">Adresse mail</label>
                                </div>
                                <div class="form-floating">
                                    <input class="form-control" id="password" type="password" name="password" placeholder="Entrer votre mot de passe..." required />
                                    <label for="password">Mot de passe</label>
                                </div>
                                <br />
                                <button class="btn btn-primary" id="submitButton" type="submit">Se connecter</button>
                            </form>
                            <p>Vous n'avez pas de compte ? <a href="/P5-OCR/signin">Cliquez ici</a> pour vous connecter</p>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <!-- Footer-->
        <footer class="border-top" style="background:url(/p5-ocr/public/assets/img/old-black-background-grunge-texture-dark-wallpaper-blackboard-chalkboard-room-wall.jpg) no-repeat center; background-size:cover;">
            <div class="container px-4 px-lg-5">
                <div class="row gx-4 gx-lg-5 justify-content-center">
                    <div class="col-md-10 col-lg-8 col-xl-7">
                        <ul class="list-inline text-center">
                            <li class="list-inline-item">
                                <a href="#!">
                                    <span class="fa-stack fa-lg">
                                        <i class="fas fa-circle fa-stack-2x"></i>
                                        <i class="fab fa-twitter fa-stack-1x fa-inverse"></i>
                                    </span>
                                </a>
                            </li>
                            <li class="list-inline-item">
                                <a href="#!">
                                    <span class="fa-stack fa-lg">
                                        <i class="fas fa-circle fa-stack-2x"></i>
                                        <i class="fab fa-facebook-f fa-stack-1x fa-inverse"></i>
                                    </span>
                                </a>
                            </li>
                            <li class="list-inline-item">
                                <a href="#!">
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
        <script src="/p5-ocr/public/js/scripts.js"></script>
        <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
    </body>
</html>
