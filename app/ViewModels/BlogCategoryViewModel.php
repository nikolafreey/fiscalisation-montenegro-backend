<?php

namespace App\ViewModels;

use App\Models\BlogCategory;
use Illuminate\Support\Facades\Route;
use Spatie\ViewModels\ViewModel;

class BlogCategoryViewModel extends ViewModel
{
    public $action = '';

    public function __construct(BlogCategory $category = null)
    {
        $this->category = $category;
        $this->action = last(explode('.', Route::currentRouteName()));
    }

    public function blogCategory()
    {
        return $this->category ?? new BlogCategory();
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
