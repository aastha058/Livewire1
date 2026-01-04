<?php

namespace App\Livewire\Forms\Posts;

use App\Models\Post;
use Illuminate\Support\Facades\Storage;
use Livewire\Form;
use Livewire\WithFileUploads;
use Livewire\Attributes\Validate;
use Illuminate\Support\Str;

class PostForm extends Form
{
    use WithFileUploads;

    public ?Post $post;

    #[Validate('required|string|max:255')]
    public $title = '';

    #[Validate('required|image|mimes:jpeg,png,jpg,gif,svg|max:2048')]
    public $image;

    #[Validate('required|string')]
    public $content = '';

    public function setpost( Post $post)
    {
        $this->post = $post;
        $this->title = $post->title;
        $this->content = $post->content;
        

    }

   public function store()
{
    $data = $this->validate();

    // Generate unique slug
    $data['slug'] = $this->generateUniqueSlug($data['title']);

    if ($this->image) {
        $data['image'] = $this->image->store('posts', 'public');
    }

    auth()->user()->posts()->create($data);

    $this->reset();
}

public function update()
{
    $data = $this->validate();

    // Generate unique slug (ignore current post ID)
    $data['slug'] = $this->generateUniqueSlug($data['title'], $this->post->id);

   if ($this->image) {
    Storage::disk('public')->delete($this->post->image);
    $data['image'] = $this->image->store('posts', 'public');
} else {
    unset($data['image']);
}


    $this->post->update($data);

    $this->reset();
}

private function generateUniqueSlug($title, $postId = null)
{
    $slug = Str::slug($title);
    $count = 0;

    // Check if slug exists
    while (Post::where('slug', $slug)
        ->when($postId, fn($query) => $query->where('id', '!=', $postId))
        ->exists()) {
        $count++;
        $slug = Str::slug($title) . '-' . $count;
    }

    return $slug;
}

}

