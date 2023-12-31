<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Editer l'article : <?= $params['post']->title ?></title>
    </head>
    <body class="sb-nav-fixed">
        <header>
            <div class="container-fluid px-4; justify-content-center">
                <?php if (isset($_GET['success'])): ?>
                    <div class="alert alert-success" style="margin-top: 1rem">Les modifications ont été apporté sur l'article!</div>
                <?php endif ?>
                <h1 class="mt-4;" style="display:flex; justify-content:center">Editer l'article : <?= $params['post']->title ?></h1>
                <ol class="breadcrumb mb-4" style="display:flex; justify-content:center">
                    <li class="breadcrumb-item active"><?= $params['post']->chapo ?></li>
                </ol>
            </div>
        </header>
        <main>
            <div class="container position-relative px-4 px-lg-5">
                <div class="row gx-4 gx-lg-5 justify-content-center">
                    <div class="col-md-10 col-lg-8 col-xl-7">
                        <form action="/p5-ocr/admin/posts/edit/<?= $params['post']->id ?>" method="post" enctype="multipart/form-data">
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
                                <textarea name="content" id="content" rows ="12" class="form-control"><?= $params['post']->content ?></textarea>
                            </div>
                            <div class="form-group" style="margin-bottom: 2rem">
                                <label for="id_categories">Catégorie de l'article :</label>
                                <select name="id_categories" id="id_categories" class="form-control">
                                    <?php foreach ($params['categories'] as $category) : ?>
                                        <option value="<?= $category->id ?>" <?= ($category->id == $params['post']->id_categories) ? 'selected' : '' ?>>
                                            <?= $category->name ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group" style="margin-bottom: 2rem">
                                <label for="new_picture">Ajouter une image à l'article :</label>
                                <input type="file" name="new_picture" id="new_picture">
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
