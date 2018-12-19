<form style="display:inline" action="{{ url($table.'/'.$idkey) }}" method="post">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger">
        {{ __('Delete') }}
    </button>
</form>
