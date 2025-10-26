<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CvData;
use App\Models\Diploma;
use App\Models\Experience;
use App\Models\Language;
use App\Models\Hobby;

class CvController extends Controller
{
    // 🔹 عرض جميع الـCVs
    public function afficher()
    {
        $cvs = CvData::all();
        return view('afficher_cv', compact('cvs'));
    }

    // 🔹 عرض CV واحد بالتفاصيل
    public function show($id)
    {
        $cv = CvData::with(['diplomas', 'experiences', 'languages', 'hobbies'])->findOrFail($id);
        return view('cv_show', compact('cv'));
    }

    // 🔹 الصفحة الرئيسية
    public function index()
    {
        return view('index');
    }

    // 🔹 صفحة accueil
    public function acceuil()
    {
        return view('aceuil');
    }

    // 🔹 تخزين بيانات الـCV
    public function store(Request $request)
    {
        // ✅ 1. Validation des champs
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required|string|max:15',
            'about' => 'nullable|string',
            'skills' => 'nullable|string',
            'theme' => 'nullable|string',
            'langs' => 'nullable|array',
            'hobbies' => 'nullable|array',
            'lienImage' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // ✅ 2. Upload image
        $imagePath = null;
        if ($request->hasFile('lienImage')) {
            $imagePath = $request->file('lienImage')->store('uploads', 'public');
        }

        // ✅ 3. Enregistrer CV principal
        $cv = CvData::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'about' => $request->about,
            'skills' => $request->skills,
            'image_path' => $imagePath,
            'theme' => $request->theme,
        ]);

        // ✅ 4. Diplômes
        if ($request->has('diploma')) {
            foreach ($request->diploma as $i => $diplome) {
                Diploma::create([
                    'cv_id' => $cv->id,
                    'diploma' => $diplome,
                    'institution' => $request->institution[$i] ?? '',
                    'start_date' => $request->diplomaStartDate[$i] ?? null,
                    'end_date' => $request->diplomaEndDate[$i] ?? null,
                ]);
            }
        }

        // ✅ 5. Expériences
        if ($request->has('jobTitle')) {
            foreach ($request->jobTitle as $i => $job) {
                Experience::create([
                    'cv_id' => $cv->id,
                    'job_title' => $job,
                    'company' => $request->company[$i] ?? '',
                    'start_date' => $request->expStartDate[$i] ?? null,
                    'end_date' => $request->expEndDate[$i] ?? null,
                    'description' => $request->jobDescription[$i] ?? '',
                ]);
            }
        }

        // ✅ 6. Langues
        if ($request->has('langs')) {
            foreach ($request->langs as $lang) {
                if (!empty($lang)) {
                    Language::create([
                        'cv_id' => $cv->id,
                        'language' => $lang,
                    ]);
                }
            }
        }

        // ✅ 7. Hobbies
        if ($request->has('hobbies')) {
            foreach ($request->hobbies as $hobby) {
                if (!empty($hobby)) {
                    Hobby::create([
                        'cv_id' => $cv->id,
                        'hobby' => $hobby,
                    ]);
                }
            }
        }

        // ✅ 8. Redirection après succès
        return redirect()->route('cv.success')->with('message', 'CV enregistré avec succès !');
    }
}
