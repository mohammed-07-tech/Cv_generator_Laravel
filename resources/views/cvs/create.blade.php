<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl">Create CV</h2>
  </x-slot>

  <div class="p-6">
    @include('cvs._form', [
      'cv' => null,
      'action' => route('cvs.store'),
      'method' => 'POST'
    ])
  </div>
</x-app-layout>
