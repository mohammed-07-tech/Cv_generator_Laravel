function afficherCV() {
  // Logique pour afficher le CV
  window.location.href = "cv.html"; // Redirige vers la page du CV
}

function genererCV() {
  // Logique pour générer le CV
  window.location.href = "formulaire.html"; // Redirige vers la page du formulaire
}

let selectedTheme = 'theme1'; // Default theme

function selectTheme(theme) {
    selectedTheme = theme;
    
    // Remove active class from all previews
    document.querySelectorAll('.theme-preview').forEach(img => {
        img.classList.remove('active');
    });
    
    // Add active class to selected preview
    document.querySelector(`[data-theme="${theme}"] .theme-preview`).classList.add('active');
}



function addDiploma() {
            const container = document.getElementById('diplomaContainer');
            const newDiploma = document.createElement('div');
            newDiploma.className = 'dynamic-item';
            newDiploma.innerHTML = `
                <button type="button" class="remove-btn" onclick="removeElement(this.parentElement)">Supprimer</button>
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
            `;
            container.appendChild(newDiploma);
}

        function addExperience() {
            const container = document.getElementById('experienceContainer');
            const newExperience = document.createElement('div');
            newExperience.className = 'dynamic-item';
            newExperience.innerHTML = `
                <button type="button" class="remove-btn" onclick="removeElement(this.parentElement)">Supprimer</button>
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
            `;
            container.appendChild(newExperience);
        }

        function removeElement(element) {
            element.remove();
        }

        function generate() {
            // Get basic info
            const name = document.getElementById('name').value;
            const email = document.getElementById('email').value;
            const phone = document.getElementById('phone').value;
            const about = document.getElementById('about').value;
            const langs = document.getElementById('langs').value;
            const hobbies = document.getElementById('hobbies').value;
            const skills = document.getElementById('skills').value;
            const fileInput = document.getElementById('lienImage');

            if (!email.endsWith("@gmail.com")) {
                alert("⚠️ L'email doit se terminer par @gmail.com");
                return;
            }
            if(phone.length<10){
                alert("⚠️ Le numéro de téléphone doit contenir 10 chiffres.");
                return;
            }
            


            // Get diploma data
            const diplomas = [];
            const diplomaInputs = document.querySelectorAll('input[name="diploma[]"]');
            const institutionInputs = document.querySelectorAll('input[name="institution[]"]');
            const diplomaStartInputs = document.querySelectorAll('input[name="diplomaStartDate[]"]');
            const diplomaEndInputs = document.querySelectorAll('input[name="diplomaEndDate[]"]');

            for (let i = 0; i < diplomaInputs.length; i++) {
                const start = diplomaStartInputs[i].value;
                const end = diplomaEndInputs[i].value;
                if (new Date(start) > new Date(end)) {
                    alert("⚠️ Date début doit être avant date fin !");
                    return;
                }
          
                if (diplomaInputs[i].value.trim()) {
                    diplomas.push({
                        diploma: diplomaInputs[i].value,
                        institution: institutionInputs[i].value,
                        startDate: diplomaStartInputs[i].value,
                        endDate: diplomaEndInputs[i].value
                    });
                }
            }
            
            diplomaInputs.forEach((input,i) =>{
                if(input.value.trim()){
                    diplomas.push({
                        diploma: input.value,
                        institution: institutionInputs[i].value,
                        startDate: diplomaStartInputs[i].value,
                        endDate: diplomaEndInputs[i].value
                });
                }

            });



            // Get experience data
            const experiences = [];
            const jobTitleInputs = document.querySelectorAll('input[name="jobTitle[]"]');
            const companyInputs = document.querySelectorAll('input[name="company[]"]');
            const expStartInputs = document.querySelectorAll('input[name="expStartDate[]"]');
            const expEndInputs = document.querySelectorAll('input[name="expEndDate[]"]');
            const jobDescInputs = document.querySelectorAll('textarea[name="jobDescription[]"]');

            for (let i = 0; i < jobTitleInputs.length; i++) {
                if (jobTitleInputs[i].value.trim()) {
                    experiences.push({
                        jobTitle: jobTitleInputs[i].value,
                        company: companyInputs[i].value,
                        startDate: expStartInputs[i].value,
                        endDate: expEndInputs[i].value,
                        description: jobDescInputs[i].value
                    });
                }
            }

            if (fileInput.files && fileInput.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const formData = {
                        name, email, phone, about, langs, hobbies, skills,
                        diplomas, experiences,
                        theme: selectedTheme,
                        imgLien: e.target.result
                    };
                    localStorage.setItem("cvData", JSON.stringify(formData));
                    window.location.href = "cv.html";
                };
                reader.readAsDataURL(fileInput.files[0]);
            } else {
                const formData = {
                    name, email, phone, about, langs, hobbies, skills,
                    diplomas, experiences,
                    theme: selectedTheme
                };
                localStorage.setItem("cvData", JSON.stringify(formData));
                window.location.href = "cv.html";
            }
        }


        function addLang() {
            const container = document.getElementById('langContainer');
            const div = document.createElement('div');
            div.classList.add('dynamic-item');
            div.innerHTML = `<button type="button" class="remove-btn" onclick="removeElement(this.parentElement)">Supprimer</button><br>
            <input type="text" name="langs[]" placeholder="Nouvelle langue">`;
            container.appendChild(div);
        }

        function addHobby() {
            const container = document.getElementById('hobbyContainer');
            const div = document.createElement('div');
            div.classList.add('dynamic-item');
            div.innerHTML = `<button type="button" class="remove-btn" onclick="removeElement(this.parentElement)">Supprimer</button><br>
            <input type="text" name="hobbies[]" placeholder="Nouveau hobby">`;
            container.appendChild(div);
        }

         