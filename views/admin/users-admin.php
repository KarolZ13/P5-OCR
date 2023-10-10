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

        .no_avatar {
            margin-bottom: -35%;
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
                                <?php if ($user->avatar !== null): ?>
                                    <a href="/p5-ocr/admin/user/<?= $user->id ?>">
                                        <img class="card-img-top" style="width: 100%; height: 100%;" src="<?= '/p5-ocr/public/assets/img/' . $user->avatar ?>" alt="Card image cap">
                                    </a>
                                <?php else: ?>
                                    <a class="no_avatar" href="/p5-ocr/admin/user/<?= $user->id ?>">
                                        <img style="width: 100%; height:67%" src="/p5-ocr/public/assets/img/avatar-default.png" alt="Avatar" />
                                    </a>
                                <?php endif; ?>
                                <div class="card-body">
                                    <h5 class="card-title"><?= $user->firstname . ' ' . $user->lastname ?></h5>
                                    <p class="card-text"><?= $user->email ?></p>
                                </div>
                                <div class="card-footer">
                                    <div class="users-status" style="justify-content: space-around;flex: inherit;display: flex; margin-bottom: 10px;">
                                        <?php if ($user->is_admin) : ?>
                                            <div title="Administrateur">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-person-fill-gear" viewBox="0 0 16 16">
                                                    <path d="M11 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm-9 8c0 1 1 1 1 1h5.256A4.493 4.493 0 0 1 8 12.5a4.49 4.49 0 0 1 1.544-3.393C9.077 9.038 8.564 9 8 9c-5 0-6 3-6 4Zm9.886-3.54c.18-.613 1.048-.613 1.229 0l.043.148a.64.64 0 0 0 .921.382l.136-.074c.561-.306 1.175.308.87.869l-.075.136a.64.64 0 0 0 .382.92l.149.045c.612.18.612 1.048 0 1.229l-.15.043a.64.64 0 0 0-.38.921l-.074-.136c-.305.561-.309 1.175-.87.87l-.136-.075a.64.64 0 0 0-.92.382l-.045.149c-.18.612-1.048.612-1.229 0l-.043-.15a.64.64 0 0 0-.921-.38l-.136.074c-.561.305-1.175-.309-.87-.87l.075-.136a.64.64 0 0 0-.382-.92l-.148-.045c-.613-.18-.613-1.048 0-1.229l.148-.043a.64.64 0 0 0 .382-.921l-.074-.136c-.306-.561.308-1.175.869-.87l.136.075a.64.64 0 0 0 .92-.382l.045-.148ZM14 12.5a1.5 1.5 0 1 0-3 0 1.5 1.5 0 0 0 3 0Z"/>
                                                </svg>
                                            </div>
                                        <?php else : ?>
                                            <div title="Utilisateur">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
                                                    <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3Zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z"/>
                                                </svg>
                                            </div>
                                        <?php endif; ?>
                                        <?php if ($user->is_enable) : ?>
                                            <div title="Utilisateur activé">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-person-fill-check" style="color:green" viewBox="0 0 16 16">
                                                <path d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7Zm1.679-4.493-1.335 2.226a.75.75 0 0 1-1.174.144l-.774-.773a.5.5 0 0 1 .708-.708l.547.548 1.17-1.951a.5.5 0 1 1 .858.514ZM11 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"/>
                                                <path d="M2 13c0 1 1 1 1 1h5.256A4.493 4.493 0 0 1 8 12.5a4.49 4.49 0 0 1 1.544-3.393C9.077 9.038 8.564 9 8 9c-5 0-6 3-6 4Z"/>
                                            </svg>
                                            </div>
                                        <?php else : ?>
                                            <div title="Utilisateur désactivé">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-person-fill-x" style="color:red" viewBox="0 0 16 16">
                                                    <path d="M11 5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm-9 8c0 1 1 1 1 1h5.256A4.493 4.493 0 0 1 8 12.5a4.49 4.49 0 0 1 1.544-3.393C9.077 9.038 8.564 9 8 9c-5 0-6 3-6 4Z"/>
                                                    <path d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7Zm-.646-4.854.646.647.646-.647a.5.5 0 0 1 .708.708l-.647.646.647.646a.5.5 0 0 1-.708.708l-.646-.647-.646.647a.5.5 0 0 1-.708-.708l.647-.646-.647-.646a.5.5 0 0 1 .708-.708Z"/>
                                                </svg>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <div style="justify-content: space-around;flex: inherit;display: flex;">
                                        <form action="/p5-ocr/admin/user/edit/<?= $user->id ?>" method="get" class="d-inline">
                                            <input type="hidden" name="id" value="<?= $user->id ?>">
                                            <span>
                                                <button type="submit" class="btn btn-outline-warning" title="Modifier le profil">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pen" viewBox="0 0 16 16">
                                                        <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001zm-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708l-1.585-1.585z"/>
                                                    </svg>
                                                </button>
                                            </span>
                                        </form>
                                        <?php if (!$user->is_admin) : ?>
                                        <form action="/p5-ocr/admin/user/admin/<?= $user->id ?>" method="post" class="d-inline">
                                            <button type="submit" class="btn btn-outline-light" title="Passer l'utilisateur en administrateur" style="--bs-btn-color: green;--bs-btn-border-color: green;--bs-btn-hover-color: #000;--bs-btn-hover-bg: green;--bs-btn-hover-border-color: green;--bs-btn-focus-shadow-rgb: 255, 193, 7;--bs-btn-active-color: #000;--bs-btn-active-bg: green;--bs-btn-active-border-color: green;--bs-btn-active-shadow: inset 0 3px 5px rgba(0, 0, 0, 0.125);--bs-btn-disabled-color: green;--bs-btn-disabled-bg: transparent;--bs-btn-disabled-border-color: green;--bs-gradient: none;">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-up-circle" viewBox="0 0 16 16" >
                                                    <path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8zm15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-7.5 3.5a.5.5 0 0 1-1 0V5.707L5.354 7.854a.5.5 0 1 1-.708-.708l3-3a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 5.707V11.5z"/>
                                                </svg>
                                            </button>
                                        </form>
                                        <?php endif ?>
                                        <form action="/p5-ocr/admin/user/status/<?= $user->id ?>" method="post" class="d-inline">
                                            <input type="hidden" name="id" value="<?= $user->id ?>">
                                            <?php if ($user->is_enable): ?>
                                                <button type="submit" onclick="return confirm('Voulez-vous vraiment désactiver cet utilisateur ?')" class="btn btn-outline-light" title="Désactiver l'utilisateur">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                                                        <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/>
                                                        <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z"/>
                                                    </svg>
                                                </button>
                                            <?php else : ?>
                                                <button type="submit" class="btn btn-outline-light" title="Activer l'utilisateur">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-slash-fill" viewBox="0 0 16 16">
                                                        <path d="m10.79 12.912-1.614-1.615a3.5 3.5 0 0 1-4.474-4.474l-2.06-2.06C.938 6.278 0 8 0 8s3 5.5 8 5.5a7.029 7.029 0 0 0 2.79-.588zM5.21 3.088A7.028 7.028 0 0 1 8 2.5c5 0 8 5.5 8 5.5s-.939 1.721-2.641 3.238l-2.062-2.062a3.5 3.5 0 0 0-4.474-4.474L5.21 3.089z"/>
                                                        <path d="M5.525 7.646a2.5 2.5 0 0 0 2.829 2.829l-2.83-2.829zm4.95.708-2.829-2.83a2.5 2.5 0 0 1 2.829 2.829zm3.171 6-12-12 .708-.708 12 12-.708.708z"/>
                                                    </svg>
                                                </button>
                                            <?php endif ?>
                                        </form>
                                        <?php if (!$user->is_admin) : ?>
                                            <form action="/p5-ocr/admin/user/delete/<?= $user->id ?>" method="post" class="d-inline">
                                                <input type="hidden" name="id" value="<?= $user->id ?>">
                                                <button type="submit" onclick="return confirm('Voulez-vous supprimer définitivement cet utilisateur ?')" class="btn btn-outline-danger" title="Supprimer le commentaire">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                        <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6Z"/>
                                                        <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1ZM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118ZM2.5 3h11V2h-11v1Z"/>
                                                    </svg>
                                                </button>
                                            </form>
                                        <?php else : ?>
                                        <?php endif ?>
                                    </div>
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
