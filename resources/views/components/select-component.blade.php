<div wire:ignore x-data="{}" x-init="() => {
    $('.select2').select2();
    $('.select2').on('change', function(e) {

        let elementName = $(this).attr('id');
        @this.set(elementName, e.target.value);
        Livewire.hook('message.processed', (m, component) => {
            $('.select2').select2();
        })

    })
}">
    <select class="select2 form-control" {{ $attributes }}>
        <option value=""> {{ $title }} -- {{ $dataid }}</option>
        @foreach ($options as $option)
            <option {{ 4 == $option->id ? 'selected' : null }} value="{{ $option->id }}">
                {{ $option->name }}
            </option>
        @endforeach
    </select>
</div>
