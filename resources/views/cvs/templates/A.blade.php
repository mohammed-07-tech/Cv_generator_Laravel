<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title>{{ $cv->full_name }} — CV</title>
    <style>
        body {
            font-family: system-ui, Arial, sans-serif;
            margin: 24px
        }

        .wrap {
            max-width: 900px;
            margin: auto
        }

        .header {
            display: flex;
            gap: 16px;
            align-items: center
        }

        img.photo {
            width: 96px;
            height: 96px;
            border-radius: 9999px;
            object-fit: cover
        }

        .muted {
            color: #555
        }

        .bar {
            height: 8px;
            background: #eee;
            border-radius: 9999px;
            overflow: hidden
        }

        .bar>span {
            display: block;
            height: 100%
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

    <div class="wrap">
        <div class="header">
            @if($cv->photo_path)
            <img class="photo"
                src="{{ !empty($forPdf)
              ? public_path('storage/'.$cv->photo_path)   
              : asset('storage/'.$cv->photo_path)         
            }}"
                alt="photo">
            @endif

            <div>
                <h1 style="margin:0">{{ $cv->full_name }}</h1>
                <div class="muted">{{ $cv->role }}</div>
                <div class="break muted">{{ $cv->email }} — {{ $cv->phone }}</div>
                <div class="break muted">{{ $cv->address }}</div>
            </div>
        </div>

        @if($cv->summary)<h2>Summary</h2>
        <p>{{ $cv->summary }}</p>@endif
        @if($cv->skills)<h2>Skills</h2>
        <p>{{ implode(' • ', $cv->skills) }}</p>@endif

        @if($cv->languages)
        <h2>Languages</h2>
        @foreach($cv->languages as $lang)
        <div style="margin:8px 0">{{ $lang['name'] ?? '' }}
            <div class="bar"><span style="width:{{ $lang['level'] ?? 0 }}%;background:#3b82f6"></span></div>
        </div>
        @endforeach
        @endif
    </div>
</body>

</html>