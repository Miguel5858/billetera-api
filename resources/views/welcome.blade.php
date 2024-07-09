<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kiosko de Comidas</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .header {
            background-color: #f8f9fa;
            text-align: center;
            padding: 50px 0;
        }
        .header img {
            max-width: 200px;
            margin-bottom: 20px;
        }
        .header h1 {
            font-size: 2.5rem;
            color: #343a40;
        }
        .btn-container {
            text-align: center;
            margin-top: 30px;
        }
        .btn-lg {
            font-size: 1.25rem;
            padding: 15px 30px;
            margin: 10px;
        }
    </style>
</head>
<body>

    <!-- Encabezado con imagen y bienvenida -->
    <div class="header">
        <img src="https://via.placeholder.com/200" alt="Logo del Kiosko">
        <h1>Bienvenidos al Kiosko</h1>
    </div>

    <!-- Botones Llevar y Servirse -->
    <div class="container mt-4">
    <div class="row">
      <div class="col-md-6">
        <a href="/kiosko" class="btn btn-success btn-lg btn-block">Para Llevar</a>
      </div>
      <div class="col-md-6">
        <a href="/kiosko" class="btn btn-danger btn-lg btn-block">Para Servir</a>
      </div>
    </div>
  </div>

    <!-- Scripts de Bootstrap -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
