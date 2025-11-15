@extends('layouts.petugas')
@section('title', 'KlikLelang - Masyarakat')

@section('content')
  <div class="masyarakat">
    <x-breadcrumb groupPage="Master Data" currentPage="Masyarakat"></x-breadcrumb>
    <section>
      <x-data-table title="Daftar Masyarakat"
        description="Lorem ipsum dolor sit amet consectetur adipisicing elit. Molestiae, neque!"
        withAdd="{{ route('masyarakat.create') }}" withAddText="Tambah Masyarakat" :rowHeaders="['Nama Lengkap', 'Username', 'Telepon', '']">
        @foreach ($daftarMasyarakat as $masyarakat)
          <x-row>
            <x-cell>
              <p class="default-cell-text" style="color: #667085">{{ $daftarMasyarakat->firstItem() + $loop->index }}</p>
            </x-cell>
            <x-cell>
              <p class="default-cell-text" style="font-weight: 500">{{ $masyarakat->nama_lengkap }}</p>
            </x-cell>
            <x-cell>
              <p class="default-cell-text" style="color: #667085">{{ '@' . $masyarakat->username }}</p>
            </x-cell>
            <x-cell>
              <p class="default-cell-text">{{ $masyarakat->telp }}</p>
            </x-cell>
            <x-cell>
              <div class="masyarakat-actions">
                <x-edit-action to="{{ route('masyarakat.edit', $masyarakat) }}"></x-edit-action>
                <x-delete-action actionTo="{{ route('masyarakat.destroy', $masyarakat) }}"></x-delete-action>
              </div>
            </x-cell>
          </x-row>
        @endforeach
        <x-slot name="footer">
          {{ $daftarMasyarakat->links('components.pagination') }}
        </x-slot>
      </x-data-table>
    </section>
  </div>
@endsection

@push('styles')
  <link rel="stylesheet" href="{{ asset('css/pages/petugas/masyarakat/style.css') }}">
@endpush