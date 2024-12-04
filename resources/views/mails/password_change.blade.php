<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restablecer Contraseña</title>
    <style>
        *{
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        p{
            color: black;
        }
        .title{
            color: #43878F;
            text-align: center;
        }
        .name_user{
            color: #43878F;
            text-decoration: underline;
        }
        .body-content{
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

        .button:active {
            background-color: #a8a8a8;
        }
        .footer{
            margin-top: 60px;
            height: 50px;
            font-size: 13px;
            text-align: center;
            background: #43878F;
            color: white;
        }
        
    </style>
</head>

<body>          
    <div class="title">
        <img id="logo-atenas" style="cursor:-webkit-grabbing; margin-bottom:30px;" width="120px" src="{{ asset('LOGO_ATENAS_high_quality_transparent.png') }}" alt="logo_atenas">
        <h1>Atenas Food</h1>
        <hr style="border: none; border-bottom: 3px solid rgb(196, 196, 0);">        
    </div>

    <div class="body-content">
        <h3 style="color: black;">Hola <strong class="name_user">{{$user->name}}</strong></h3>
        <br>
        <p>Hemos recibido tu solicitud para restablecer tu contraseña.</p>

        <p>Para restablecer tu contraseña, haz clic en el siguiente botón:</p>
        <br>
        <br>
        <!-- El enlace de restablecimiento que recibirá el usuario -->
        <a href="{{ $resetUrl }}" class="button"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-lock-fill"
            viewBox="0 0 16 16">
            <path
                d="M8 1a2 2 0 0 1 2 2v4H6V3a2 2 0 0 1 2-2m3 6V3a3 3 0 0 0-6 0v4a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2" />
        </svg> &nbsp;Restablecer Contraseña</a>

        <div class="footer">
            <p>*Si no solicitaste este cambio, por favor ignora este correo.*</p>
        </div>
    </div>
    

</body>

</html>