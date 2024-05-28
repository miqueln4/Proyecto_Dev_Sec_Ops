<?php

class functions{
// Password encryption function using sha256
function encrypt_password($password) {
    return hash('sha256', $password);
}

public function check_dni($dni) {
    $dni = strtoupper($dni);
    if (preg_match("/^[0-9]{8}[A-Z]$/", $dni)) {
        $number = substr($dni, 0, 8);
        $letter = substr($dni, 8, 1);
        $validLetter = 'TRWAGMYFPDXBNJZSQVHLCKE'[$number % 23];
        return $letter === $validLetter;
    }
    return false;
}

public function validatePassword($password) {
    // Longitud mínima de 8 caracteres
    if (strlen($password) < 8) {
        return false;
    }

    // Al menos una letra mayúscula
    if (!preg_match('/[A-Z]/', $password)) {
        return false;
    }

    // Al menos una letra minúscula
    if (!preg_match('/[a-z]/', $password)) {
        return false;
    }

    // Al menos un número
    if (!preg_match('/[0-9]/', $password)) {
        return false;
    }

    // Al menos un carácter especial
    if (!preg_match('/[\W_]/', $password)) {
        return false;
    }

    return true;
}

// File upload function with extension and magic number check
function upload_file($file, $allowed_extensions, $allowed_magic_numbers) {
    $filename = basename($file['name']);
    $file_extension = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
    $file_size = $file['size'];
    $file_tmp = $file['tmp_name'];
    $file_mime = mime_content_type($file_tmp);

    if (in_array($file_extension, $allowed_extensions) && array_key_exists($file_extension, $allowed_magic_numbers)) {
        $file_magic = bin2hex(file_get_contents($file_tmp, false, null, 0, 4)); // Read first 4 bytes

        if (in_array($file_magic, $allowed_magic_numbers[$file_extension])) {
            // Move the uploaded file to the desired location
            return true;
        }
    }
    return false;
}

function password_verify($password1, $password2){
    if($password1 == $password2){
        return true;
    }else{
        return false;
    }
}

}

