<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $allPostsFromDB = Post::all();
        // dd($allPostsFromDB);

        // $allPosts = [
        //     ['id' => 1, 'Title' => 'php', 'Created_By' => 'Mahmoud', 'Created_At' => '2204-02-26'],
        //     ['id' => 2, 'Title' => 'HTML', 'Created_By' => 'Ahmed', 'Created_At' => '2204-01-23'],
        //     ['id' => 3, 'Title' => 'Css', 'Created_By' => 'Mohamed', 'Created_At' => '2204-04-20'],
        //     ['id' => 4, 'Title' => 'JavaScript', 'Created_By' => 'Ammars', 'Created_At' => '2204-03-19'],
        //     ['id' => 5, 'Title' => 'NestJs', 'Created_By' => 'Mahmoud', 'Created_At' => '2204-08-16']

        // ];
        // return view('posts.index', ['posts' => $allPosts]);
        return view('posts.index', ['posts' => $allPostsFromDB]);
    }

    public function show($postId)
    {
        $singlePostFromDB = Post::findOrFail($postId);
        // $singlePostFromDB = Post::where('id', $postId)->first();
        // $singlePostFromDB = Post::where('title', 'PHP')->get();
        // dd($singlePostFromDB);

        // $singlePost = ['Title' => 'php', 'description' => 'This Is Description', 'Created_By' => 'Mahmoud', 'Created_At' => '2204-02-26'];
        // return view('posts.show', ['post' => $singlePost]);

        return view('posts.show', ['post' => $singlePostFromDB]);
    }

    public function create()
    {
        $users = User::all();
        return view('posts.create', ['users' => $users]);
    }

    public function store()
    {
        request()->validate([
            'title' => ['required', 'min:3'],
            'description' => ['required'],
            'post_creator' => ['required', 'exists:user,id']
        ]);

        $data = request()->all();
        $title = request()->title;
        $description = request()->description;
        $postCreator = request()->post_creator;
        // dd($data, 'Titel : ' . $title, 'Description : ' . $description, 'Created By : ' . $postCreator);

        // $post = new Post;

        // $post->title = $title;
        // $post->description = $description;
        // $post->created_by = "Mahmoud";

        // $post->save();

        // :=> When we use fillable property to App\Models\Post <=: \\

        Post::create([
            'title' => $title,
            'description' => $description,
            'created_by' => 'Mahmoud',
            'user_id' => $postCreator,
        ]);

        return to_route(route: 'posts.index');
    }

    public function edit(Post $post)
    {
        $users = User::all();

        return view('posts.edit', ['users' => $users, 'post' => $post]);
    }

    public function update($postId)
    {
        $title = request()->title;
        $description = request()->description;
        $postCreator = request()->post_creator;
        // dd($data, 'Titel : ' . $title, 'Description : ' . $description, 'Created By : ' . $postCreator);

        $singlePostFromDB = Post::findOrFail($postId);
        $singlePostFromDB->update([
            'title' => $title,
            'description' => $description,
            'user_id' => $postCreator,
        ]);

        return to_route(route: 'posts.show', parameters: $postId);
    }

    public function destroy($postId)
    {
        $data = request()->all();
        // dd($data);

        $singlePostFromDB = Post::findOrFail($postId);
        $singlePostFromDB->delete();

        // Post::where('id', $postId)->delete();

        return to_route(route: 'posts.index');
    }

    // => !!!
    public function destroyAll()
    {
        $allPostFromDB = Post::all();
        foreach ($allPostFromDB as $post)
            $post->delete();


        // Post::where('id', $postId)->delete();

        return to_route(route: 'posts.index');
    }
}
