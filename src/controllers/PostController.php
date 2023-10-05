<?php

namespace src\controllers;

use Models\Post;
use Models\Comment;

class PostController extends MainController 
{

    /** Affiche les articles dans la vue utilisateur */
    public function posts()
    {
        $post = new Post($this->getDB());
        $posts = $post->getPosts();

        return $this->view('blog.posts', compact('posts'));
    }

    /** Affiche les détails d'un article et ses commentaires selon son id */
    public function show(int $id)
    {
        $post = new Post($this->getDB());
        $post = $post->getPost($id);

        $commentModel = new Comment($this->getDB());
        $comments = $commentModel->getCommentsByPostId($id);
        
        return $this->view('blog.details-post', compact('post', 'comments'));
    }



    /** Mise à jour des informations d'un article sélectionné dans la vue Admin */
    public function updatePost(int $id)
    {
        $this->isAdmin();
        $postModel = (new Post($this->getDB()))->getPost($id);
    
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = $_POST;
    
            if (isset($_FILES['new_picture']) && $_FILES['new_picture']['error'] === UPLOAD_ERR_OK) {
                $uploadDir = '/p5-ocr/public/assets/img/';
                $originalFileName = $_FILES['new_picture']['name'];
                $newFileName = uniqid() . '_' . $originalFileName;
            
                if (!empty($postModel->picture)) {
                    unlink($uploadDir . $postModel->picture);
                }
            
                move_uploaded_file($_FILES['new_picture']['tmp_name'], $uploadDir . $newFileName);
            
                $data['picture'] = $originalFileName;
            } else {
                $data['picture'] = $postModel->picture;
            }
    
            $result = $postModel->updatePost($id, $data);
    
            if ($result) {
                return header("Location: /p5-ocr/admin/posts/edit/{$id}?success=true");
            } else {
                echo "Erreur lors de la modification";
            }
        }
    }

    /** Suppression des informations d'un article sélectionné dans la vue administrateur */
    public function deletePost(int $id)
    {

        $this->isAdmin();
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $post = new Post($this->getDB());

            $comment = new Comment($this->getDB());
            $comment = $comment->deleteCommentsForPost($id);

            $result = $post->deletePost($id);
    
            if ($result) {
                header('Location: /p5-ocr/admin/posts?success=true');
            } else {
                header('Location: /p5-ocr/admin/posts?error=true');
            }
        }
    }
    
    /** Changement de status d'un article */
    public function togglePost(int $id)
    {
        $this->isAdmin();
    
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $post = new Post($this->getDB());
            $currentStatus = $post->getPostStatus($id);
            $newStatus = $currentStatus;
            $result = $post->togglePostStatus($id, $newStatus);

            if ($result) {
                header('Location: /p5-ocr/admin/posts?success=true');
            } else {
                header('Location: /p5-ocr/admin/posts?error=true');
            }
        }
    }


    /** Affiche les informations des commentaires selon un article dans la vue administateur */
    public function showCommentsByPost()
    {
        $this->isAdmin();
    
        $postModel = new Post($this->getDB());
        $posts = $postModel->getPosts(); 
    
        $commentModel = new Comment($this->getDB());
        $commentsByPost = [];
    
        foreach ($posts as $post) {
            $comments = $commentModel->getCommentsByPostId($post->id);
            $commentsByPost[$post->id] = $comments;
        }
    
        return $this->adminView('admin.comments-admin', ['posts' => $posts, 'commentsByPost' => $commentsByPost]);
    }

    /** Affiche les articles dans la vue administrateur */
    public function showAdminPosts()
    {
        $this->isAdmin();

        $posts = (new Post($this->getDB()))->getPosts();

        return $this->adminView('admin.posts-admin', compact('posts'));
    }

    /** Affiche les détails d'un article dans la vue administrateur selon son id pour modification */
    public function editPost(int $id)
    {
        $this->isAdmin();
    
        $post = (new Post($this->getDB()))->getPost($id);
        $categories = (new Post($this->getDB()))->getCategories();
        $id_categories = $post->id_categories;
    
        return $this->adminView('admin.post-edit', compact('post', 'categories', 'id_categories'));
    }
    

    /** Récupération des données du formulaire pour la création d'un article */
    public function createPost()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = $_POST['title'];
            $content = $_POST['content'];
            $chapo = $_POST['chapo'];
            $status = 1;
            $idUser = $_SESSION['auth']['id'];
            $createdAt = date("Y/m/d");
            $id_categories = (int)$_POST['id_categories'];
            
    
            if (isset($_FILES['picture']) && $_FILES['picture']['error'] === UPLOAD_ERR_OK) {
                $picture = $_FILES['picture']['name'];
    
                $uploadDir = '/p5-ocr/public/assets/img/';
                $uploadPath = $uploadDir . $picture;
    
                move_uploaded_file($_FILES['picture']['tmp_name'], $uploadPath);
            } else {
                $picture = null;
            }
    
            $idUser = (int)$idUser;
    
            $postModel = new Post($this->getDB());
    
            $result = $postModel->addPost($title, $content, $chapo, $picture, $status, $idUser, $id_categories, $createdAt);
    
            if ($result === 1) {
                return header("Location: /p5-ocr/admin/posts");
            } else {
                return header("Location: /p5-ocr/admin/posts");
            }
        }
    }
    
    /** Affiche la vue pour l'ajout d'un article dans l'espace administrateur */
    public function addPostView()
    {
        $this->isAdmin();

        $categories = (new Post($this->getDB()))->getCategories();
        $post = null;

        return $this->adminView('admin.post-add', compact('categories', 'post'));
    }
}