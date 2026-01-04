<?php

namespace App\Livewire\Posts;

use App\Models\Post;
use Livewire\Component;

class PostIndex extends Component
{
    protected $listeners = ['deleteConfirmed' => 'destroyPost'];

    public function render()
    {
        return view('livewire.posts.post-index', [
            'posts' => auth()->user()->posts()->latest()->get()
        ]);
    }

  public function deletePost($id)
{
    $post = Post::find($id);
    if ($post) {
        $post->delete();
        session()->flash('message', "Post  $id deleted successfully!");
    }
}

    public function destroyPost($id)
    {
        $post = Post::find($id);
        if ($post) {
            $post->delete();
            session()->flash('message', 'Post deleted successfully!');
        }
    }
}
