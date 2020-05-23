<?php

$folder = __DIR__ . "/uploads";

if (!file_exists($folder) || !is_dir($folder)) {
    mkdir($folder, 0755);
}


$getPost = filter_input(INPUT_GET, "post", FILTER_VALIDATE_BOOLEAN);


if ($_FILES && !empty($_FILES['file']['name'])) {
    $fileUpload = $_FILES['file'];
    var_dump($fileUpload);

    $allowebTypes = [
        "image/jpg",
        "image/jpeg",
        "image/png",
        "application/pdf"
    ];

    $newFilename = time() . mb_strstr($fileUpload['name'], ".");

    if (in_array($fileUpload['type'], $allowebTypes)) {
        if (move_uploaded_file($fileUpload['tmp_name'], __DIR__ . "/uploads/{$newFilename}")) {
            echo "<p class='trigger accept'>Arquivo enviado com sucesso</p>";
        } else {
            echo "<p class='trigger error'>Erro inesperado!</p>";
        }
    } else {
        echo "<p class='trigger error'>Arquivo não permitido</p>";
    }

} elseif ($getPost) {
    echo "<p class='trigger warning'>whoops arquivo é muito grande</p>";
} else {
    if ($_FILES) {
        echo "<p class='trigger warning'>Selecione um arquivo antes de enviar</p>";
    }

}

include __DIR__ . "/form.php";
var_dump(scandir(__DIR__ . "/uploads"));