<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cuenta desactivada</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        .title{
            color: #43878F;
            text-align: center;
        }
        .button {
            background-color: #000000;
            color: white;
            text-decoration: none;
            padding: 12px 30px;
            border-radius: 5px;
            font-size: 16px;
            text-align: center;
        }
        .body-content{
            text-align: center;
        }
    </style>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f8f9fa; padding: 20px;">
    <div class="title">
        <img id="logo-atenas" style="cursor:-webkit-grabbing; margin-bottom:30px;" width="120px" src="{{ asset('LOGO_ATENAS_high_quality_transparent.png') }}" alt="logo_atenas">
        <h1>Atenas Food</h1>
        <hr style="border: none; border-bottom: 3px solid rgb(196, 196, 0);">        
    </div>

    <div class="body-content">
        <h2 style="color:#43878F;">Hola {{ $user->name }}</h2>
        <p style="font-size: 16px; color: #333;">
            Queremos informarte que tu cuenta ha sido <strong style="color: #e74c3c;">desactivada</strong>.
        </p>
        <br>
        <p>
            <a class="button btn" href="{{ route('account.activate', ['userId' => $user->id]) }}" style="padding: 10px 20px; color:white; text-decoration: none; border-radius: 5px;">
                Activar cuenta
            </a>
        </p>
        <p style="font-size: 14px; color: #666;">
            Gracias por confiar en nuestros servicios.<br>
            El equipo de {{ config('app.name') }}
        </p>
    </div>
</body>
</html>
