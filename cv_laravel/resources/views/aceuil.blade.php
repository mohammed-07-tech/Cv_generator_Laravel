<link rel="stylesheet" href="{{ asset('css/style_aceuille.css') }}">
<div>
  <h1>Bienvenue dans mon site pour la generation des CV</h1>

    <a href="{{ route('index') }}" class="btn-link button">
        <i class="fas fa-plus-circle"></i> Générer CV
    </a>

    <a href="{{ route('afficher_cv') }}" class="btn-link button">
        <i class="fas fa-eye"></i> Afficher CV
    </a>
  
  <!-- <a href="{{route ('afficher_cv') }}" class="">
    <i class="fas fa-eye"></i> Afficher CV
  </a>
  <a href="{{ route('index') }}" class="">
    <i class="fas fa-file-alt"></i> Generer CV
  </a> -->
  <style>
    .button {
      display: inline-block;
      padding: 10px 20px;
      margin: 8px 4px;
      background-color: #007bff;
      color: #fff;
      text-decoration: none;
      border-radius: 4px;
      font-size: 16px;
      transition: background 0.2s;
      border: none;
      cursor: pointer;
    }
    .button:hover {
      background-color: #0056b3;
    }
  </style>
</div>
