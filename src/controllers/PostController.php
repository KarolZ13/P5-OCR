<?php

namespace src\controllers;

use Models\Post;
use Models\Comment;

class PostController extends MainController {


    //Affiche les posts dans la vue Admin des posts
    public function getAdminPosts()
    {
        $this->isAdmin();

        $posts = (new Post($this->getDB()))->getPosts();

        return $this->view('admin.posts-admin', compact('posts'));
    }

    //Affiche les posts dans la vue principale des posts
    public function posts()
    {
        $post = new Post($this->getDB());
        $posts = $post->getPosts();

        return $this->view('blog.posts', compact('posts'));
    }

    //Affiche les détails d'un post selon son id
    public function show(int $id)
    {
        $post = new Post($this->getDB());
        $post = $post->getPost($id);

        $commentModel = new Comment($this->getDB());
        $comments = $commentModel->findCommentsByPostId($id);
        
        return $this->view('blog.details-post', compact('post', 'comments'));
    }

    //Affiche les détails d'un post dans la vue Admin selon son id pour modification
    public function editPost(int $id)
    {
        $this->isAdmin();

        $post = (new Post($this->getDB()))->getPost($id);
        $post = $post->getPost($id);
        
        return $this->view('admin.post-edit', compact('post'));
    }

    //Met à jour les informations d'un post sélectionné dans la vue Admin
    public function updatePost(int $id)
    {

        $this->isAdmin();

        $postModel = (new Post($this->getDB()))->getPost($id);

        $result = $postModel->updatePost($id, $_POST);
    
        if ($result) {
            header('Location: /p5-ocr/admin/posts');
            exit();
        } else {
            echo "Erreur lors de la modification";
        }
    }    

    //Supprime les informations d'un post sélectionné dans la vue Admin
    public function deletePost(int $id)
    {

        $this->isAdmin();
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $post = new Post($this->getDB());

            $comment = new Comment($this->getDB());
            $comment = $comment->deleteCommentsForPost($id);

            $result = $post->deletePost($id);
    
            if ($result) {
                header('Location: /p5-ocr/admin/posts');
                exit();
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
    
        return $this->view('admin.comments-admin', compact('posts', 'commentsByPost'));
    }
}