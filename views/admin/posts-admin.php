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
        
        .card-footer:last-child {
            text-align: center;
        }

        .breadcrumb {
            display: flex;
            justify-content: space-between;
        }

        button:not(:disabled),
            [type=button]:not(:disabled),
            [type=reset]:not(:disabled),
            [type=submit]:not(:disabled) {
            cursor: pointer;
            margin-right: 15px;
            margin-left: 10px;
        }
        </style>
    </head>
    <body class="sb-nav-fixed">
        <header>
            <div class="container-fluid px-4">
                <?php if (isset($_GET['success'])): ?>
                    <div class="alert alert-success" style="margin-top: 1rem">Les modifications ont été apporté sur l'article!</div>
                <?php endif ?>
                <?php if (isset($_GET['create_success'])): ?>
                    <div class="alert alert-success" style="margin-top: 1rem">L'article a été créé!</div>
                <?php endif ?>
                <?php if (isset($_GET['delete_success'])): ?>
                    <div class="alert alert-success" style="margin-top: 1rem">L'article a été supprimé!</div>
                <?php endif ?>
                <h1 class="mt-4">Administration des articles </h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active">Gérer les articles</li>
                    <a href="/p5-ocr/admin/post/add">
                        <button type="submit" class="btn btn-success" title="Ajouter un article">
                            <svg xmlns="http://www.w3.org/2000/svg" width="100" height="30" fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16">
                                <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                            </svg>
                        </button>
                    </a>
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
                                    <small class="text-muted">Publié le : <?= $post->formatted_date ?>  - Catégorie : <?= $post->category_name ?></small></br></br>
                                    <form action="/p5-ocr/admin/posts/edit/<?= $post->id ?>" method="get" class="d-inline justify-content: center;">
                                        <input type="hidden" name="id" value="<?= $post->id ?>">
                                        <span>
                                            <button type="submit" class="btn btn-outline-warning" title="Modifier l'article">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pen" viewBox="0 0 16 16">
                                                    <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001zm-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708l-1.585-1.585z"/>
                                                </svg>
                                            </button>
                                        </span>
                                    </form>
                                    <form action="/p5-ocr/admin/posts/delete/<?= $post->id ?>" method="post" class="d-inline">
                                        <input type="hidden" name="id" value="<?= $post->id ?>">
                                        <button type="submit" onclick="return confirm('Voulez-vous supprimer définitivement cet article ?')" class="btn btn-outline-danger" title="Supprimer l'article">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6Z"/>
                                                <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1ZM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118ZM2.5 3h11V2h-11v1Z"/>
                                            </svg>
                                        </button>
                                    </form>
                                    <form action="/p5-ocr/admin/posts/status/<?= $post->id ?>" method="post" class="d-inline">
                                        <input type="hidden" name="id" value="<?= $post->id ?>">
                                        <?php if ($post->status): ?>
                                            <button type="submit" class="btn btn-outline-light" title="Désactiver l'article">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                                                    <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/>
                                                    <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z"/>
                                                </svg>
                                            </button>
                                        <?php else : ?>
                                            <button type="submit" class="btn btn-outline-light" title="Activer l'article">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-slash-fill" viewBox="0 0 16 16">
                                                    <path d="m10.79 12.912-1.614-1.615a3.5 3.5 0 0 1-4.474-4.474l-2.06-2.06C.938 6.278 0 8 0 8s3 5.5 8 5.5a7.029 7.029 0 0 0 2.79-.588zM5.21 3.088A7.028 7.028 0 0 1 8 2.5c5 0 8 5.5 8 5.5s-.939 1.721-2.641 3.238l-2.062-2.062a3.5 3.5 0 0 0-4.474-4.474L5.21 3.089z"/>
                                                    <path d="M5.525 7.646a2.5 2.5 0 0 0 2.829 2.829l-2.83-2.829zm4.95.708-2.829-2.83a2.5 2.5 0 0 1 2.829 2.829zm3.171 6-12-12 .708-.708 12 12-.708.708z"/>
                                                </svg>
                                            </button>
                                        <?php endif ?>
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
