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
                                    <img class="card-img-top" style="width: 100%; height: 100%;" src="<?= '/p5-ocr/public/assets/img/' . $user->avatar ?>" alt="Card image cap">
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
                                        <span>
                                            <button type="submit" class="btn btn-outline-warning" title="Modifier l'article">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pen" viewBox="0 0 16 16">
                                                    <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001zm-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708l-1.585-1.585z"/>
                                                </svg>
                                            </button>
                                        </span>
                                    </form>
                                    <form action="/p5-ocr/admin/posts/delete/<?= $user->id ?>" method="post" class="d-inline">
                                        <input type="hidden" name="id" value="<?= $user->id ?>">
                                        <button type="submit" onclick="return confirm('Voulez-vous supprimer définitivement cet article ?')" class="btn btn-outline-danger" title="Supprimer l'article">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6Z"/>
                                                <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1ZM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118ZM2.5 3h11V2h-11v1Z"/>
                                            </svg>
                                        </button>
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
