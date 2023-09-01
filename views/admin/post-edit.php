<!DOCTYPE html>
<html lang="en">
    <head>
        <title>TITRE</title>
    </head>
    <body style="background: linear-gradient(90deg, rgba(0,0,0,1) 0%, rgba(255,255,255,1) 20%, rgba(255,255,255,1) 80%, rgba(0,0,0,1) 100%);">
        <!-- Page Header-->
        <header class="masthead" style="background:url(/P5-ocr/public/assets/img//old-black-background-grunge-texture-dark-wallpaper-blackboard-chalkboard-room-wall.jpg) no-repeat center; background-size:cover;">
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
                        <div class="post-heading">
                            <h1>Modification de l'article : <?= $params['post']->title ?></h1>
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
        <div class="container position-relative px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5 justify-content-center">
                <div class="col-md-10 col-lg-8 col-xl-7">
                    <form action="/p5-ocr/admin/posts/edit/<?= $params['post']->id ?>" method="post">
                        <div class="form-group" style="margin-bottom: 2rem">
                            <label for="title">Titre de l'article :</label>
                            <input type="text" class="form-control" name="title" id="title" value="<?= $params['post']->title ?>">
                        </div>
                        <div class="form-group" style="margin-bottom: 2rem">
                            <label for="chapo">Chapo :</label>
                            <textarea name="chapo" id="chapo" rows ="5" class="form-control"><?= $params['post']->chapo ?></textarea>
                        </div>
                        <div class="form-group" style="margin-bottom: 2rem">
                            <label for="content">Contenu de l'article :</label>
                            <textarea name="content" id="content" rows ="8" class="form-control"><?= $params['post']->content ?></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
                    </form>
                </div>
            </div>
        </div>
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
        <script src="../public/js/scripts.js"></script>
    </body>
</html>
