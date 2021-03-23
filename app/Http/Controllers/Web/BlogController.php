<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\BlogRequest;
use App\Models\Blog;
use App\ViewModels\BlogViewModel;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class BlogController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return DataTables::eloquent(
                Blog::query()
            )
                ->addColumn('action', function ($blog) {
                    return view('admin.blog.action', compact('blog'));
                })
                ->make();
        };

        return view('admin.blog.index');
    }

    public function create()
    {
        $viewModel = new BlogViewModel();

        return view('admin.blog.form', $viewModel);
    }

    public function store(BlogRequest $request)
    {
        Blog::create($request->validated());

        return redirect(route('blogs.index'));
    }

    public function edit(Blog $blog)
    {
        $viewModel = new BlogViewModel($blog);

        return view('admin.blog.form', $viewModel);
    }

    public function update(Blog $blog, BlogRequest $request)
    {
        $blog->update($request->validated());

        return redirect(route('blogs.index'));
    }

    public function destroy(Blog $blog)
    {
        $blog->delete();

        return back();
    }
}
