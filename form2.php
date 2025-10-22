<?php
$target_dir = "uploads/"; // Cartella dove salvare il file
$target_file = $target_dir . basename($_FILES["nome_file"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// Controlla se il file è un'immagine o un documento
if(isset($_POST["submit"])) {
    // Controlla la dimensione del file
    if ($_FILES["nome_file"]["size"] > 500000) { // esempio: 500 KB
        echo "Spiacenti, il tuo file è troppo grande.";
        $uploadOk = 0;
    }

    // Permetti solo alcuni tipi di file (es. JPG, PNG, GIF)
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
        echo "Spiacenti, sono consentiti solo file JPG, JPEG, PNG e GIF.";
        $uploadOk = 0;
    }
}

// Controlla se $uploadOk è stato impostato a 0 da un errore
if ($uploadOk == 0) {
    echo "Spiacenti, il tuo file non è stato caricato.";
// Se tutto è corretto, prova a caricare il file
} else {
    // Crea la cartella se non esiste
    if (!file_exists($target_dir)) {
        mkdir($target_dir, 0777, true);
    }

    // Sposta il file caricato nella cartella di destinazione
    if (move_uploaded_file($_FILES["nome_file"]["tmp_name"], $target_file)) {
        echo "Il file ". htmlspecialchars( basename( $_FILES["nome_file"]["name"])). " è stato caricato.";
    } else {
        echo "Spiacenti, si è verificato un errore durante il caricamento del tuo file.";
    }
}
?>
