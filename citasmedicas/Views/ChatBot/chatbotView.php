<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ChatBot EsSalud</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body, html {
            height: 100%;
            margin: 0;
            font-family: Arial, sans-serif;
        }

        .chat-container {
            display: flex;
            flex-direction: column;
            height: 100%;
        }

        .header {
            background-color: #007bff;
            color: white;
            padding: 20px;
            text-align: center;
        }

        .messages-box {
            flex-grow: 1;
            padding: 10px;
            background: white;
            overflow-y: auto;
        }

        .footer {
            padding: 10px;
            background-color: #f0f0f0;
        }

        .input-group {
            width: 100%;
        }
    </style>
</head>
<body>
<div class="chat-container">
    <div class="header">
        ChatBot EsSalud
    </div>
    <div class="messages-box">
        <div class="text-end text-white bg-primary my-1 p-2 rounded">
            Hola, ¿cómo puedo ayudarte hoy?
        </div>
        <!-- Repeat for more messages -->
    </div>
    <div class="footer">
        <div class="input-group">
            <input type="text" class="form-control" placeholder="Escribe un mensaje...">
            <button class="btn btn-primary" type="button">Enviar</button>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
