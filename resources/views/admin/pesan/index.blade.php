@extends('layouts.app')

@section('header', 'Communication Hub')

@section('content')
    <div class="space-y-8" data-aos="fade-up">
        {{-- Header & Total Stats --}}
        <div class="glass-card rounded-[2.5rem] p-8 futuristic-bg text-white relative overflow-hidden group">
            <div class="absolute inset-0 bg-black/10"></div>
            <div class="relative z-10 flex flex-col md:flex-row items-center gap-6">
                <div class="p-5 bg-white/20 backdrop-blur-xl rounded-3xl border border-white/30 group-hover:scale-110 transition-transform duration-500">
                    <i class="fa fa-envelope-open-text text-4xl"></i>
                </div>
                <div>
                    <h2 class="text-3xl font-black tracking-tighter">Pusat Pesan & Saran</h2>
                    <p class="text-white/70 font-bold uppercase text-[10px] tracking-[0.4em] mt-1">Inbound Data Transmission Protocol</p>
                </div>
                <div class="md:ml-auto flex items-center gap-6">
                    <div class="text-right">
                        <span class="block text-[10px] font-black uppercase tracking-widest text-white/40">Total Packets</span>
                        <span class="text-3xl font-black tracking-tighter">{{ $pesanSaran->total() }}</span>
                    </div>
                </div>
            </div>
        </div>

        {{-- Main Inbox Table --}}
        <form id="bulkDeleteForm" action="{{ route('admin.pesan.bulkDelete') }}" method="POST">
            @csrf
            @method('DELETE')

            <div class="glass-card rounded-[2.5rem] overflow-hidden shadow-2xl border border-white/5" x-data="{ selectedCount: 0 }">
                {{-- Bulk Action Bar --}}
                <div class="p-6 bg-primary/5 flex items-center justify-between border-b border-white/5">
                    <div class="flex items-center gap-4">
                        <input type="checkbox" id="selectAll" class="checkbox checkbox-primary checkbox-sm rounded-lg border-2" @change="selectedCount = $el.checked ? {{ count($pesanSaran) }} : 0">
                        <span class="text-[10px] font-black uppercase tracking-widest opacity-40">Batch Operations</span>
                    </div>
                    <button type="submit" id="deleteSelectedBtn"
                            class="btn btn-error btn-sm rounded-xl font-black text-[10px] tracking-widest uppercase hidden group"
                            onclick="return confirm('Wipe selected transmissions from memory?')">
                        <i class="fa fa-trash-can mr-2 group-hover:animate-bounce"></i> Purge Selected
                    </button>
                </div>

                <div class="overflow-x-auto">
                    <table class="table table-lg w-full">
                        <thead>
                            <tr class="text-primary/60 font-black uppercase text-[10px] tracking-[0.2em] border-b border-white/5">
                                <th class="w-16"></th>
                                <th class="py-6 pl-10">Subject Source</th>
                                <th>Transmission Payload</th>
                                <th>Response Status</th>
                                <th class="text-center pr-10">Control</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-base-200">
                            @forelse ($pesanSaran as $pesan)
                                <tr class="hover:bg-primary/5 transition-all group">
                                    <td class="text-center">
                                        <input type="checkbox" name="ids[]" value="{{ $pesan->id }}" class="selectItem checkbox checkbox-primary checkbox-sm rounded-lg border-2">
                                    </td>
                                    <td class="py-8 pl-10">
                                        <div class="flex items-center gap-4">
                                            <div class="w-10 h-10 rounded-full bg-primary/10 flex items-center justify-center font-black text-primary border border-primary/20">
                                                {{ substr($pesan->user->name, 0, 1) }}
                                            </div>
                                            <div>
                                                <div class="font-black tracking-tight text-lg">{{ $pesan->user->name }}</div>
                                                <div class="text-[9px] font-black uppercase tracking-widest opacity-30">User Node ID: #{{ $pesan->user->id }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="max-w-xs">
                                        <p class="text-sm font-medium opacity-70 line-clamp-2 italic">
                                            "{{ $pesan->pesan }}"
                                        </p>
                                    </td>
                                    <td>
                                        @if ($pesan->feedback)
                                            <div class="flex flex-col gap-1">
                                                <span class="badge badge-success badge-outline font-black text-[9px] tracking-widest px-3 py-2 uppercase">Protocol Responded</span>
                                                <span class="text-[9px] font-black uppercase opacity-30 ml-1">
                                                    {{ $pesan->dibalas_pada->format('d.m.Y // H:i') }}
                                                </span>
                                            </div>
                                        @else
                                            <span class="badge badge-error badge-outline font-black text-[9px] tracking-widest px-3 py-2 uppercase animate-pulse">Awaiting Input</span>
                                        @endif
                                    </td>
                                    <td class="text-center pr-10">
                                        <div class="flex justify-center gap-2">
                                            <a href="{{ route('admin.pesan.edit', $pesan->id) }}"
                                               class="btn btn-square btn-ghost text-primary hover:bg-primary/10">
                                                <i class="fa-solid fa-reply-all text-lg"></i>
                                            </a>
                                            <form action="{{ route('admin.pesan.destroy', $pesan->id) }}" method="POST"
                                                  class="delete-form inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-square btn-ghost text-error hover:bg-error/10"
                                                        onclick="return confirm('Erase transmission record?')">
                                                    <i class="fa-solid fa-trash-can text-lg"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="py-32 text-center opacity-20">
                                        <div class="flex flex-col items-center gap-6">
                                            <i class="fa fa-shuttle-space text-9xl"></i>
                                            <span class="text-2xl font-black uppercase tracking-[0.4em]">Zero Inbound Signals</span>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="p-10 bg-base-200/20">
                    {{ $pesanSaran->links() }}
                </div>
            </div>
        </form>
    </div>

    <script>
        const selectAll = document.getElementById('selectAll');
        const checkboxes = document.querySelectorAll('.selectItem');
        const deleteBtn = document.getElementById('deleteSelectedBtn');

        selectAll.addEventListener('change', function() {
            checkboxes.forEach(cb => cb.checked = selectAll.checked);
            toggleDeleteButton();
        });

        checkboxes.forEach(cb => {
            cb.addEventListener('change', toggleDeleteButton);
        });

        function toggleDeleteButton() {
            const checkedCount = document.querySelectorAll('.selectItem:checked').length;
            deleteBtn.classList.toggle('hidden', checkedCount === 0);
        }
    </script>
@endsection
