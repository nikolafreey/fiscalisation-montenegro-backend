<div class="btn-group">
    <form action="{{ route('ulogovaniKorisnici.destroy', $activeUser) }}" method="POST"  >
        @method('delete')
        @csrf
        <button class="btn btn-sm btn-warning">Izlogujte</button>
    </form>
</div>
