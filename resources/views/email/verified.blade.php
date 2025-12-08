<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Verificação de E-mail</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    {{-- Tailwind CDN apenas para esta página --}}
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="min-h-screen bg-gradient-to-br from-orange-50 via-white to-amber-50 flex items-center justify-center p-4">

    <div class="w-full max-w-md">
        <div class="bg-white rounded-2xl shadow-xl p-8 space-y-6 text-center">

            <div class="flex justify-center">
                <div class="bg-orange-500 p-3 rounded-full">
                    <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M9 12l2 2 4-4m5 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
            </div>

            <h1 class="text-3xl font-bold text-gray-900">
                E-mail verificado com sucesso! 🎉
            </h1>

            <p class="text-gray-600">
                {{ $message }}
            </p>


            <a href="{{ config('app.frontend_url') . '/login' }}"
                class="w-full block bg-orange-500 hover:bg-orange-600 text-white font-semibold py-3 px-4 rounded-lg transition-colors shadow-lg shadow-orange-200">
                Ir para o Login
            </a>

        </div>

        <p class="text-center text-sm text-gray-600 mt-6">Fluxon Digital © {{ date('Y') }}</p>
    </div>

</body>

</html>
