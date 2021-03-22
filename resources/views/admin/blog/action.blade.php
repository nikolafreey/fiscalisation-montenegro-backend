<div class="d-flex justify-content-end">
    <form action="{{ route('blogs.edit', $blog) }}" method="GET">
        <button class="btn btn-sm btn-primary mr-1">Izmijenite</button>
    </form>
    <form action="{{ route('blogs.destroy', $blog) }}" method="POST">
        @method('delete')
        @csrf
        <button class="btn btn-sm btn-danger">Izbrisite</button>
    </form>
</div>
