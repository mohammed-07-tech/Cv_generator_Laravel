<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Générateur de CV</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <form action="{{ route('save_cv') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-container">
            <h1>Remplir votre informations</h1>

            <label>Nom complet</label>
            <input type="text" id="name" name="name" required>

            <label>Email</label>
            <input type="email" id="email" name="email" required>

            <label>Téléphone</label>
            <input type="tel" maxlength="10" pattern="[0-9]{10}" required id="phone" name="phone">

            <label>À propos</label>
            <textarea id="about" name="about"></textarea>

            <!-- Langues -->
            <div class="section-title">Langues</div>
            <div id="langContainer">
                <div class="dynamic-item">
                    <input type="text" name="langs[]" placeholder="Ex: Français, Anglais">
                </div>
            </div>
            <button type="button" class="add-btn" onclick="addLang()">+ Ajouter Langue</button>

            <!-- Hobbies -->
            <div class="section-title">Hobbies</div>
            <div id="hobbyContainer">
                <div class="dynamic-item">
                    <input type="text" name="hobbies[]" placeholder="Ex: Lecture, Sport">
                </div>
            </div>
            <button type="button" class="add-btn" onclick="addHobby()">+ Ajouter Hobby</button>


            <!-- <label>Langues</label>
            <input type="text" id="langs" name="langs">

            <label>Hobbies</label>
            <input type="text" id="hobbies" name="hobbies"> -->
            
            <div class="section-title">Formation</div>
            <div id="diplomaContainer">
                <div class="dynamic-item">
                    <div class="form-row">
                        <div class="form-group">
                            <label>Diplôme</label>
                            <input type="text" name="diploma[]">
                        </div>
                        <div class="form-group">
                            <label>Institution</label>
                            <input type="text" name="institution[]">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label>Date début</label>
                            <input type="date" name="diplomaStartDate[]">
                        </div>
                        <div class="form-group">
                            <label>Date fin</label>
                            <input type="date" name="diplomaEndDate[]">
                        </div>
                    </div>
                </div>
            </div>
            <button type="button" class="add-btn" onclick="addDiploma()">+ Ajouter Diplôme</button>

            <div class="section-title">Expérience Professionnelle</div>
            <div id="experienceContainer">
                <div class="dynamic-item">
                    <div class="form-row">
                        <div class="form-group">
                            <label>Poste (Job Title)</label>
                            <input type="text" name="jobTitle[]">
                        </div>
                        <div class="form-group">
                            <label>Entreprise</label>
                            <input type="text" name="company[]">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label>Date début</label>
                            <input type="date" name="expStartDate[]">
                        </div>
                        <div class="form-group">
                            <label>Date fin</label>
                            <input type="date" name="expEndDate[]">
                        </div>
                    </div>
                    <label>Description</label>
                    <textarea name="jobDescription[]"></textarea>
                </div>
            </div>
            <button type="button" class="add-btn" onclick="addExperience()">+ Ajouter Expérience</button>

            <label>Compétences</label>
            <input type="text" id="skills" name="skills">

            <label>Image</label>
            <input type="file" id="lienImage" name="lienImage" accept="image/*">

            <!-- <div class="theme-selection">
                <div class="theme-title">Choisissez votre thème</div>
                <div class="themes-container">
                    <div class="theme-option" data-theme="theme1" onclick="selectTheme('theme1')">
                        <img src="Capture d'écran 2025-09-22 192052.png" alt="Thème Bleu" class="theme-preview active">
                        <div class="theme-label">Thème Bleu</div>
                    </div>
                    <div class="theme-option" data-theme="theme2" onclick="selectTheme('theme2')">
                        <img src="Capture d'écran 2025-09-24 164830.png" alt="Thème Brown" class="theme-preview">
                        <div class="theme-label">Thème Blanc-cassé</div>
                    </div>
                </div>
            </div> -->
            
            <button type="submit">Enregistrer</button>
        </div>
    </form>

    <script src="{{ asset('js/script.js') }}"></script>
</body>
</html>
