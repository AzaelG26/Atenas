<!-- resources/views/emails/password_reset.blade.php -->

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restablecer Contraseña</title>
</head>
<body>
    <h2>Restablece tu contraseña</h2>
    <p>Hemos recibido una solicitud para restablecer tu contraseña. Si no solicitaste este cambio, por favor ignora este correo.</p>
    
    <p>Para restablecer tu contraseña, haz clic en el siguiente enlace:</p>
    
    <!-- El enlace de restablecimiento que recibirá el usuario -->
    <a href="{{ $resetUrl }}">Restablecer Contraseña</a>

    <p>Si no puedes hacer clic en el enlace, por favor copia y pega la siguiente URL en tu navegador:</p>
    <p>{{ $resetUrl }}</p>
</body>
</html>
