{{--@can('edit preduzeca')--}}
    <div class="d-flex flex-row-reverse bd-highlight">
        <form action="{{ route('preduzeca.edit', $preduzece) }}" method="GET">
            <button class="btn btn-sm btn-primary">Izmjena</button>
        </form>
    </div>
{{--@endcan--}}
