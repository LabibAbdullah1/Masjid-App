@extends('layouts.app')

@section('title', 'Daftar Quote Islami')

@section('content')
    <div class="container mx-auto px-4 py-8" data-aos="fade-up">
        <h1 class="text-3xl font-bold mb-6 text-center text-green-700">
            📜 Daftar Quote Islami
        </h1>

        <!-- Tombol Tambah -->
        <div class="flex justify-end mb-4">
            <a href="{{ route('admin.quote.create') }}"
                class="bg-yellow-600 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded-lg shadow-md transition duration-300">
                + Tambah Quote
            </a>
        </div>

        <!-- Tabel -->
        <div class="bg-white shadow-lg rounded-lg overflow-x-auto max-w-full border-2 border-green-600" data-aos="fade-up"
            data-aos-delay="200">
            <table class="min-w-full leading-normal">
                <thead class="bg-green-600 text-white">
                    <tr>
                        <th
                            class="px-5 py-3 border-b-2 border-gray-200 text-left text-sm font-semibold uppercase tracking-wider">
                            No
                        </th>
                        <th
                            class="px-5 py-3 border-b-2 border-gray-200 text-left text-sm font-semibold uppercase tracking-wider">
                            Isi Quote
                        </th>
                        <th
                            class="px-5 py-3 border-b-2 border-gray-200 text-left text-sm font-semibold uppercase tracking-wider">
                            Sumber
                        </th>
                        <th
                            class="px-5 py-3 border-b-2 border-gray-200 text-center text-sm font-semibold uppercase tracking-wider">
                            Aksi
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($quotes as $quote)
                        <tr class="hover:bg-green-50 transition duration-150">
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                {{ $loop->iteration + ($quotes->currentPage() - 1) * $quotes->perPage() }}
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm max-w-xs truncate">
                                {{ $quote->text }}
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm max-w-xs truncate">
                                {{ $quote->source ?? '-' }}
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm text-center">
                                <div class="flex justify-center space-x-2">
                                    <a href="{{ route('admin.quote.edit', $quote->id) }}"
                                        class="text-yellow-600 hover:text-yellow-800 transition duration-150">
                                        <i class="fa-regular fa-pen-to-square mr-2"></i>
                                    </a>
                                    <form action="{{ route('admin.quote.destroy', $quote->id) }}" method="POST"
                                        onsubmit="return confirm('Yakin ingin menghapus quote ini?')" class="delete-form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="text-red-600 hover:text-red-800 transition duration-150">
                                            <i class="fa-regular fa-trash-can"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-5 py-5 text-center text-gray-500">
                                Belum ada quote yang ditambahkan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="mt-6">
            {{ $quotes->links() }}
        </div>
    </div>
@endsection
