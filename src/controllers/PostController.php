<?php

namespace src\controllers;

use Models\Post;
use Models\Comment;

class PostController extends MainController {

    public function getAdminPosts()
    {
        $posts = (new Post($this->getDB()))->getPosts();

        return $this->view('admin.posts-admin', compact('posts'));
    }

    public function posts()
    {
        $post = new Post($this->getDB());
        $posts = $post->getPosts();

        return $this->view('blog.posts', compact('posts'));
    }

    public function show(int $id)
    {
        $post = new Post($this->getDB());
        $post = $post->getPost($id);

        $commentModel = new Comment($this->getDB());
        $comments = $commentModel->findCommentsByPostId($id);
        
        return $this->view('blog.details-post', compact('post', 'comments'));
    }

    public function editPost(int $id)
    {
        $post = (new Post($this->getDB()))->getPost($id);
        $post = $post->getPost($id);
        
        return $this->view('admin.post-edit', compact('post'));
    }

    public function updatePost(int $id)
    {
        $postModel = (new Post($this->getDB()))->getPost($id);

        $result = $postModel->updatePost($id, $_POST);
    
        if ($result) {
            header('Location: /p5-ocr/admin/posts');
            exit();
        } else {
            echo "Erreur lors de la modification";
        }
    }    

    public function deletePost(int $id)
    {
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
}