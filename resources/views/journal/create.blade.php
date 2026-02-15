<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ __('Tulis Jurnal Baru') }}</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form action="{{ route('journal.store') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700">Judul</label>
                        <input type="text" name="title"
                            class="w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                            required placeholder="Contoh: Hari yang melelahkan...">
                    </div>

                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700">Isi Ceritamu</label>
                        <textarea name="content" rows="10"
                            class="w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                            required placeholder="Tulis semua yang kamu rasakan..."></textarea>
                    </div>

                    <button type="submit"
                        class="w-full bg-indigo-600 text-white py-3 rounded-md font-bold hover:bg-indigo-700">
                        Simpan & Analisis AI 🤖
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>