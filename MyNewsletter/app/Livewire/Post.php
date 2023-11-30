<?php

namespace App\Livewire;
use App\Models\Post as BlogPost;
use Livewire\Component;

class Post extends Component
{
    public $post;
    public function mount($slug){
    $this->post = BlogPost::where('slug', $slug)->first();
    }

public function render()
{
    return view('livewire.post')
        ->extends('layouts.app')
        ->section('content');
}





    public function render(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
{
        return view('livewire.post');
    }
}
