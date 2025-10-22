<?php
// Imposta la directory di destinazione
$target_dir = "main/uploads/"; // Assicurati che questa cartella esista e abbia permessi di scrittura (ad es. chmod 777)
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

// Controlla se il form è stato inviato
if (isset($_POST["submit"])) {

    // 2. Controlla se il file esiste già
    if (file_exists($target_file)) {
        echo "Spiacente, il file esiste già.";
        $uploadOk = 0;
    }

    // 3. Limita la dimensione del file (ad es. 500 KB)
    if ($_FILES["fileToUpload"]["size"] > 500000) {
        echo "Spiacente, il tuo file è troppo grande.";
        $uploadOk = 0;
    }

    // 4. Limita i tipi di file
    if ($imageFileType = "exe" or $imageFileType = "msi") {
        echo "Spiacente, non sono permessi file eseguibili.";
        $uploadOk = 0;
    }

    // 5. Controlla se $uploadOk è ancora a 1
    if ($uploadOk == 0) {
        echo "Spiacente, il tuo file non è stato caricato.";
    // Se tutto è OK, prova a caricare il file
    } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            echo "Il file " . htmlspecialchars(basename($_FILES["fileToUpload"]["name"])) . " è stato caricato.";
        } else {
            echo "Spiacente, c'è stato un errore nel caricamento del tuo file.";
        }
    }
}
?>
