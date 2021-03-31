@can('edit preduzeca')
    <div class="d-flex flex-row-reverse bd-highlight">
        <form action="{{ route('aktivnosti.show', $activity) }}" method="GET">
            <button class="btn btn-sm btn-warning">Prikazi aktivnost</button>
        </form>
    </div>
@endcan
