<x-app-layout>
  <x-slot name="header"><h2 class="font-semibold text-xl">Edit CV</h2></x-slot>
  <div class="p-6">
    @if(session('ok')) <div class="mb-4 p-2 bg-green-100">{{ session('ok') }}</div> @endif
    @include('cvs._form', ['cv' => $cv, 'action' => route('cvs.update',$cv), 'method' => 'PUT'])
    
  </div>
  <div class="mt-4 flex gap-2">
  <a class="px-4 py-2 bg-purple-600 text-white rounded" href="{{ route('cvs.preview',$cv) }}">
    Preview
  </a>
  <a class="px-4 py-2 bg-gray-800 text-white rounded" href="{{ route('cvs.exportPdf',$cv) }}">
    Download PDF
  </a>
</div>
<div style="display:flex;gap:8px;justify-content:flex-end;margin:12px auto;max-width:900px">
  <button onclick="window.print()" style="padding:.4rem .8rem">Print</button>
  <a href="{{ route('cvs.exportPdf', $cv) }}" style="padding:.45rem .8rem;background:#111;color:#fff;border-radius:.4rem;text-decoration:none">
    Download PDF
  </a>
</div>

</x-app-layout>
