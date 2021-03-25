@can('edit users')
    <div class="d-flex flex-row-reverse bd-highlight">
        <a href="{{ route('users.edit', $user) }}" class="btn btn-sm btn-primary ml-2">
            Izmjenite
        </a>
        <a href="{{ route('izmjeniteUlogu', $user) }}" class="btn btn-sm btn-primary">
            Izmjenite Ulogu
        </a>
    </div>
@endcan
