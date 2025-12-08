<x-mail::message>
    # Verificação de E-mail

    Olá! 👋
    Obrigado por criar sua conta na **Fluxon Digital**.

    Clique no botão abaixo para confirmar seu endereço de e-mail e liberar seu acesso:

    <x-mail::button :url="$actionUrl" color="orange">
        Verificar Email
    </x-mail::button>

    Se você não realizou este cadastro, basta ignorar esta mensagem.

    Atenciosamente,
    **Fluxon Digital**

    {{-- Subcopy --}}
    <x-slot:subcopy>
        Se você estiver com dificuldades para clicar no botão, copie e cole o link abaixo no seu navegador:

        {{ $displayableActionUrl }}
    </x-slot:subcopy>
</x-mail::message>
