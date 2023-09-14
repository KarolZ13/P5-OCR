<?php

namespace src\controllers;

use Models\Comment;
use Models\Post;

class CommentController extends MainController {

    public function commentPost(int $postID)
    {
        // Vérifiez d'abord si un commentaire a été soumis via POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Récupérer les données du formulaire
            $comment = $_POST['comment'];
            $createdAt = date("Y-m-d");
            $isValid = 0;
            $userIdRaw = $_SESSION['auth']['id'];
            var_dump($userIdRaw); // Débogage pour vérifier la valeur

            $userID = (int)$userIdRaw;
        
            // Créer une instance du modèle Comment
            $commentModel = new Comment($this->getDB());
        
            // Appeler la méthode addComment pour ajouter le commentaire
            $result = $commentModel->addComment($comment, $isValid, $userID, $postID, $createdAt);
        
            if ($result === 1) {
                // Le commentaire a été ajouté avec succès, vous pouvez rediriger l'utilisateur vers une page de confirmation
                // ou effectuer d'autres actions nécessaires.
                // Par exemple, vous pouvez rediriger l'utilisateur vers la page de détails du post.
                return header("Location: /p5-ocr/post/{$postID}");
            } else {
                // Gérer les erreurs si l'ajout a échoué
                // Par exemple, vous pouvez rediriger l'utilisateur vers la même page avec un message d'erreur.
                return header("Location: /p5-ocr/post/{$postID}?error=true");
            }
        }
    }

    //Montre les informations des commentaires selon un post dans la vue Admin/Comments
    public function showCommentsByPost()
    {

        $this->isAdmin();

        $postModel = new Post($this->getDB());
        $posts = $postModel->getPosts(); // Récupérez tous les posts
    
        $commentModel = new Comment($this->getDB());
        $commentsByPost = [];
    
        foreach ($posts as $post) {
            // Pour chaque post, récupérez les commentaires associés
            $comments = $commentModel->findCommentsByPostId($post->id);
            $commentsByPost[$post->id] = $comments; // Stockez les commentaires dans un tableau associatif avec l'ID du post comme clé
        }
    
        return $this->adminView('admin.comments-admin', compact('posts', 'commentsByPost'));
    }
}