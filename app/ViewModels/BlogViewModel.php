<?php

namespace App\ViewModels;

use App\Models\Blog;
use App\Models\BlogCategory;
use Illuminate\Support\Facades\Route;
use Spatie\ViewModels\ViewModel;

class BlogViewModel extends ViewModel
{
    public $action = '';

    public function __construct(Blog $blog = null)
    {
        $this->blog = $blog;
        $this->action = last(explode('.', Route::currentRouteName()));
    }

    public function blog()
    {
        return $this->blog ?? new Blog();
    }

    public function blogCategories()
    {
        return BlogCategory::orderBy('naziv')->get();
    }

    public function method()
    {
        if ($this->action === 'edit') {
            return 'PUT';
        }

        return 'POST';
    }

    public function action()
    {
        if ($this->action === 'edit') {
            return true;
        }

        return false;
    }

}
