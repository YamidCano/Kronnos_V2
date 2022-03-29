<div class="mode" wire:click="theme">
    @if (auth()->user()->theme == 1)
        <i class="fa fa-lightbulb-o"></i>
    @else
        <i class="fa fa-moon-o"></i>
    @endif
</div>
