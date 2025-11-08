@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-8" data-aos="fade-up">
        <h1 class="text-3xl font-bold mb-6 text-center text-green-700">
            <i class="fas fa-mosque mr-2"></i> Kelola Kategori Keuangan Masjid
        </h1>

        <div class="flex justify-end mb-4">
            <a href="{{ route('kategori.create') }}"
                class="bg-yellow-600 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded-lg shadow-md transition duration-300">
                + Tambah Kategori
            </a>
        </div>

        <div class="bg-white shadow-lg rounded-lg overflow-hidden border-2 border-green-600" data-aos="fade-up"
            data-aos-delay="200">
            <table class="min-w-full leading-normal">
                <thead class="bg-green-600 text-white">
                    <tr>
                        <th
                            class="px-5 py-3 border-b-2 border-gray-200 text-left text-sm font-semibold uppercase tracking-wider">
                            Nama Kategori
                        </th>
                        <th
                            class="px-5 py-3 border-b-2 border-gray-200 text-left text-sm font-semibold uppercase tracking-wider">
                            Aksi
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($kategoris as $kategori)
                        <tr class="hover:bg-green-50 transition duration-150">
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                {{ $kategori->nama_kategori }}
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                <div class="flex space-x-2">
                                    <a href="{{ route('kategori.edit', $kategori->id) }}"
                                        class="text-yellow-600 hover:text-yellow-800 transition duration-150">
                                        <i class="fa-regular fa-pen-to-square mr-2"></i>
                                    </a>
                                    <form action="{{ route('kategori.destroy', $kategori->id) }}" method="POST"
                                        onsubmit="return confirm('Apakah Anda yakin ingin menghapus kategori ini?')" class="delete-form">
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
                            <td colspan="2" class="px-5 py-5 text-center text-gray-500">
                                Belum ada kategori yang ditambahkan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
