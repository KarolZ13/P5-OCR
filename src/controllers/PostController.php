<?php

namespace src\controllers;

use Models\Post;
use Models\Comment;

class PostController extends MainController {

    // Affiche les posts dans la vue utilisateur des articles
    public function posts()
    {
        $post = new Post($this->getDB());
        $posts = $post->getPosts();

        return $this->view('blog.posts', compact('posts'));
    }

    // Affiche les détails d'un article et ses commentaires selon son id
    public function show(int $id)
    {
        $post = new Post($this->getDB());
        $post = $post->getPost($id);

        $commentModel = new Comment($this->getDB());
        $comments = $commentModel->findCommentsByPostId($id);
        
        return $this->view('blog.details-post', compact('post', 'comments'));
    }



    // Met à jour les informations d'un article sélectionné dans la vue Admin
    public function updatePost(int $id)
    {

        $this->isAdmin();

        $postModel = (new Post($this->getDB()))->getPost($id);

        $result = $postModel->updatePost($id, $_POST);
    
        if ($result) {
           return header("Location: /p5-ocr/admin/posts/edit/{$id}?success=true");
            exit();
        } else {
            echo "Erreur lors de la modification";
        }
    }    

    // Supprime les informations d'un article sélectionné dans la vue administrateur des articles
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
    
    public function togglePost(int $id)
    {

        $this->isAdmin();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $post = new Post($this->getDB());

            $currentStatus = $post->getPostStatus($id);

            $newStatus = ($currentStatus == 0) ? 1 : 0;

            $result = $post->togglePostStatus($id, $newStatus);
    
            if ($result) {
                header('Location: /p5-ocr/admin/posts?success=true');
                exit();
            }
        }
    }


    // Montre les informations des commentaires selon un article dans la vue administateur des commentaires
    public function showCommentsByPost()
    {
        $this->isAdmin();
    
        $postModel = new Post($this->getDB());
        $posts = $postModel->getPosts(); 
    
        $commentModel = new Comment($this->getDB());
        $commentsByPost = [];
    
        foreach ($posts as $post) {
            $comments = $commentModel->findCommentsByPostId($post->id);
            $commentsByPost[$post->id] = $comments;
        }
    
        return $this->adminView('admin.comments-admin', ['posts' => $posts, 'commentsByPost' => $commentsByPost]);
    }

    // Affiche les articls dans la vue administrateur des articles
    public function getAdminPosts()
    {
        $this->isAdmin();

        $posts = (new Post($this->getDB()))->getPosts();

        return $this->adminView('admin.posts-admin', compact('posts'));
    }

    // Affiche les détails d'un article dans la vue administrateur selon son id pour modification
    public function editPost(int $id)
    {
        $this->isAdmin();

        $post = (new Post($this->getDB()))->getPost($id);
        $post = $post->getPost($id);
        
        return $this->adminView('admin.post-edit', compact('post'));
    }
}