<x-app-layout>
  <x-slot name="header"><h2 class="font-semibold text-xl">My CVs</h2></x-slot>
  <div class="p-6 space-y-4">
    <a href="{{ route('cvs.create') }}" class="px-3 py-2 bg-blue-600 text-white rounded">Create CV</a>
    @forelse($cvs as $cv)
      <div class="p-4 border rounded">
        <div class="font-semibold">{{ $cv->title }}</div>
        <div class="text-sm text-gray-600">{{ $cv->full_name }} — {{ $cv->email }}</div>
        <div class="mt-2 flex gap-3">
          <a class="text-blue-600 underline" href="{{ route('cvs.edit',$cv) }}">Edit</a>
          <a class="text-purple-600 underline" href="{{ route('cvs.preview',$cv) }}">Preview</a>
        </div>
      </div>
    @empty
      <p>No CVs yet.</p>
    @endforelse
  </div>
</x-app-layout>
