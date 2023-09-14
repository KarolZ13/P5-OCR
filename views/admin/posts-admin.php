<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Administration des articles</title>
        <style>
        .card-deck {
            display: flex;
            flex-wrap: wrap;
            margin-right: -15px;
            margin-left: -15px;
        }

        .col-lg-4 {
            flex: 0 0 auto;
            width: 25%;
        }

        .card {
            --bs-card-border-width: 4px;
        }

        .col-12 {
            padding-right: 15px;
            padding-left: 15px;
        }
        </style>
    </head>
    <body class="sb-nav-fixed">
        <header>
            <div class="container-fluid px-4">
                <h1 class="mt-4">Administration des articles</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active">Gérer les articles</li>
                </ol>
            </div>
        </header>
        <main>
            <div class="container px-5 px-lg-6">
                <div class="card-deck">
                    <?php foreach ($params['posts'] as $post): ?>
                        <div class="col-lg-4 col-md-6 col-12 my-3">
                            <div class="card h-100 bg-dark text-light box-glow-1">
                                <a href="/p5-ocr/post/<?= $post->id ?>">
                                    <img class="card-img-top" src="<?= '/p5-ocr/public/assets/img/'.$post->picture ?>" alt="Card image cap">
                                </a>
                                <div class="card-body">
                                    <h5 class="card-title"><?= $post->title ?></h5>
                                    <p class="card-text"><?= $post->chapo ?></p>
                                </div>
                                <div class="card-footer">
                                    <small class="text-muted">Publié le : <?= $post->formatted_date ?></small></br></br>
                                    <form action="/p5-ocr/admin/posts/edit/<?= $post->id ?>" method="get" class="d-inline">
                                        <input type="hidden" name="id" value="<?= $post->id ?>">
                                        <button type="submit" class="btn btn-warning">Modifier</button>
                                    </form>
                                    <form action="/p5-ocr/admin/posts/delete/<?= $post->id ?>" method="post" class="d-inline">
                                        <input type="hidden" name="id" value="<?= $post->id ?>">
                                        <button type="submit" class="btn btn-danger">Supprimer</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    <?php endforeach ?>
                </div>
            </div>
        </main>
        <footer class="py-4 bg-light mt-auto">
            <div class="container-fluid px-4">
                <div class="d-flex align-items-center justify-content-between small">
                    <div class="text-muted">Copyright &copy; Karol Zielinski - 2023</div>
                    <div>
                        <a href="#">Privacy Policy</a>
                        &middot;
                        <a href="#">Terms &amp; Conditions</a>
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
