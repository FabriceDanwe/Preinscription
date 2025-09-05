<?php
require_once 'config/config.php';

if (!isset($_GET['ref'])) {
    header("Location: preinscriptions.php");
    exit();
}

$reference = $_GET['ref'];

try {
    $sql = "SELECT * FROM preinscriptions WHERE reference = :reference";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':reference', $reference);
    $stmt->execute();
    $preinscription = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if (!$preinscription) {
        header("Location: preinscriptions.php");
        exit();
    }
} catch (PDOException $e) {
    die("Erreur : " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fiche de Préinscription | Université de Garoua</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* Styles pour l'impression */
        @media print {
            body * {
                visibility: hidden;
            }
            .printable-area, .printable-area * {
                visibility: visible;
            }
            .printable-area {
                position: absolute;
                left: 0;
                top: 0;
                width: 100%;
            }
            .no-print {
                display: none !important;
            }
        }
        
        /* Styles généraux */
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
        }
        .fiche-container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            border: 1px solid #ddd;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .header-fiche {
            text-align: center;
            margin-bottom: 20px;
            border-bottom: 2px solid #003366;
            padding-bottom: 10px;
        }
        .header-fiche img {
            height: 80px;
        }
        .section {
            margin-bottom: 20px;
            page-break-inside: avoid;
        }
        .section-title {
            background-color: #003366;
            color: white;
            padding: 5px 10px;
            margin-bottom: 10px;
        }
        .info-row {
            display: flex;
            margin-bottom: 5px;
        }
        .info-label {
            font-weight: bold;
            width: 40%;
        }
        .info-value {
            width: 60%;
        }
        .actions {
            margin-top: 30px;
            text-align: center;
        }
        .btn {
            padding: 8px 15px;
            margin: 0 5px;
            cursor: pointer;
            border: none;
            border-radius: 4px;
        }
        .btn-print {
            background-color: #003366;
            color: white;
        }
        .btn-back {
            background-color: #6c757d;
            color: white;
        }
    </style>
</head>
<body>
    <div class="fiche-container">
        <!-- Zone imprimable -->
        <div class="printable-area">
            <div class="header-fiche">
                <img src="images/logo.png" alt="Logo Université">
                <h2>Université de Garoua</h2>
                <h3>Fiche de Préinscription</h3>
                <p>Référence: <strong><?= htmlspecialchars($preinscription['reference']) ?></strong></p>
                <p>Date: <?= date('d/m/Y H:i', strtotime($preinscription['date_creation'])) ?></p>
            </div>
            
            <!-- État Civil -->
            <div class="section">
                <div class="section-title">I. ÉTAT CIVIL</div>
                <div class="info-row">
                    <div class="info-label">Nom(s):</div>
                    <div class="info-value"><?= htmlspecialchars($preinscription['nom']) ?></div>
                </div>
                <div class="info-row">
                    <div class="info-label">Prénom(s):</div>
                    <div class="info-value"><?= htmlspecialchars($preinscription['prenom']) ?></div>
                </div>
                <div class="info-row">
                    <div class="info-label">Date de naissance:</div>
                    <div class="info-value"><?= date('d/m/Y', strtotime($preinscription['date_nais'])) ?></div>
                </div>
                <div class="info-row">
                    <div class="info-label">Lieu de naissance:</div>
                    <div class="info-value"><?= htmlspecialchars($preinscription['lieu_nais']) ?></div>
                </div>
                <div class="info-row">
                    <div class="info-label">Sexe:</div>
                    <div class="info-value"><?= $preinscription['sexe'] === 'M' ? 'Masculin' : 'Féminin' ?></div>
                </div>
                <div class="info-row">
                    <div class="info-label">CNI:</div>
                    <div class="info-value"><?= htmlspecialchars($preinscription['num_cni']) ?: 'Non renseigné' ?></div>
                </div>
                <div class="info-row">
                    <div class="info-label">Adresse:</div>
                    <div class="info-value"><?= htmlspecialchars($preinscription['adresse_perso']) ?></div>
                </div>
                <div class="info-row">
                    <div class="info-label">Téléphone:</div>
                    <div class="info-value"><?= htmlspecialchars($preinscription['tel']) ?></div>
                </div>
                <div class="info-row">
                    <div class="info-label">Email:</div>
                    <div class="info-value"><?= htmlspecialchars($preinscription['email']) ?: 'Non renseigné' ?></div>
                </div>
            </div>
            
            <!-- Filiation -->
            <div class="section">
                <div class="section-title">II. INFORMATIONS DE FILIATION</div>
                <div class="info-row">
                    <div class="info-label">Nationalité:</div>
                    <div class="info-value"><?= htmlspecialchars($preinscription['nationality']) ?></div>
                </div>
                <div class="info-row">
                    <div class="info-label">Région d'origine:</div>
                    <div class="info-value"><?= htmlspecialchars($preinscription['region']) ?></div>
                </div>
                <div class="info-row">
                    <div class="info-label">Nom de la mère:</div>
                    <div class="info-value"><?= htmlspecialchars($preinscription['nom_mere']) ?></div>
                </div>
                <div class="info-row">
                    <div class="info-label">Profession de la mère:</div>
                    <div class="info-value"><?= htmlspecialchars($preinscription['profession_mere']) ?></div>
                </div>
                <div class="info-row">
                    <div class="info-label">Personne à contacter:</div>
                    <div class="info-value"><?= htmlspecialchars($preinscription['nom_urgence']) ?></div>
                </div>
                <div class="info-row">
                    <div class="info-label">Téléphone urgence:</div>
                    <div class="info-value"><?= htmlspecialchars($preinscription['tel_urgence']) ?></div>
                </div>
            </div>
            
            <!-- Parcours choisi -->
            <div class="section">
                <div class="section-title">III. PARCOURS CHOISI</div>
                <div class="info-row">
                    <div class="info-label">Cycle:</div>
                    <div class="info-value">
                        <?php
                        $cycles = [
                            '1' => 'Licence',
                            '2' => 'Master',
                            '4' => 'Licence Professionnelle',
                            '5' => 'Master Professionnel'
                        ];
                        echo $cycles[$preinscription['cycle_id']] ?? 'Non spécifié';
                        ?>
                    </div>
                </div>
                <div class="info-row">
                    <div class="info-label">Premier choix:</div>
                    <div class="info-value"><?= htmlspecialchars($preinscription['parcour_id']) ?></div>
                </div>
                <div class="info-row">
                    <div class="info-label">Second choix:</div>
                    <div class="info-value"><?= htmlspecialchars($preinscription['fill2']) ?></div>
                </div>
            </div>
            
            <!-- Diplômes -->
            <div class="section">
                <div class="section-title">IV. DIPLÔMES PRÉSENTÉS</div>
                <div class="info-row">
                    <div class="info-label">Diplôme:</div>
                    <div class="info-value"><?= htmlspecialchars($preinscription['diplome']) ?></div>
                </div>
                <div class="info-row">
                    <div class="info-label">Série:</div>
                    <div class="info-value"><?= htmlspecialchars($preinscription['serie']) ?: 'Non spécifiée' ?></div>
                </div>
                <div class="info-row">
                    <div class="info-label">Année d'obtention:</div>
                    <div class="info-value"><?= htmlspecialchars($preinscription['annee_obtention']) ?></div>
                </div>
                <div class="info-row">
                    <div class="info-label">Mention:</div>
                    <div class="info-value"><?= htmlspecialchars($preinscription['mention']) ?></div>
                </div>
                <div class="info-row">
                    <div class="info-label">Établissement émetteur:</div>
                    <div class="info-value"><?= htmlspecialchars($preinscription['dipl_etabl']) ?></div>
                </div>
            </div>
            
            <div class="section">
                <div class="section-title">INSTRUCTIONS</div>
                <p>1. Présentez cette fiche avec les pièces suivantes :</p>
                <ul>
                    <li>Acte de naissance</li>
                    <li>Photocopie du diplôme</li>
                    <li>4 photos d'identité</li>
                    <li>Reçu de paiement</li>
                </ul>
                <p>2. Date limite de dépôt : 30 septembre 2024</p>
                <p>3. Lieu de dépôt : Secrétariat de la faculté choisie</p>
            </div>
        </div>
        
        <!-- Boutons d'action (non imprimés) -->
        <div class="actions no-print">
            <button onclick="window.print()" class="btn btn-print">
                <i class="fas fa-print"></i> Imprimer la fiche
            </button>
            <a href="preinscriptions.php" class="btn btn-back">
                <i class="fas fa-arrow-left"></i> Retour
            </a>
        </div>
    </div>
</body>
</html>