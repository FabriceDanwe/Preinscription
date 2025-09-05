<?php
// Inclure le fichier de configuration de la base de données
require_once 'config/config.php';

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        // Récupérer les données du formulaire
        // État civil
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $date_nais = $_POST['date_nais'];
        $dateprecise = $_POST['dateprecise'];
        $lieu_nais = $_POST['lieu_nais'];
        $sexe = $_POST['sexe'];
        $num_cni = $_POST['num_cni'];
        $adresse_perso = $_POST['adresse_perso'];
        $stat_matri = $_POST['stat_matri'];
        $tel = $_POST['tel'];
        $email = $_POST['email'];
        $langue = $_POST['langue'];
        $sit_prof = $_POST['sit_prof'];
        $profession = $_POST['profession'];
        $lieu_affectation = $_POST['lieu_affectation'];
        $grade = $_POST['grade'];
        $ech = $_POST['ech'];
        
        // Informations de filiation
        $nationality = $_POST['nationality'];
        $region = $_POST['region'];
        $dept_origine = $_POST['dept_origine'];
        $arrondissement_id = $_POST['arrondissement_id'];
        $nom_pere = $_POST['nom_pere'];
        $profession_pere = $_POST['profession_pere'];
        $nom_mere = $_POST['nom_mere'];
        $profession_mere = $_POST['profession_mere'];
        $nom_urgence = $_POST['nom_urgence'];
        $tel_urgence = $_POST['tel_urgence'];
        $ville_urgence = $_POST['ville_urgence'];
        
        // Parcours choisi
        $cycle_id = $_POST['cycle_id'];
        $niveau_id = $_POST['niveau_id'];
        $parcour_id = $_POST['parcour_id'];
        $fill2 = $_POST['fill2'];
        $etab1 = $_POST['etab1'];
        $class1 = $_POST['class1'];
        $etab2 = $_POST['etab2'];
        $class2 = $_POST['class2'];
        $etab3 = $_POST['etab3'];
        $class3 = $_POST['class3'];
        $etab4 = $_POST['etab4'];
        $class4 = $_POST['class4'];
        $etab5 = $_POST['etab5'];
        $class5 = $_POST['class5'];
        
        // Diplômes présentés
        $diplome = $_POST['diplome'];
        $serie = $_POST['serie'];
        $annee_obtention = $_POST['annee_obtention'];
        $moyenne = $_POST['moyenne'];
        $mention = $_POST['mention'];
        $pays_diplome = $_POST['pays_diplome'];
        $dipl_etabl = $_POST['dipl_etabl'];
        $dipl_date_deli = $_POST['dipl_date_deli'];
        $nbre_paper = $_POST['nbre_paper'];
        
        // Informations sportives
       // $sport = isset($_POST['sport']) ? isset($_POST['sport']);
       // $art = isset($_POST['art']) ? implode(",", $_POST['art']) : "";
        $handicap = $_POST['handicap'];
        $num_certifmedical = $_POST['num_certifmedical'];
        $lieu_certifmedical = $_POST['lieu_certifmedical'];
        
        // Information supplémentaires
        $sujet = isset($_POST['sujet']) ? $_POST['sujet'] : "";
        $nom_directeur = isset($_POST['nom_directeur']) ? $_POST['nom_directeur'] : "";
        $grade_directeur = isset($_POST['grade_directeur']) ? $_POST['grade_directeur'] : "";
        $institution_directeur = isset($_POST['institution_directeur']) ? $_POST['institution_directeur'] : "";
        $nom_codirecteur = isset($_POST['nom_codirecteur']) ? $_POST['nom_codirecteur'] : "";
        $grade_codirecteur = isset($_POST['grade_codirecteur']) ? $_POST['grade_codirecteur'] : "";
        $institution_codirecteur = isset($_POST['institution_codirecteur']) ? $_POST['institution_codirecteur'] : "";
        
        // Générer une référence unique
        $reference = 'PRE-' . date('Ymd') . '-' . strtoupper(uniqid());
        
        // Préparer et exécuter la requête SQL
        $sql = "INSERT INTO preinscriptions (
            reference, nom, prenom, date_nais, dateprecise, lieu_nais, sexe, num_cni, 
            adresse_perso, stat_matri, tel, email, langue, sit_prof, profession, 
            lieu_affectation, grade, ech, nationality, region, dept_origine, 
            arrondissement_id, nom_pere, profession_pere, nom_mere, profession_mere, 
            nom_urgence, tel_urgence, ville_urgence, cycle_id, niveau_id, parcour_id, 
            fill2, etab1, class1, etab2, class2, etab3, class3, etab4, class4, 
            etab5, class5, diplome, serie, annee_obtention, moyenne, mention, 
            pays_diplome, dipl_etabl, dipl_date_deli, nbre_paper, sport, art, 
            handicap, num_certifmedical, lieu_certifmedical, sujet, nom_directeur, 
            grade_directeur, institution_directeur, nom_codirecteur, grade_codirecteur, 
            institution_codirecteur, date_creation
        ) VALUES (
            :reference, :nom, :prenom, :date_nais, :dateprecise, :lieu_nais, :sexe, :num_cni, 
            :adresse_perso, :stat_matri, :tel, :email, :langue, :sit_prof, :profession, 
            :lieu_affectation, :grade, :ech, :nationality, :region, :dept_origine, 
            :arrondissement_id, :nom_pere, :profession_pere, :nom_mere, :profession_mere, 
            :nom_urgence, :tel_urgence, :ville_urgence, :cycle_id, :niveau_id, :parcour_id, 
            :fill2, :etab1, :class1, :etab2, :class2, :etab3, :class3, :etab4, :class4, 
            :etab5, :class5, :diplome, :serie, :annee_obtention, :moyenne, :mention, 
            :pays_diplome, :dipl_etabl, :dipl_date_deli, :nbre_paper, :sport, :art, 
            :handicap, :num_certifmedical, :lieu_certifmedical, :sujet, :nom_directeur, 
            :grade_directeur, :institution_directeur, :nom_codirecteur, :grade_codirecteur, 
            :institution_codirecteur, NOW()
        )";
        
        $stmt = $pdo->prepare($sql);
        
        // Liaison des paramètres
        $stmt->bindParam(':reference', $reference);
        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':prenom', $prenom);
        $stmt->bindParam(':date_nais', $date_nais);
        $stmt->bindParam(':dateprecise', $dateprecise);
        $stmt->bindParam(':lieu_nais', $lieu_nais);
        $stmt->bindParam(':sexe', $sexe);
        $stmt->bindParam(':num_cni', $num_cni);
        $stmt->bindParam(':adresse_perso', $adresse_perso);
        $stmt->bindParam(':stat_matri', $stat_matri);
        $stmt->bindParam(':tel', $tel);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':langue', $langue);
        $stmt->bindParam(':sit_prof', $sit_prof);
        $stmt->bindParam(':profession', $profession);
        $stmt->bindParam(':lieu_affectation', $lieu_affectation);
        $stmt->bindParam(':grade', $grade);
        $stmt->bindParam(':ech', $ech);
        $stmt->bindParam(':nationality', $nationality);
        $stmt->bindParam(':region', $region);
        $stmt->bindParam(':dept_origine', $dept_origine);
        $stmt->bindParam(':arrondissement_id', $arrondissement_id);
        $stmt->bindParam(':nom_pere', $nom_pere);
        $stmt->bindParam(':profession_pere', $profession_pere);
        $stmt->bindParam(':nom_mere', $nom_mere);
        $stmt->bindParam(':profession_mere', $profession_mere);
        $stmt->bindParam(':nom_urgence', $nom_urgence);
        $stmt->bindParam(':tel_urgence', $tel_urgence);
        $stmt->bindParam(':ville_urgence', $ville_urgence);
        $stmt->bindParam(':cycle_id', $cycle_id);
        $stmt->bindParam(':niveau_id', $niveau_id);
        $stmt->bindParam(':parcour_id', $parcour_id);
        $stmt->bindParam(':fill2', $fill2);
        $stmt->bindParam(':etab1', $etab1);
        $stmt->bindParam(':class1', $class1);
        $stmt->bindParam(':etab2', $etab2);
        $stmt->bindParam(':class2', $class2);
        $stmt->bindParam(':etab3', $etab3);
        $stmt->bindParam(':class3', $class3);
        $stmt->bindParam(':etab4', $etab4);
        $stmt->bindParam(':class4', $class4);
        $stmt->bindParam(':etab5', $etab5);
        $stmt->bindParam(':class5', $class5);
        $stmt->bindParam(':diplome', $diplome);
        $stmt->bindParam(':serie', $serie);
        $stmt->bindParam(':annee_obtention', $annee_obtention);
        $stmt->bindParam(':moyenne', $moyenne);
        $stmt->bindParam(':mention', $mention);
        $stmt->bindParam(':pays_diplome', $pays_diplome);
        $stmt->bindParam(':dipl_etabl', $dipl_etabl);
        $stmt->bindParam(':dipl_date_deli', $dipl_date_deli);
        $stmt->bindParam(':nbre_paper', $nbre_paper);
        $stmt->bindParam(':sport', $sport);
        $stmt->bindParam(':art', $art);
        $stmt->bindParam(':handicap', $handicap);
        $stmt->bindParam(':num_certifmedical', $num_certifmedical);
        $stmt->bindParam(':lieu_certifmedical', $lieu_certifmedical);
        $stmt->bindParam(':sujet', $sujet);
        $stmt->bindParam(':nom_directeur', $nom_directeur);
        $stmt->bindParam(':grade_directeur', $grade_directeur);
        $stmt->bindParam(':institution_directeur', $institution_directeur);
        $stmt->bindParam(':nom_codirecteur', $nom_codirecteur);
        $stmt->bindParam(':grade_codirecteur', $grade_codirecteur);
        $stmt->bindParam(':institution_codirecteur', $institution_codirecteur);
        
        // Exécution de la requête
        $stmt->execute();
        
        // Redirection vers une page de confirmation
        header("Location: confirmation_preinscriptions.php?ref=" . $reference);
        exit();
        
    } catch (PDOException $e) {
        // En cas d'erreur, afficher le message d'erreur
        die("Erreur lors de l'enregistrement : " . $e->getMessage());
    }
} else {
    // Si le formulaire n'a pas été soumis, rediriger vers la page de préinscription
    header("Location: preinscriptions.php");
    exit();
}
?>