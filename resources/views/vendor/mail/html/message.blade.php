<x-mail::layout>

{{-- Body --}}
{!! $slot !!}

{{-- Subcopy --}}
{{-- @isset($subcopy)
<x-slot:subcopy>
<x-mail::subcopy>
{!! $subcopy !!}
</x-mail::subcopy>
</x-slot:subcopy>
@endisset --}}

{{-- Footer --}}
<x-slot:footer>
<x-mail::footer>
Fluxon Digital © {{ date('Y') }} Todos os direitos reservados.
</x-mail::footer>
</x-slot:footer>
</x-mail::layout>
