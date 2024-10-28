@foreach ($children as $child)
    <option value="{{ $child->id }}" >
        {{ str_repeat('--', $level) }} {{ $child->name }}
    </option>
    @if ($child->children->count() > 0)
        @include('admin.pages.category.option', ['children' => $child->children, 'level' => $level + 1])
    @endif
@endforeach
