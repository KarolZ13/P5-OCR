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

        .col-lg-3 {
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
                <h1 class="mt-4">Administration des utilisateurs</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active">Gérer les utilisateurs</li>
                </ol>
            </div>
        </header>
        <main>
            <div class="container px-5 px-lg-6">
                <div class="card-deck">
                    <?php foreach ($params['users'] as $user): ?>
                        <div class="col-lg-3 col-md-5 col-12 my-3">
                            <div class="card h-100 bg-dark text-light box-glow-1 text-center">
                                <a href="/p5-ocr/admin/user/<?= $user->id ?>">
                                <?php if ($user->avatar !== null): ?>
                                    <img class="card-img-top" src="<?= '/p5-ocr/public/assets/img/' . $user->avatar ?>" alt="Card image cap">
                                <?php else: ?>
                                    <img src="/p5-ocr/public/assets/img/avatar-default.png" style="width: 100%; height: 100%;" alt="Avatar" />
                                <?php endif; ?>
                                </a>
                                <div class="card-body">
                                    <h5 class="card-title"><?= $user->firstname . ' ' . $user->lastname ?></h5>
                                    <p class="card-text"><?= $user->email ?></p>
                                </div>
                                <div class="card-footer">
                                    <p class="card-text">Utilisateur administrateur: <?= $user->is_admin ? 'Oui' : 'Non' ?></p>
                                    <p class="card-text">Utilisateur activé: <?= $user->is_enable ? 'Oui' : 'Non' ?></p>
                                    <form action="/p5-ocr/admin/posts/edit/<?= $user->firstname ?>" method="get" class="d-inline">
                                        <input type="hidden" name="id" value="<?= $user->id ?>">
                                        <button type="submit" class="btn btn-warning">Modifier</button>
                                    </form>
                                    <form action="/p5-ocr/admin/posts/delete/<?= $user->id ?>" method="post" class="d-inline">
                                        <input type="hidden" name="id" value="<?= $user->id ?>">
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
