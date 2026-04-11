<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ __('Detail Jurnal') }}</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="border-b pb-4 mb-4">
                    <h1 class="text-2xl font-bold mb-2">{{ $journal->title }}</h1>
                    <div class="flex gap-3 text-sm">
                        <span class="text-gray-500">{{ $journal->created_at->format('d M Y') }}</span>

                    </div>
                </div>



                <div class="prose max-w-none text-gray-800 whitespace-pre-wrap leading-relaxed">
                    {{ $journal->content }}
                </div>

                <div class="mt-8 pt-4 border-t">
                    <a href="{{ route('journal.index') }}" class="text-indigo-600 hover:underline">&larr; Kembali ke
                        daftar</a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>