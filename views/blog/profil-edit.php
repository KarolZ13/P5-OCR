<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Editer l'article : <?= $params['post']->title ?></title>
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
                    <div class="col-md-15 col-lg-15 col-xl-15">
                        <div class="site-heading">
                            <h2>Editer les informations du profil de <?= $params['user']->firstname . ' ' . $params['user']->lastname ?></h2>
                            <span class="subheading">La liste des articles ajoutés.</span>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <main>
            <div class="container position-relative px-4 px-lg-5">
                <?php if (isset($_GET['success'])): ?>
                    <div class="alert alert-success">Les modifications ont été pris en compte.</div>
                <?php endif ?>
                <div class="row gx-4 gx-lg-5 justify-content-center">
                    <div class="col-md-10 col-lg-8 col-xl-7">
                        <form action="/p5-ocr/profil/<?= $params['user']->id ?>" method="POST" enctype="multipart/form-data">
                            <div class="form-group" style="margin-bottom: 2rem">
                                <label for="firstname">Prénom :</label>
                                <input type="text" class="form-control" name="firstname" id="firstname" value="<?= $params['user']->firstname ?>">
                            </div>
                            <div class="form-group" style="margin-bottom: 2rem">
                                <label for="lastname">Nom :</label>
                                <input type="text" class="form-control" name="lastname" id="lastname" value="<?= $params['user']->lastname ?>">
                            </div>
                            <div class="form-group" style="margin-bottom: 2rem">
                                <label for="email">Adresse mail :</label>
                                <input type="text" class="form-control" name="email" id="email" value="<?= $params['user']->email ?>">
                            </div>
                            <div class="form-group" style="margin-bottom: 2rem">
                                <label for="password">Mot de passe :</label>
                                <input type="password" class="form-control" name="password" id="password" value="">
                            </div>
                            <div class="form-group" style="margin-bottom: 2rem">
                            <?php if ($params['user']->avatar !== null): ?>
                                    <img class="card-img-top" style="width: 100%; height: 100%;" src="<?= '/p5-ocr/public/assets/img/' . $params['user']->avatar ?>" alt="Card image cap">
                                <?php else: ?>
                                    <img style="width: 276px; height:180px" src="/p5-ocr/public/assets/img/avatar-default.png" style="width: 100%; height: 100%;" alt="Avatar" />
                                <?php endif; ?>
                            </div>
                            <div class="form-group" style="margin-bottom: 2rem">
                                <label for="avatar">Ajouter un avatar :</label>
                                <input type="file" name="avatar" id="avatar">
                            </div>
                            <button type="submit" class="btn btn-primary" style="margin-top: 2rem; margin-bottom: 30px;">Enregistrer les modifications</button>
                        </form>
                    </div>
                </div>
            </div>
        </main>
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
        <script src="/blog-php/public/js/scripts.js"></script>
    </body>
</html>
