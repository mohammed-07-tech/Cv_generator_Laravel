<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title>{{ $cv->full_name }} — CV</title>
    <style>
        :root {
            --accent: #8b5e3c
        }

        body {
            font-family: system-ui, Arial, sans-serif;
            margin: 0
        }

        .top {
            background: var(--accent);
            color: #fff;
            padding: 24px
        }

        .wrap {
            max-width: 900px;
            margin: auto;
            padding: 24px
        }

        .chip {
            display: inline-block;
            background: #eee;
            color: #333;
            padding: 4px 8px;
            border-radius: 9999px;
            margin: 2px 4px 0 0
        }

        .bar {
            height: 8px;
            background: #eee;
            border-radius: 9999px;
            overflow: hidden
        }

        .bar>span {
            display: block;
            height: 100%;
            background: var(--accent)
        }

        .break {
            overflow-wrap: anywhere;
            word-break: break-word
        }

        @media print {
            div[style*="position:sticky"] {
                display: none !important;
            }
        }
    </style>
</head>

<body>
  {{-- ======= Toolbar at the top ======= --}}
  <div style="
      display:flex;
      justify-content:flex-end;
      gap:10px;
      padding:10px 20px;
      background:#f3f4f6;
      border-bottom:1px solid #ddd;
      position:sticky;
      top:0;
      z-index:1000;">
    <a href="{{ route('cvs.exportPdf', $cv) }}"
       style="padding:6px 12px;background:#111;color:white;border-radius:6px;text-decoration:none">
      ⬇️ Download PDF
    </a>
  </div>
  {{-- ======= End toolbar ======= --}}

    <div class="top">
        <div class="wrap">
            <h1 style="margin:0">{{ $cv->full_name }}</h1>
            <div>{{ $cv->role }}</div>
            <div class="break" style="opacity:.9">{{ $cv->email }} — {{ $cv->phone }} — {{ $cv->address }}</div>
        </div>
    </div>
    <div class="wrap">
        @if($cv->photo_path)
        <img class="photo"
            src="{{ !empty($forPdf)
              ? public_path('storage/'.$cv->photo_path)   // absolute path for DomPDF
              : asset('storage/'.$cv->photo_path)         // URL for browser
            }}"
            alt="photo">
        @endif

        @if($cv->summary)<h2>About me</h2>
        <p>{{ $cv->summary }}</p>@endif
        @if($cv->skills)<h2>Skills</h2>
        <div>@foreach($cv->skills as $s)<span class="chip">{{ $s }}</span>@endforeach</div>@endif
        @if($cv->languages)<h2>Languages</h2>
        @foreach($cv->languages as $lang)
        <div style="margin:8px 0">{{ $lang['name'] ?? '' }}
            <div class="bar"><span style="width:{{ $lang['level'] ?? 0 }}%"></span></div>
        </div>
        @endforeach
        @endif
    </div>
</body>

</html>