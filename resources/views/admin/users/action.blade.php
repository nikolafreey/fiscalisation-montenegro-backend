@can('edit users')
    <div class="d-flex flex-row-reverse bd-highlight">
        <form action="{{ route('users.edit', $user) }}" method="GET">
            <button class="btn btn-primary">Dodajte ulogu</button>
        </form>
    </div>
@endcan
