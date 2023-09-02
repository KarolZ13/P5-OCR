<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Administration des commentaires</title>
    </head>
    <body style="background: linear-gradient(90deg, rgba(1,64,170,1) 0%, rgba(255,255,255,1) 20%, rgba(255,255,255,1) 80%, rgba(1,64,170,1) 100%);">
        <!-- Page Header-->
        <header class="masthead" style="background:url(/p5-ocr/public/assets/img/abstract-textured-backgound.jpg) no-repeat center; background-size:cover;">
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
                            <h1>Administration des commentaires</h1>
                            <span class="subheading">Liste de tous les commentaire.</span>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- Main Content-->
        <main>
            <div class="container px-4 px-lg-5">
                <div class="card-deck">
                    <?php foreach ($params['posts'] as $post): ?>
                        <h1>Commentaires sur l'article : <?= $post->title ?></h1>
                        <table class="table">
                            <thead>
                                <tr>
                                <th scope="col"><?= $post->id ?></th>
                                <th scope="col"><?= $post->title ?></th>
                                <th scope="col"><?= $post->chapo ?></th>
                                <th scope="col"><?= $post->lastname . ' ' . $post->firstname ?></th>
                                </tr>
                            </thead>
                            <?php foreach ($params['comments'] as $comment): ?>     
                            <tbody>
                                <tr>
                                <th scope="row"><?= $comment->id ?></th>
                                <td><?= $comment->comment_author_firstname . ' ' . $comment->comment_author_lastname ?></td>
                                <td><?= $comment->comment ?></td>
                                <td><?= $comment->is_valid ?></td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    <?php endforeach ?>
                </div>
            </div>
        </main>
        <!-- Footer-->
        <footer class="border-top" style="background:url(/p5-ocr/public/assets/img/abstract-textured-backgound.jpg) no-repeat center; background-size:cover;">
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
        <script src="/P5-OCR/public/js/scripts.js"></script>
    </body>
</html>
