<div class="d-flex justify-content-end">
    <form action="{{ route('blogCategories.edit', $blogCategory) }}" method="GET">
        <button class="btn btn-sm btn-primary mr-1">Izmjenite</button>
    </form>
    <form action="{{ route('blogCategories.destroy', $blogCategory) }}" method="POST">
        @method('delete')
        @csrf
        <button class="btn btn-sm btn-danger">Izbrisite</button>
    </form>
</div>
