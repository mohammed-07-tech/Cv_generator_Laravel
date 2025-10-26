<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Liste des CV</title>
  <link rel="stylesheet" href="{{ asset('style.css') }}">
  <style>
    table {
        width: 90%;
        margin: 20px auto;
        border-collapse: collapse;
    }
    th, td {
        border: 1px solid #ddd;
        padding: 10px;
        text-align: left;
    }
    th {
        background-color: #000000ff;
    }
    h2 {
        text-align: center;
        margin-top: 30px;
    }
    .center {
        text-align: center;
        margin: 20px;
    }
    #a{
      display: inline-block;
      margin-top: 20px;
      padding: 10px 20px;
      background: #10b981;
      color: #0f172a;
      border-radius: 8px;
      text-decoration: none;
      font-weight: bold;
    }
    #a:hover {
      background: #237a5aff;
    }
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
  </style>
</head>
<body>
<div class="card">
  <h2>Liste des CV enregistrés</h2>

  <table>
    <tr>
      <th>ID</th>
      <th>Nom</th>
      <th>Email</th>
      <th>Téléphone</th>
      <!-- <th>Compétences</th>
      <th>Loisirs</th> -->
      <th>cv</th>
    </tr>

    @forelse($cvs as $cv)
      <tr>
        <td>{{ $cv->id }}</td>
        <td>{{ $cv->name }}</td>
        <td>{{ $cv->email }}</td>
        <td>{{ $cv->phone }}</td>
        <!-- <td>{{ $cv->skills }}</td>
        <td>{{ $cv->hobbies }}</td> -->
        <td>
          <a href="{{ route('cv.show', $cv->id) }}" 
            style="background-color:#237a5aff; height:25px; width: 80px; 
                    border:none; border-radius:8px; color:black; text-decoration:none;
                    display:inline-block; text-align:center; line-height:25px;"> Voir CV
          </a>
        </td>
      </tr>
    @empty
      <tr>
        <td colspan="6" style="text-align:center;">Aucun CV trouvé</td>
      </tr>
    @endforelse
  </table>

  <a id="a" href="{{ route('index') }}">⬅ Ajouter un nouveau CV</a>
  <!-- <div class="center">
    
  </div> -->
</div>
</body>
</html>
