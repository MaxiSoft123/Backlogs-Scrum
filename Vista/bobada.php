<?php

// Función para encriptar una Contrasena
function encriptarContrasena($Contrasena, $ClaveEncriptacion) {
    $Iv = random_bytes(16); // Generar un vector de inicialización aleatorio
    $ContrasenaEncriptada = openssl_encrypt($Contrasena, 'AES-256-CBC', $ClaveEncriptacion, OPENSSL_RAW_DATA, $Iv);
    $DatosEncriptados = base64_encode($Iv . $ContrasenaEncriptada);
    return $DatosEncriptados;
}

// Función para desencriptar una Contrasena
function desencriptarContrasena($DatosEncriptados, $ClaveEncriptacion) {
    $DatosDecodificados = base64_decode($DatosEncriptados);
    $Iv = substr($DatosDecodificados, 0, 16);
    $ContrasenaEncriptada = substr($DatosDecodificados, 16);
    $Contrasena = openssl_decrypt($ContrasenaEncriptada, 'AES-256-CBC', $ClaveEncriptacion, OPENSSL_RAW_DATA, $Iv);
    return $Contrasena;
}

// Ejemplo de uso:
$ClaveEncriptacion = random_bytes(32); // Generar una clave aleatoria de 32 bytes
$ClaveBase64 = base64_encode($ClaveEncriptacion); // Convertir la clave a una cadena base64
$ClaveEncriptacion = base64_decode($ClaveBase64); // Convertir la clave base64 a bytes
$ContrasenaEncriptada = 'sLV1AzzS0VJF4zow88yLt0KCLxxkLnh4F0Uo/UjkGs8=';
$ContrasenaDesencriptada = desencriptarContrasena($ContrasenaEncriptada, $ClaveEncriptacion);

echo $ContrasenaEncriptada . " " . $ContrasenaDesencriptada;
