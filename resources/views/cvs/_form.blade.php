<form action="{{ $action }}" method="POST" enctype="multipart/form-data" class="grid gap-12">
  @csrf
  @if(($method ?? 'POST') === 'PUT') @method('PUT') @endif

  <div class="grid gap-2">
    <label>Title *</label>
    <input type="text" name="title" value="{{ old('title', $cv->title ?? 'My CV') }}" required>
    @error('title') <small style="color:red">{{ $message }}</small> @enderror
  </div>

  <div class="grid gap-2">
    <label>Full name *</label>
    <input type="text" name="full_name" value="{{ old('full_name', $cv->full_name ?? '') }}" required>
  </div>

  <div class="grid gap-2">
    <label>Email *</label>
    <input type="email" name="email" value="{{ old('email', $cv->email ?? '') }}" required>
  </div>

  <div class="grid gap-2">
    <label>Phone</label>
    <input type="text" name="phone" value="{{ old('phone', $cv->phone ?? '') }}">
  </div>

  <div class="grid gap-2">
    <label>Address</label>
    <input type="text" name="address" value="{{ old('address', $cv->address ?? '') }}">
  </div>

  <div class="grid gap-2">
    <label>Role</label>
    <input type="text" name="role" value="{{ old('role', $cv->role ?? '') }}">
  </div>

  <div class="grid gap-2">
    <label>Summary</label>
    <textarea name="summary" rows="4">{{ old('summary', $cv->summary ?? '') }}</textarea>
  </div>

  <div class="grid gap-2">
    <label>Template *</label>
    @php $tpl = old('template', $cv->template ?? 'A'); @endphp
    <select name="template" required>
      <option value="A" @selected($tpl==='A')>Template A</option>
      <option value="B" @selected($tpl==='B')>Template B</option>
    </select>
  </div>

  <div class="grid gap-2">
    <label>Skills (comma separated)</label>
    <input type="text" name="skills" value="{{ old('skills', isset($cv->skills) ? implode(', ', $cv->skills) : '') }}">
  </div>

  <div class="grid gap-2">
    <label>Languages JSON (e.g. [{"name":"Arabic","level":100}])</label>
    <textarea name="languages" rows="3">{{ old('languages', isset($cv->languages)? json_encode($cv->languages) : '') }}</textarea>
  </div>

  <div class="grid gap-2">
    <label>Photo</label>
    <input type="file" name="photo" accept="image/*">
    @if(isset($cv) && $cv->photo_path)
      <img src="{{ asset('storage/'.$cv->photo_path) }}" alt="photo" style="height:80px;width:80px;border-radius:9999px;margin-top:.5rem">
    @endif
  </div>

  <button type="submit" style="padding:.6rem 1rem;background:#2563eb;color:white;border-radius:.5rem">
    {{ ($method ?? 'POST')==='PUT' ? 'Save' : 'Create' }}
  </button>
</form>
