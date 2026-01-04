<?php

namespace App\Livewire\Posts;

use App\Livewire\Forms\Posts\PostForm;
use Livewire\Component;
use App\Models\Post;
use Livewire\WithFileUploads;

class PostCreate extends Component
{

    use WithFileUploads;
    public PostForm $form;

    public function savePost(){
         $this->form->store();
         session()->flash('success','Post created successfully!');
         return redirect()->route('posts.index');

    }
    public function render()
    {
        
        return view('livewire.posts.post-create');
    }
}
