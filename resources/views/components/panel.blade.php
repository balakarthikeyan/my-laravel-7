<div {{ $attributes->merge(['class' => 'p-6 rounded-lg']) }}>
   <div class="text-center">{{ $title ?? '' }}</div>
    <div class="text-center">
        {{ $slot ?? '' }}
    </div>
</div>