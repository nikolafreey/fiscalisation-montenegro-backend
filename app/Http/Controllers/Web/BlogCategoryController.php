<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\BlogCategoryRequest;
use App\Models\BlogCategory;
use App\ViewModels\BlogCategoryViewModel;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class BlogCategoryController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return DataTables::eloquent(
                BlogCategory::query()
            )
                ->addColumn('action', function ($blogCategory) {
                    return view('admin.blogCategory.action', compact('blogCategory'));
                })
                ->make();
        };

        return view('admin.blogCategory.index');
    }

    public function create()
    {
        $viewModel = new BlogCategoryViewModel();

        return view('admin.blogCategory.form', $viewModel);
    }

    public function store(BlogCategoryRequest $request)
    {
        BlogCategory::create($request->validated());

        $request->session()->flash('success', 'Uspješno ste dodali kategoriju bloga');

        return redirect(route('blogCategories.index'));
    }

    public function edit(BlogCategory $blogCategory)
    {
        $viewModel = new BlogCategoryViewModel($blogCategory);

        return view('admin.blogCategory.form', $viewModel);
    }

    public function update(BlogCategory $blogCategory, BlogCategoryRequest $request)
    {
        $blogCategory->update($request->validated());

        $request->session()->flash('success', 'Uspješno ste izmijenili kategoriju bloga');

        return redirect(route('blogCategories.index'));
    }

    public function destroy(BlogCategory $blogCategory, Request $request)
    {
        $blogCategory->delete();

        $request->session()->flash('success', 'Uspješno ste obrisali kategoriju bloga');

        return back();
    }
}
