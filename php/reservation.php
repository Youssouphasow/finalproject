<?php

$errorMSG = "";

// Vérifier les champs et assigner les valeurs
if (empty($_POST["name"])) {
    $errorMSG = "Le nom est requis ";
} else {
    $name = $_POST["name"];
}

if (empty($_POST["email"])) {
    $errorMSG .= "L'email est requis ";
} else {
    $email = $_POST["email"];
}

if (empty($_POST["phone"])) {
    $errorMSG .= "Le numéro de téléphone est requis ";
} else {
    $phone = $_POST["phone"];
}

if (empty($_POST["people"])) {
    $errorMSG .= "Le nombre de personnes est requis ";
} else {
    $people = $_POST["people"];
}

if (empty($_POST["date"])) {
    $errorMSG .= "La date de réservation est requise ";
} else {
    $date = $_POST["date"];
}

if (empty($_POST["time"])) {
    $errorMSG .= "L'heure de réservation est requise ";
} else {
    $time = $_POST["time"];
}

// Si pas d'erreurs, insérer dans la base de données
if ($errorMSG == "") {
    $servername = "localhost"; // Remplacez par votre nom de serveur
    $username = "root"; // Remplacez par votre nom d'utilisateur
    $password = ""; // Remplacez par votre mot de passe
    $dbname = "reservations_db"; // Remplacez par votre nom de base de données

    // Créer la connexion
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Vérifier la connexion
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Préparer et lier
    $stmt = $conn->prepare("INSERT INTO reservations (name, email, phone, people, reservation_date, reservation_time) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssiis", $name, $email, $phone, $people, $date, $time);

    // Exécuter la requête
    if ($stmt->execute()) {
        echo "succès";
    } else {
        echo "Erreur: " . $stmt->error;
    }

    // Fermer la connexion
    $stmt->close();
    $conn->close();
} else {
    echo $errorMSG;
}
?>
