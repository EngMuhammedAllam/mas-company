{{-- Small inline active/inactive switch rendered as its own form. --}}
<form method="POST" action="{{ $action }}" style="display:inline">
    @csrf
    @method('PATCH')
    <button type="submit" class="badge {{ $active ? 'badge--on' : 'badge--off' }}"
            style="border:0;cursor:pointer"
            title="{{ $active ? 'اضغط للإخفاء' : 'اضغط للتفعيل' }}">
        {{ $active ? 'ظاهر' : 'مخفي' }}
    </button>
</form>
