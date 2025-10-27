<?php

namespace App\Http\Controllers;

use App\Models\Cv;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Str;



class CvController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $cvs = Cv::where('user_id', Auth::id())->latest()->get();
        return view('cvs.index', compact('cvs'));
    }

    public function create()
    {
        return view('cvs.create');
    }

    public function store(Request $request)
    {
        $data = $this->validateCv($request);

        if ($request->hasFile('photo')) {
            $data['photo_path'] = $request->file('photo')->store('cv-photos', 'public');
        }

        $data['user_id'] = Auth::id();
        $data = $this->normalizeArrays($data);

        $cv = Cv::create($data);

        return redirect()->route('cvs.edit', $cv)->with('ok', 'CV created');
    }

    public function edit(Cv $cv)
    {
        $this->authorize('view', $cv);
        return view('cvs.edit', compact('cv'));
    }

    public function update(Request $request, Cv $cv)
    {
        $this->authorize('update', $cv);

        $data = $this->validateCv($request);

        if ($request->hasFile('photo')) {
            $data['photo_path'] = $request->file('photo')->store('cv-photos', 'public');
        }

        $data = $this->normalizeArrays($data);

        $cv->update($data);

        return back()->with('ok', 'Saved');
    }

    public function show(Cv $cv)
    {
        $this->authorize('view', $cv);
        return view('cvs.show', compact('cv'));
    }

    public function preview(Cv $cv)
    {
        $this->authorize('view', $cv);
        return view('cvs.templates.' . $cv->template, compact('cv'));
    }

    private function validateCv(Request $request): array
    {
        return $request->validate([
            'title'     => ['required', 'string', 'max:100'],
            'full_name' => ['required', 'string', 'max:120'],
            'email'     => ['required', 'email'],
            'phone'     => ['nullable', 'string', 'max:50'],
            'address'   => ['nullable', 'string', 'max:255'],
            'role'      => ['nullable', 'string', 'max:120'],
            'summary'   => ['nullable', 'string', 'max:2000'],
            'template'  => ['required', 'in:A,B'],
            'education' => ['nullable'],
            'experience' => ['nullable'],
            'skills'    => ['nullable'],
            'languages' => ['nullable'],
            'projects'  => ['nullable'],
            'links'     => ['nullable'],
            'photo'     => ['nullable', 'image', 'max:2048'],
        ]);
    }

    private function normalizeArrays(array $data): array
    {
        foreach (['education', 'experience', 'skills', 'languages', 'projects', 'links'] as $k) {
            if (!array_key_exists($k, $data) || $data[$k] === null || $data[$k] === '') {
                $data[$k] = null;
                continue;
            }
            if (is_string($data[$k])) {
                $decoded = json_decode($data[$k], true);
                if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                    $data[$k] = $decoded;
                } else {
                    if ($k === 'skills') {
                        $data[$k] = array_values(array_filter(
                            array_map('trim', explode(',', $data[$k])),
                            fn($v) => $v !== ''
                        ));
                    } else {
                        $data[$k] = [$data[$k]];
                    }
                }
            }
        }
        return $data;
    }

    public function exportPdf(Cv $cv)
    {
        $this->authorize('view', $cv);

        // Render the same Blade as preview, but tell it we’re making a PDF
        $html = view('cvs.templates.' . $cv->template, [
            'cv' => $cv,
            'forPdf' => true,    // flag to load absolute image paths
        ])->render();

        $pdf = Pdf::loadHTML($html)->setPaper('a4', 'portrait');

        return $pdf->download(Str::slug($cv->full_name . '-' . $cv->title) . '.pdf');
    }
}
