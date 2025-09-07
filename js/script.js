// Scripts communs aux deux pages
document.addEventListener('DOMContentLoaded', function() {
    // Effet de vague sur les boutons
    const buttons = document.querySelectorAll('.btn');
    buttons.forEach(btn => {
        btn.addEventListener('mousemove', (e) => {
            const x = e.pageX - btn.offsetLeft;
            const y = e.pageY - btn.offsetTop;
            
            btn.style.setProperty('--x', x + 'px');
            btn.style.setProperty('--y', y + 'px');
        });
    });

    // Gestion des formulaires
    const contactForm = document.getElementById('contactForm');
    if (contactForm) {
        contactForm.addEventListener('submit', function(e) {
            e.preventDefault();
            alert('Votre message a été envoyé avec succès!');
            this.reset();
        });
    }

    // Animation des cartes au scroll
    const cards = document.querySelectorAll('.card, .school-card');
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = 1;
                entry.target.style.transform = 'translateY(0)';
            }
        });
    }, { threshold: 0.1 });

    cards.forEach(card => {
        card.style.opacity = 0;
        card.style.transform = 'translateY(20px)';
        card.style.transition = 'all 0.5s ease';
        observer.observe(card);
    });

    // Scripts spécifiques à index.html
    if (document.getElementById('welcome-title')) {
        // Textes à alterner
        const translations = {
            title: {
                fr: "Bienvenue sur la plateforme de préinscriptions en ligne",
                en: "Welcome to the online pre-registration platform"
            },
            text: {
                fr: "Bienvenue à tous les futurs étudiants de l'Université de Garoua. Cette plateforme innovante a été spécialement conçue pour simplifier et accélérer votre processus d'admission.",
                en: "Welcome to all future students of the University of Garoua. This innovative platform has been specially designed to simplify and speed up your admission process."
            },
            button: {
                fr: "Commencer votre préinscription",
                en: "Start your pre-registration"
            }
        };

        // Éléments du DOM
        const titleElement = document.getElementById('welcome-title');
        const textElement = document.getElementById('welcome-text');
        const buttonElement = document.getElementById('welcome-button');
        
        // Fonction pour basculer entre les langues
        function toggleLanguage() {
            // Ajouter la classe fade-out pour déclencher l'animation
            titleElement.classList.add('fade-transition', 'fade-out');
            textElement.classList.add('fade-transition', 'fade-out');
            buttonElement.classList.add('fade-transition', 'fade-out');
            
            // Après un court délai, changer le texte et faire réapparaître
            setTimeout(() => {
                const currentLang = titleElement.dataset.lang || 'fr';
                const newLang = currentLang === 'fr' ? 'en' : 'fr';
                
                // Mettre à jour les textes
                titleElement.textContent = translations.title[newLang];
                textElement.textContent = translations.text[newLang];
                buttonElement.innerHTML = `<i class="fas fa-arrow-right"></i> ${translations.button[newLang]}`;
                
                // Stocker la langue actuelle
                titleElement.dataset.lang = newLang;
                
                // Faire réapparaître les éléments
                titleElement.classList.remove('fade-out');
                textElement.classList.remove('fade-out');
                buttonElement.classList.remove('fade-out');
                titleElement.classList.add('fade-in');
                textElement.classList.add('fade-in');
                buttonElement.classList.add('fade-in');
                
                // Retirer les classes d'animation après la transition
                setTimeout(() => {
                    titleElement.classList.remove('fade-in', 'fade-transition');
                    textElement.classList.remove('fade-in', 'fade-transition');
                    buttonElement.classList.remove('fade-in', 'fade-transition');
                }, 500);
            }, 500);
        }
        
        // Démarrer l'alternance toutes les 5 secondes
        setInterval(toggleLanguage, 5000);
    }

    // Scripts spécifiques à preinscriptions.html
    if (document.querySelector('.school-card')) {
        // Gestion des clics sur les cartes d'écoles
        document.querySelectorAll('.school-card').forEach(card => {
            card.addEventListener('click', function() {
                const school = this.getAttribute('data-school');
                const schoolName = this.querySelector('h3').textContent + ' - ' + this.querySelector('p').textContent;
                
                // Afficher la page de préinscription
                showPage('preinscription-page');
                
                // Afficher le nom de l'école sélectionnée
                document.getElementById('selected-school').textContent = schoolName;
                
                // Remplir dynamiquement les filières selon l'école choisie
                const filiereSelect = document.getElementById('choix-filiere');
                filiereSelect.innerHTML = '<option value="">Sélectionner une filière</option>';
                
                // Ajouter les filières spécifiques à chaque école
                const filieres = getFilieresBySchool(school);
                filieres.forEach(filiere => {
                    const option = document.createElement('option');
                    option.value = filiere.value;
                    option.textContent = filiere.label;
                    filiereSelect.appendChild(option);
                });
                
                // Faire défiler vers le haut du formulaire
                window.scrollTo({ top: 0, behavior: 'smooth' });
            });
        });
        
        // Fonction pour obtenir les filières par école
        function getFilieresBySchool(school) {
            const filieres = {
                'FSJP': [
                    { value: 'droit_prive', label: 'Droit Privé' },
                    { value: 'droit_public', label: 'Droit Public' },
                    { value: 'science_politique', label: 'Science Politique' }
                ],
                'FSEG': [
                    { value: 'economie', label: 'Économie' },
                    { value: 'gestion', label: 'Gestion' },
                    { value: 'marketing', label: 'Marketing' }
                ],
                'ESSEC': [
                    { value: 'commerce', label: 'Commerce International' },
                    { value: 'finance', label: 'Finance' },
                    { value: 'management', label: 'Management' }
                ],
                'FMSB': [
                    { value: 'medecine', label: 'Médecine' },
                    { value: 'pharmacie', label: 'Pharmacie' },
                    { value: 'biologie', label: 'Biologie Médicale' }
                ],
                'FALSH': [
                    { value: 'lettres', label: 'Lettres Modernes' },
                    { value: 'history', label: 'Histoire' },
                    { value: 'philosophie', label: 'Philosophie' }
                ],
                'FS': [
                    { value: 'maths', label: 'Mathématiques' },
                    { value: 'informatique', label: 'Informatique' },
                    { value: 'physique', label: 'Physique' },
                    { value: 'chimie', label: 'Chimie' },
                    { value: 'biologie', label: 'Biologie des Organismes Vivants' },
                    { value: 'sciences', label: 'Sciences de la terre et de l\'environnement' },
                    { value: 'biochimie', label: 'Biochimie' },
                    { value: 'agriculture', label: 'Agriculture Durable et Gestion des Catastrophes' },
                    { value: 'energie', label: 'Énergie Renouvelable' }
                ],
                'IBAI': [
                    { value: 'arts_plastiques', label: 'Arts Plastiques' },
                    { value: 'design', label: 'Design' },
                    { value: 'multimedia', label: 'Multimédia' }
                ]
            };
            
            return filieres[school] || [];
        }
        
        // Gestion de la navigation entre pages
        function showPage(pageId) {
            document.querySelectorAll('.page').forEach(page => {
                page.classList.remove('active');
            });
            document.getElementById(pageId).classList.add('active');
        }
        
        // Gestion du bouton Retour
        const backBtn = document.getElementById('back-btn');
        if (backBtn) {
            backBtn.addEventListener('click', function() {
                showPage('home-page');
            });
        }
        
        // Gestion du formulaire de préinscription
        const preinscriptionForm = document.getElementById('preinscription-form');
        if (preinscriptionForm) {
            preinscriptionForm.addEventListener('submit', function(e) {
                e.preventDefault();
                
                // Validation du formulaire
                if (!this.checkValidity()) {
                    alert('Veuillez remplir tous les champs obligatoires');
                    return;
                }
                
                // Simulation d'envoi réussi
                alert('Votre préinscription a été soumise avec succès!');
            });
        }
    }
});

// Formulaire de préinscription universitaire
// Gestion du formulaire multi-étapes
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('bigForm');
    if (!form) return;

    const panels = document.querySelectorAll('.multisteps-form__panel');
    const progressButtons = document.querySelectorAll('.multisteps-form__progress-btn');
    const prevButtons = document.querySelectorAll('.js-btn-prev');
    const nextButtons = document.querySelectorAll('.jsBtnNext');
    const submitButton = document.querySelector('[type="submit"]');
    
    let currentStep = 0;

    // Initialisation
    updateForm();

    // Boutons Suivant
    nextButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            const step = parseInt(this.getAttribute('data-id'));
            if (validateStep(currentStep)) {
                currentStep = step;
                updateForm();
            }
        });
    });

    // Boutons Précédent
    prevButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            currentStep--;
            updateForm();
        });
    });

    // Validation du formulaire
    function validateStep(step) {
        let isValid = true;
        const currentPanel = panels[step];
        const requiredInputs = currentPanel.querySelectorAll('[required]');

        requiredInputs.forEach(input => {
            if (!input.value.trim()) {
                isValid = false;
                input.classList.add('is-invalid');
                const errorId = `err_${input.name}`;
                const errorElement = document.getElementById(errorId);
                if (errorElement) {
                    errorElement.classList.remove('d-none');
                    errorElement.textContent = 'Ce champ est obligatoire';
                }
            } else {
                input.classList.remove('is-invalid');
                const errorId = `err_${input.name}`;
                const errorElement = document.getElementById(errorId);
                if (errorElement) errorElement.classList.add('d-none');
            }
        });

        return isValid;
    }

    // Mise à jour de l'affichage du formulaire
    function updateForm() {
        // Masquer tous les panels
        panels.forEach(panel => panel.classList.remove('js-active'));
        
        // Afficher le panel courant
        panels[currentStep].classList.add('js-active');
        
        // Mettre à jour la barre de progression
        progressButtons.forEach((button, index) => {
            if (index < currentStep) {
                button.classList.add('js-active');
                button.disabled = false;
            } else if (index === currentStep) {
                button.classList.add('js-active');
                button.disabled = true;
            } else {
                button.classList.remove('js-active');
                button.disabled = true;
            }
        });
        
        // Gérer l'affichage des boutons
        const prevButtons = document.querySelectorAll('.js-btn-prev');
        const nextButtons = document.querySelectorAll('.jsBtnNext');
        
        prevButtons.forEach(button => {
            button.style.display = currentStep === 0 ? 'none' : 'block';
        });
        
        nextButtons.forEach(button => {
            button.style.display = currentStep === panels.length - 1 ? 'none' : 'block';
        });
        
        if (submitButton) {
            submitButton.style.display = currentStep === panels.length - 1 ? 'block' : 'none';
        }
    }

    // Gestion des dépendances entre champs
    const paysSelect = document.getElementById('pays');
    const regionSelect = document.getElementById('region');
    const departementSelect = document.getElementById('departement');
    const arrondissementSelect = document.getElementById('arrondissement');
    
    if (paysSelect && regionSelect && departementSelect && arrondissementSelect) {
        paysSelect.addEventListener('change', function() {
            updateRegions(this.value);
        });
        
        regionSelect.addEventListener('change', function() {
            updateDepartements(this.value);
        });
        
        departementSelect.addEventListener('change', function() {
            updateArrondissements(this.value);
        });
    }
    
    function updateRegions(paysId) {
        // Ici vous feriez normalement un appel AJAX pour récupérer les régions
        // Pour l'exemple, nous simulons des données
        regionSelect.innerHTML = '<option value="">---------</option>';
        
        if (paysId === '1') { // Cameroun
            const regions = [
                {id: 1, name: 'Adamaoua'},
                {id: 2, name: 'Centre'},
                {id: 3, name: 'Est'},
                {id: 4, name: 'Extrême-Nord'},
                {id: 5, name: 'Littoral'},
                {id: 6, name: 'Nord'},
                {id: 7, name: 'Nord-Ouest'},
                {id: 8, name: 'Ouest'},
                {id: 9, name: 'Sud'},
                {id: 10, name: 'Sud-Ouest'}
            ];
            
            regions.forEach(region => {
                const option = document.createElement('option');
                option.value = region.id;
                option.textContent = region.name;
                regionSelect.appendChild(option);
            });
        } else {
            const option = document.createElement('option');
            option.value = '999';
            option.textContent = 'Etranger';
            regionSelect.appendChild(option);
        }
    }
    
    function updateDepartements(regionId) {
        // Simuler la récupération des départements
        departementSelect.innerHTML = '<option value="">---------</option>';
        
        if (regionId === '2') { // Centre
            const departements = [
                {id: 1, name: 'Mfoundi'},
                {id: 2, name: 'Lekié'},
                {id: 3, name: 'Mbam-et-Inoubou'},
                {id: 4, name: 'Mbam-et-Kim'},
                {id: 5, name: 'Méfou-et-Afamba'},
                {id: 6, name: 'Méfou-et-Akono'},
                {id: 7, name: 'Mfoundi'},
                {id: 8, name: 'Nyong-et-Kéllé'},
                {id: 9, name: 'Nyong-et-Mfoumou'},
                {id: 10, name: 'Nyong-et-So\'o'}
            ];
            
            departements.forEach(dept => {
                const option = document.createElement('option');
                option.value = dept.id;
                option.textContent = dept.name;
                departementSelect.appendChild(option);
            });
        } else if (regionId === '999') {
            const option = document.createElement('option');
            option.value = '999';
            option.textContent = 'Etranger';
            departementSelect.appendChild(option);
        }
    }
    
    function updateArrondissements(departementId) {
        // Simuler la récupération des arrondissements
        arrondissementSelect.innerHTML = '<option value="">---------</option>';
        
        if (departementId === '1') { // Mfoundi
            const arrondissements = [
                {id: 1, name: 'Yaoundé I'},
                {id: 2, name: 'Yaoundé II'},
                {id: 3, name: 'Yaoundé III'},
                {id: 4, name: 'Yaoundé IV'},
                {id: 5, name: 'Yaoundé V'},
                {id: 6, name: 'Yaoundé VI'},
                {id: 7, name: 'Yaoundé VII'}
            ];
            
            arrondissements.forEach(arr => {
                const option = document.createElement('option');
                option.value = arr.id;
                option.textContent = arr.name;
                arrondissementSelect.appendChild(option);
            });
        } else if (departementId === '999') {
            const option = document.createElement('option');
            option.value = '999';
            option.textContent = 'Etranger';
            arrondissementSelect.appendChild(option);
        }
    }
    
    // Gestion du diplôme sélectionné
    const diplomeSelect = document.getElementById('id_diplome');
    const serieSelect = document.getElementById('id_serie');
    const nbrePaperDiv = document.getElementById('div_id_nbre_paper');
    
    if (diplomeSelect && serieSelect && nbrePaperDiv) {
        diplomeSelect.addEventListener('change', function() {
            if (this.value === 'GCE A LEVEL') {
                nbrePaperDiv.style.display = 'block';
            } else {
                nbrePaperDiv.style.display = 'none';
            }
        });
    }
    
    // Gestion du cycle sélectionné
    const cycleSelect = document.getElementById('cycle');
    const niveauSelect = document.getElementById('niveau');
    const filiere1Select = document.getElementById('fill1');
    const filiere2Select = document.getElementById('fill2');
    
    if (cycleSelect && niveauSelect && filiere1Select && filiere2Select) {
        cycleSelect.addEventListener('change', function() {
            updateNiveaux(this.value);
        });
        
        function updateNiveaux(cycleId) {
            niveauSelect.innerHTML = '<option value="">---------</option>';
            
            if (cycleId === '1') { // Licence
                const niveaux = [
                    {id: 1, name: 'Niveau 1'},
                    {id: 2, name: 'Niveau 2'},
                    {id: 3, name: 'Niveau 3'}
                ];
                
                niveaux.forEach(niveau => {
                    const option = document.createElement('option');
                    option.value = niveau.id;
                    option.textContent = niveau.name;
                    niveauSelect.appendChild(option);
                });
            } else if (cycleId === '2') { // Master
                const niveaux = [
                    {id: 4, name: 'Niveau 4'},
                    {id: 5, name: 'Niveau 5'}
                ];
                
                niveaux.forEach(niveau => {
                    const option = document.createElement('option');
                    option.value = niveau.id;
                    option.textContent = niveau.name;
                    niveauSelect.appendChild(option);
                });
            }
            
            updateFilieres();
        }
        
        function updateFilieres() {
            filiere1Select.innerHTML = '<option value="">---------</option>';
            filiere2Select.innerHTML = '<option value="">---------</option>';
            
            // Simuler des filières selon la faculté
            const filieres = [
                {id: 1, name: 'Droit Privé'},
                {id: 2, name: 'Droit Public'},
                {id: 3, name: 'Science Politique'},
                {id: 4, name: 'Économie'},
                {id: 5, name: 'Gestion'},
                {id: 6, name: 'Informatique'},
                {id: 6, name: 'Mathematique'},
                {id: 6, name: 'physique'},
                {id: 6, name: 'chimie'},
                {id: 6, name: 'biologie'},
                {id: 6, name: 'energie renouvelable'},
            ];
            
            filieres.forEach(filiere => {
                const option1 = document.createElement('option');
                option1.value = filiere.id;
                option1.textContent = filiere.name;
                filiere1Select.appendChild(option1);
                
                const option2 = document.createElement('option');
                option2.value = filiere.id;
                option2.textContent = filiere.name;
                filiere2Select.appendChild(option2);
            });
        }
    }
    
    // Validation du formulaire avant soumission
    form.addEventListener('submit', function(e) {
        if (!validateStep(currentStep)) {
            e.preventDefault();
            return false;
        }
        
        // Ici vous pourriez ajouter une confirmation avant soumission
        const confirmation = confirm('Voulez-vous vraiment soumettre votre préinscription ?');
        if (!confirmation) {
            e.preventDefault();
            return false;
        }
        
        return true;
    });
});

//AJOUT


document.addEventListener('DOMContentLoaded', function() {
            // Sélectionner toutes les cartes d'écoles
            const schoolCards = document.querySelectorAll('.school-card');
            
            // Sélectionner l'élément où afficher le nom de l'école
            const selectedSchoolElement = document.getElementById('selected-school');
            
            // Ajouter un écouteur d'événement à chaque carte
            schoolCards.forEach(card => {
                card.addEventListener('click', function() {
                    // Récupérer le nom et le code de l'école
                    const schoolName = this.getAttribute('data-name');
                    const schoolCode = this.getAttribute('data-school');
                    
                    // Afficher le nom dans le formulaire
                    selectedSchoolElement.textContent = `Établissement sélectionné : ${schoolName}`;
                    
                    // Stocker l'école sélectionnée dans le formulaire
                    document.getElementById('faculte_id').value = schoolCode;
                    
                    // Afficher le formulaire de préinscription
                    document.getElementById('home-page').classList.remove('active');
                    document.getElementById('preinscription-page').classList.add('active');
                    
                    // Scroll vers le formulaire
                    document.getElementById('preinscription-page').scrollIntoView({ behavior: 'smooth' });
                });
            });
        });
