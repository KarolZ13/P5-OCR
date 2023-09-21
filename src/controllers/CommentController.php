<?php

namespace src\controllers;

use Models\Comment;
use Models\Post;

class CommentController extends MainController {

    // Récupération des informations d'un ajout de commentaire par un utilisateur
    public function commentPost(int $postID)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $comment = $_POST['comment'];
            $createdAt = date("Y-m-d");
            $isValid = 0;
            $userIdRaw = $_SESSION['auth']['id'];

            $userID = (int)$userIdRaw;
        
            $commentModel = new Comment($this->getDB());
        
            $result = $commentModel->addComment($comment, $isValid, $userID, $postID, $createdAt);
        
            if ($result === 1) {
                return header("Location: /p5-ocr/post/{$postID}");
            } else {
                return header("Location: /p5-ocr/post/{$postID}?error=true");
            }
        }
    }

    // Montre les informations des commentaires selon un post dans la vue Admin/Comments
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