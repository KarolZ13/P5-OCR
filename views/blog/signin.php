<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Inscription</title>
    </head>
    <body style="background: linear-gradient(90deg, rgba(0,0,0,1) 0%, rgba(255,255,255,1) 20%, rgba(255,255,255,1) 80%, rgba(0,0,0,1) 100%);">
        <!-- Page Header-->
        <header class="masthead" style="background:url(/P5-OCR/public/assets/img/old-black-background-grunge-texture-dark-wallpaper-blackboard-chalkboard-room-wall.jpg) no-repeat center; background-size:cover;">
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
                            <h1>Inscription</h1>
                            <span class="subheading">Inscrivez-vous en remplissant le formulaire.</span>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- Main Content-->
        <main class="mb-4">
            <div class="container px-4 px-lg-5">
                <?php if (isset($_GET['error'])): ?>
                    <div class="alert alert-danger" style="margin-top: 1rem">L'adresse mail renseignée est déjà utilisée!</div>
                <?php endif ?>
                <div class="row gx-4 gx-lg-5 justify-content-center">
                    <div class="col-md-10 col-lg-8 col-xl-7">
                        <div class="my-5">
                        <form id="contactForm" action="/p5-ocr/signin" method="POST">
                            <div class="form-floating">
                                <input class="form-control" id="lastname" name="lastname" type="text" placeholder="Entrer votre nom..." required />
                                <label for="lastname">Nom</label>
                            </div>
                            <div class="form-floating">
                                <input class="form-control" id="firstname" name="firstname" type="text" placeholder="Entrer votre prénom..." required />
                                <label for="firstname">Prénom</label>
                            </div>
                            <div class="form-floating">
                                <input class="form-control" id="email" name="email" type="email" placeholder="Entrer votre adresse mail..." required />
                                <label for="email">Adresse mail</label>
                            </div>
                            <div class="form-floating">
                                <input class="form-control" id="password" name="password" type="password" placeholder="Entrer votre mot de passe..." required pattern="^(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9\W]).{8,}$" title="Le mot de passe doit faire au minimum 8 caractères avec 1 majuscule, 1 minuscule, et un chiffre ou un caractère spécial." />
                                <label for="password">Mot de passe</label>
                            </div>
                            <br />
                            <button class="btn btn-primary" id="submitButton" type="submit">Se connecter</button>
                        </form>
                            <p>Vous avez déjà un compte ? <a href="/P5-OCR/login">Cliquez ici</a> pour vous connecter</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
        <!-- Footer-->
        <footer class="border-top" style="background:url(/P5-OCR/public/assets/img/old-black-background-grunge-texture-dark-wallpaper-blackboard-chalkboard-room-wall.jpg) no-repeat center; background-size:cover;">
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
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <script src="../public/js/scripts.js"></script>
        <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
    </body>
</html>