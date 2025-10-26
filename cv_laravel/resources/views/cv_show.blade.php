<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>{{ $cv->name }} - CV</title>
    <style>
        body {
            display: flex;
            font-family: Arial, sans-serif;
            margin: 0;
            color: #333;
        }
        .sidebar {
            width: 30%;
            background-color: #222;
            color: #fff;
            padding: 30px;
        }
        .sidebar h2 {
            color: #10b981;
            margin-bottom: 10px;
        }
        .content {
            width: 70%;
            padding: 40px;
            background-color: #f5f5f5;
        }
        .title {
            color: #2563eb;
            font-size: 24px;
            font-weight: bold;
        }
        h3 {
            border-bottom: 2px solid #ddd;
            padding-bottom: 5px;
            margin-top: 30px;
        }
        ul {
            list-style: disc;
            padding-left: 20px;
        }
        .info p { margin: 6px 0; }
        .photo {
            text-align: center;
            margin-bottom: 20px;
        }
        .photo img {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid #10b981;
        }
        .back-btn {
            display: inline-block;
            margin-top: 20px;
            padding: 8px 16px;
            background-color: #10b981;
            color: #fff;
            border-radius: 8px;
            text-decoration: none;
        }
        .back-btn:hover {
            background-color: #059669;
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <div class="photo">
            @if($cv->image_path)
                <img src="{{ asset('storage/' . $cv->image_path) }}" alt="Photo de profil">
            @else
                <img src="{{ asset('default.png') }}" alt="Photo par défaut">
            @endif
        </div>

        <h2>À propos</h2>
        <div class="info">
            <p><strong>Date Naissance :</strong> {{ $cv->birth_date ?? 'Non spécifiée' }}</p>
            <p><strong>État civil :</strong> {{ $cv->etat_civil ?? '—' }}</p>
        </div>

        <h2>Contact</h2>
        <div class="info">
            <p>📞 {{ $cv->phone }}</p>
            <p>✉️ {{ $cv->email }}</p>
            <p>📍 {{ $cv->address ?? 'Non spécifiée' }}</p>
        </div>

        <h3>Langues</h3>
        <ul>
            @foreach($cv->languages as $lang)
                <li>{{ $lang->language }}</li>
            @endforeach
        </ul>

        <h3>Hobbies</h3>
        <ul>
            @foreach($cv->hobbies as $hobby)
                <li>{{ $hobby->hobby }}</li>
            @endforeach
        </ul>


        <a href="{{ route('afficher_cv') }}" class="back-btn">⬅ Retour</a>
    </div>

    <div class="content">
        <div class="title">{{ $cv->name }}</div>
        <p><em>Web Developer</em></p>

        <h3>Éducation</h3>
        <ul>
            @foreach($cv->diplomas as $dip)
                <li>
                    <strong>{{ $dip->start_date }} - {{ $dip->end_date }}</strong><br>
                    {{ $dip->diploma }} - {{ $dip->institution }}
                </li>
            @endforeach
        </ul>

        <h3>Compétences</h3>
        <p>{{ $cv->skills }}</p>

        <h3>Expérience Professionnelle</h3>
        <ul>
            @foreach($cv->experiences as $exp)
                <li>
                    <strong>{{ $exp->job_title }}</strong> - {{ $exp->company }}<br><br> <b>De</b> :{{ $exp->start_date }} <b>à</b> {{ $exp->end_date }}<br>
                    <em>{{ $exp->description }}</em>
                </li>
            @endforeach
        </ul>
    </div>
</body>
</html>
