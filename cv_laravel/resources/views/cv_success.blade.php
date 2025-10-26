<!doctype html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>CV Enregistré</title>
  <style>
    body {
      background: linear-gradient(135deg, #1e3a8a, #0f172a);
      color: white;
      font-family: Arial, sans-serif;
      display: flex;
      align-items: center;
      justify-content: center;
      height: 100vh;
      margin: 0;
    }
    .card {
      background: rgba(255, 255, 255, 0.1);
      padding: 40px;
      border-radius: 12px;
      text-align: center;
      box-shadow: 0 0 20px rgba(0,0,0,0.3);
      max-width: 400px;
    }
    .card h1 { margin-bottom: 15px; color: #10b981; }
    .card a {
      display: inline-block;
      margin-top: 20px;
      padding: 10px 20px;
      background: #10b981;
      color: #0f172a;
      border-radius: 8px;
      text-decoration: none;
      font-weight: bold;
    }
    .card a:hover {
      background: #34d399;
    }
  </style>
</head>
<body>
  <div class="card">
    <h1>{{ session('message') }}</h1>
    <p>Ton CV a été sauvegardé avec succès</p>
    <a href="{{ route('afficher_cv') }}">Voir les CV</a>
  </div>
</body>
</html>
