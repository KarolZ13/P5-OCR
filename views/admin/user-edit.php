<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Editer le profil de l'utilisateur : <?= $params['user']->firstname . ' ' . $params['user']->lastname ?></title>
    </head>
    <body class="sb-nav-fixed">
        <header>
            <div class="container-fluid px-4; justify-content-center">
                <?php if (isset($_GET['success'])): ?>
                    <div class="alert alert-success" style="margin-top: 1rem">Les modifications ont été apporté sur l'article!</div>
                <?php endif ?>
                <h1 class="mt-4;" style="display:flex; justify-content:center">Editer le profil de l'utilisateur : </h1>
                <ol class="breadcrumb mb-4" style="display:flex; justify-content:center">
                    <li class="breadcrumb-item active"><h2><?= $params['user']->firstname . ' ' . $params['user']->lastname ?></h2></li>
                </ol>
            </div>
        </header>
        <main>
            <div class="container position-relative px-4 px-lg-5">
                <div class="row gx-4 gx-lg-5 justify-content-center">
                    <div class="col-md-10 col-lg-8 col-xl-7">
                        <form action="/p5-ocr/admin/user/edit/<?= $params['user']->id ?>" method="POST" enctype="multipart/form-data">
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
                                    <img class="card-img-top" style="width: 100%; height: 100%;" src="<?= '/p5-ocr/public/assets/img/' . $user->avatar ?>" alt="Card image cap">
                                <?php else: ?>
                                    <img style="width: 276px; height:180px" src="/p5-ocr/public/assets/img/avatar-default.png" style="width: 100%; height: 100%;" alt="Avatar" />
                                <?php endif; ?>
                            </div>
                            <div class="form-group" style="margin-bottom: 2rem">
                                <label for="avatar">Ajouter un avatar :</label>
                                <input type="file" name="avatar" id="avatar">
                            </div>
                            <button type="submit" class="btn btn-primary" style="margin-top: 2rem;">Enregistrer les modifications</button>
                        </form>
                    </div>
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
