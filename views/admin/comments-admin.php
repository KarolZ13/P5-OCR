<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Tableau de bord - Commentaires</title>
        <style>
            .px-4 {
                padding-top: 20px;
            }
        </style>
    </head>
    <body class="sb-nav-fixed">
    <main>
    <div class="container-fluid px-4">
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Rapport utilisateur
            </div>
            <div class="card-body">
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>Prénom / Nom</th>
                            <th>Article</th>
                            <th>Contenu du commentaire</th>
                            <th>Date d'ajout</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Prénom / Nom</th>
                            <th>Article</th>
                            <th>Contenu du commentaire</th>
                            <th>Date d'ajout</th>
                            <th>Actions</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php foreach ($params['posts'] as $post): ?>
                            <?php foreach ($params['commentsByPost'][$post->id] as $comment): ?>
                                <tr>
                                    <td><?= $comment->comment_author_firstname ?> <?= $comment->comment_author_lastname ?></td>
                                    <td><?= $post->title ?></td>
                                    <td><?= $comment->comment ?></td>
                                    <td><?= $comment->formatted_created_at ?></td>
                                    <td>
                                        <div style="display: flex; justify-content: space-around;">
                                            <form action="/p5-ocr/admin/posts/<?= $post->id ?>" method="post" class="d-inline">
                                                <input type="hidden" name="id" value="<?= $post->id ?>">
                                                <button type="submit" class="btn btn-outline-dark" title="Valider le commentaire">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                                                        <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/>
                                                        <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z"/>
                                                    </svg>
                                                </button>
                                            </form>
                                            <form action="/p5-ocr/admin/posts/<?= $post->id ?>" method="post" class="d-inline">
                                                <input type="hidden" name="id" value="<?= $post->id ?>">
                                                <button type="submit" onclick="return confirm('Voulez-vous supprimer définitivement cet article ?')" class="btn btn-outline-danger" title="Supprimer le commentaire">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                        <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5Zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6Z"/>
                                                        <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1ZM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118ZM2.5 3h11V2h-11v1Z"/>
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="/p5-ocr/public/js/scripts2.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="/p5-ocr/public/assets/demo/chart-area-demo.js"></script>
    <script src="/p5-ocr/public/assets/demo/chart-bar-demo.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
    <script src="/p5-ocr/public/js/datatables-simple-demo.js"></script>
    </body>
</html>