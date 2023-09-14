<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Tableau de bord - Admin</title>
    </head>
    <body class="sb-nav-fixed">
        <main>
            <div class="container-fluid px-4">
                <?php if (isset($_GET['success'])): ?>
                    <div class="alert alert-success" style="margin-top : 15px;">Vous êtes connecté!</div>
                <?php endif ?>
                <h1 class="mt-4">Tableau de bord</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active">Tableau de bord</li>
                </ol>
                <div class="row">
                    <div class="col-xl-3 col-md-6">
                        <div class="card bg-primary text-white mb-4">
                            <div class="card-body">Gestion des articles</div>
                            <div class="card-footer d-flex align-items-center justify-content-between">
                                <a class="small text-white stretched-link" href="/P5-OCR/admin/posts">Voir les détails</a>
                                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <div class="card bg-warning text-white mb-4">
                            <div class="card-body">Gestion des commentaires</div>
                            <div class="card-footer d-flex align-items-center justify-content-between">
                                <a class="small text-white stretched-link" href="/P5-OCR/admin/comments">Voir les détails</a>
                                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-md-6">
                        <div class="card bg-success text-white mb-4">
                            <div class="card-body">Gestion des utilisateurs</div>
                            <div class="card-footer d-flex align-items-center justify-content-between">
                                <a class="small text-white stretched-link" href="/P5-OCR/admin/users">Voir les détails</a>
                                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                            </div>
                        </div>
                    </div>
                </div>
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
                                    <th>Adresse mail</th>
                                    <th>Nombre de commentaire</th>
                                    <th>Nombre d'article créé</th>
                                    <th>Utilisateur administrateur</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Prénom / Nom</th>
                                    <th>Adresse mail</th>
                                    <th>Nombre de commentaire</th>
                                    <th>Nombre d'article créé</th>
                                    <th>Utilisateur administrateur</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                <?php foreach ($params['users'] as $key => $user): ?>
                                <tr>
                                    <td><?= $user->firstname . ' ' . $user->lastname ?></td>
                                    <td><?= $user->email ?></td>
                                    <td><?= $params['usersWithCommentCounts'][$key]->comment_count ?></td>
                                    <td><?= $params['usersWithPostCounts'][$key]->post_count ?></td>
                                    <td><?= $user->is_admin ? 'Oui' : 'Non' ?></td>
                                </tr>
                                <?php endforeach ?>
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