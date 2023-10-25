<?php

namespace App\Controllers;

use App\Services\PostService;

class PostController
{
    private $service;

    public function __construct()
    {
        $this->service = new PostService;
    }

    public function index()
    {
        $posts = $this->service->getAllPosts();
        http_response_code(201);
        echo json_encode($posts);
    }


    public function show($id)
    {
        $post = $this->service->getPost($id);
        http_response_code(201);
        echo json_encode($post);
    }

    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $json = file_get_contents('php://input', true);
            $data = json_decode($json, true);
            $post = $this->service->addPost($data);
            $message = ['message' => $post];
        } else {
            $message = ['message' => 'Method Not Allowed'];
        }
        echo json_encode($message);
    }

    public function delete($id)
    {
        $this->service->deletePost($id);
        http_response_code(201);
    }
}

?>