<!DOCTYPE html>
<html lang="en">
    <head>
        <title>titre</title>
        <style>
            header.masthead .post-heading .meta {
                display: flex;
                justify-content: end;
            }

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
        <header class="masthead" style="background:url(../public/assets/img//old-black-background-grunge-texture-dark-wallpaper-blackboard-chalkboard-room-wall.jpg) no-repeat center; background-size:cover;">
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
                    <div class="col-md-10 col-lg-8 col-xl-10">
                        <div class="post-heading">
                            <h1><?= $params['post']->title ?></h1>
                            <h2 class="subheading"><?= $params['post']->chapo ?></h2>
                            <span class="meta">
                                Auteur de l'article :  <?= $params['post']->lastname . ' ' . $params['post']->firstname ?> </br>
                                Dernière mise à jour : <?php if (empty($params['post']->formatted_updated_at)) 
                                {
                                    echo $params['post']->formatted_created_at;
                                } else {
                                    echo $params['post']->formatted_updated_at;
                                }?> 
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- Post Content-->
        <article class="mb-4">
            <div class="container px-4 px-lg-5">
                <div class="row gx-4 gx-lg-5 justify-content-center">
                    <div class="col-md-10 col-lg-8 col-xl-7">
                        <?php if (isset($_GET['success'])): ?>
                        <div class="alert alert-success" style="margin-top: 1rem">Le commentaire est en attente d'approbation par l'administrateur</div>
                        <?php endif ?>
                        <p>
                        <?= $params['post']->content ?>
                        </p>
                    </div>
                </div>
            </div>
            <div class="mb-4">
                <div class="container px-4 px-lg-5">
                    <div class="row gx-4 gx-lg-5 justify-content-center">
                        <div class="col-md-10 col-lg-8 col-xl-7">
                            <div class="my-5">
                                <form id="contactForm" action="/p5-ocr/post/<?= $params['post']->id ?>" method="POST">
                                <?php if (isset($_SESSION['auth'])): ?>
                                    <div class="form-floating">
                                        <textarea class="form-control" id="comment" name="comment" type="text" placeholder="Ajouter votre commentaire..." style="height: 12rem" required></textarea>
                                        <label for="comment">Ajouter un commentaire...</label>
                                    </div>
                                    <br />
                                    <button class="btn btn-primary" id="submitButton" type="submit">Envoyer</button>
                                </form>
                                <?php else: ?>
                                    <strong><i>Vous devez être <a href="/P5-OCR/login" style="color: blue;"> connecté </a>pour ajouter un commentaire!</i></strong>
                                <?php endif ?>
                                <div class="mt-5">
                                    <h3>Commentaires</h3>
                                    <?php if (empty($params['comments'])): ?>
                                        <p>Aucun commentaire ajouté</p>
                                    <?php else: ?>
                                        <?php foreach ($params['comments'] as $comment): ?>
                                            <?php if ($comment->is_valid == 1): ?>
                                                <p>Auteur: <strong><?= $comment->comment_author_firstname . ' ' . $comment->comment_author_lastname ?></strong> le <?= $comment->formatted_created_at ?></br>
                                                Commentaire:</br><?= $comment->comment ?></p></br>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </article>
        <!-- Footer-->
        <footer class="border-top" style="background:url(../public/assets/img/old-black-background-grunge-texture-dark-wallpaper-blackboard-chalkboard-room-wall.jpg) no-repeat center; background-size:cover;">
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
        <script src="../public/js/scripts.js"></script>
    </body>
</html>
