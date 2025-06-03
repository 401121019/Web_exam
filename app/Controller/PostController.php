<?php 

namespace App\Controller;
use App\Model\Post;
class PostController{
    public static function index()
    {
        return view("Posts/index.php");   
    }
    public static function create()
    {
        var_dump($_SESSION);
        return view("posts/create.php");
        
    }
    public static function show()
    {
        return view('posts/show.php');

    }
    
    public static function store()
    {
        $title = $_POST['title'];
        $body = $_POST['body'];
        $user_id = $_SESSION['user']['id'];
        Post::create(['title'=>$title, 'body'=>$body, 'user_id'=>$user_id]);
        return redirect("/project/post");

    }



    public static function edit()
    {
        $id = $_GET['id'] ?? null;

    if (!$id) {
        return redirect('/project/post');
    }

    $post = Post::find($id);
    if (!$post) {
        return redirect('/project/post');
    }

    return view('Posts/edit.php', ['post' => $post]);
    }



    public static function update() {
    $id = $_POST['id'] ?? null;
    $title = $_POST['title'] ?? '';
    $body = $_POST['body'] ?? '';

    $post = Post::find($id);
    if ($post && $post->user_id == $_SESSION['user']['id']) {
        $post->title = $title;
        $post->body = $body;
        $post->save();
    }

    return redirect('/project/post');
}

    public static function delete()
    {
        $id = $_GET['id'] ?? null;

    if ($id) {
        $post = Post::find($id);
        if ($post && $post->user_id == $_SESSION['user']['id']) {
            $post->delete();
        }
    }

    return redirect('/project/post');
    }
    
}