@extends('layouts.app')

@section('header', 'Wisdom Repository')

@section('content')
    <div class="space-y-8" data-aos="fade-up">
        {{-- Header & Action Bar --}}
        <div class="glass-card rounded-[2.5rem] p-8 futuristic-bg text-white relative overflow-hidden group">
            <div class="absolute inset-0 bg-black/10"></div>
            <div class="relative z-10 flex flex-col md:flex-row items-center gap-6">
                <div class="p-5 bg-white/20 backdrop-blur-xl rounded-3xl border border-white/30 group-hover:scale-110 transition-transform duration-500">
                    <i class="fa fa-quote-right text-4xl"></i>
                </div>
                <div>
                    <h2 class="text-3xl font-black tracking-tighter">Database Pesan Bijak</h2>
                    <p class="text-white/70 font-bold uppercase text-[10px] tracking-[0.4em] mt-1">Spiritual Insight Management</p>
                </div>
                <div class="md:ml-auto">
                    <a href="{{ route('admin.quote.create') }}" class="btn btn-white bg-white/20 hover:bg-white text-white hover:text-primary rounded-2xl border-none shadow-xl px-8 transition-all hover:scale-105">
                        <i class="fa fa-plus-circle mr-2"></i> Ingest New Quote
                    </a>
                </div>
            </div>
        </div>

        {{-- Quote Display Grid/Table --}}
        <div class="glass-card rounded-[2.5rem] overflow-hidden shadow-2xl border border-white/5" data-aos="fade-up">
            <div class="overflow-x-auto">
                <table class="table table-lg w-full">
                    <thead>
                        <tr class="bg-primary/5 text-primary/60 font-black uppercase text-[10px] tracking-[0.2em]">
                            <th class="py-8 pl-10">Data Index</th>
                            <th>Insight Content</th>
                            <th>Source Attribution</th>
                            <th class="text-center pr-10">Administrative Control</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-base-200">
                        @forelse($quotes as $quote)
                            <tr class="hover:bg-primary/5 transition-all group">
                                <td class="py-10 pl-10">
                                    <div class="bg-base-200 text-base-content/40 w-10 h-10 rounded-xl flex items-center justify-center font-black text-xs">
                                        #{{ $loop->iteration + ($quotes->currentPage() - 1) * $quotes->perPage() }}
                                    </div>
                                </td>
                                <td class="py-10">
                                    <div class="max-w-md">
                                        <p class="text-lg font-bold tracking-tight italic opacity-80 group-hover:opacity-100 transition-opacity">
                                            "{{ \Illuminate\Support\Str::limit($quote->text, 100) }}"
                                        </p>
                                    </div>
                                </td>
                                <td>
                                    <div class="flex flex-col">
                                        <span class="badge badge-outline border-primary/20 font-black text-[10px] tracking-widest px-4 py-3 uppercase">
                                            {{ $quote->source ?? 'Anonymous' }}
                                        </span>
                                    </div>
                                </td>
                                <td class="text-center pr-10">
                                    <div class="flex justify-center gap-3">
                                        <a href="{{ route('admin.quote.edit', $quote->id) }}"
                                           class="btn btn-square btn-ghost text-warning hover:bg-warning/10 transition-colors">
                                            <i class="fa-solid fa-pen-to-square text-lg"></i>
                                        </a>
                                        <form action="{{ route('admin.quote.destroy', $quote->id) }}" method="POST"
                                            class="delete-form inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-square btn-ghost text-error hover:bg-error/10 transition-colors">
                                                <i class="fa-solid fa-trash-can text-lg"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="py-32 text-center text-gray-400">
                                    <div class="flex flex-col items-center gap-6 opacity-20">
                                        <i class="fa fa-quote-left text-9xl"></i>
                                        <span class="text-2xl font-black uppercase tracking-[0.4em]">Zero Insights Stored</span>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="p-10 bg-base-200/20">
                {{ $quotes->links() }}
            </div>
        </div>
    </div>
@endsection
