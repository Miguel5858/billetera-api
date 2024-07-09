<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Kiosko de Comidas</title>
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <style>
    /* Personaliza estilos adicionales aquí */
    .category-button {
      background-color: #007bff;
      color: white;
      border: none;
      border-radius: 20px;
      padding: 10px 20px;
      margin: 5px;
      font-size: 16px;
    }

    .category-button:hover {
      background-color: #0056b3;
    }
  </style>
</head>
<body>

  <!-- Sección de Categorías -->
  <div class="container mt-4">
    <h2 class="text-center">Categorías</h2>
    <div class="row justify-content-center">
      <div class="col-auto">
        <button class="btn category-button">Categoría 1</button>
      </div>
      <div class="col-auto">
        <button class="btn category-button">Categoría 2</button>
      </div>
      <div class="col-auto">
        <button class="btn category-button">Categoría 3</button>
      </div>
      <!-- Agregar más botones de categoría según sea necesario -->
    </div>
  </div>

  <!-- Sección de Menú -->
  <div class="container mt-4">
    <h2 class="text-center">Menú</h2>
    <div class="row">
      <div class="col-md-3">
        <div class="card mb-3">
          <img src="https://via.placeholder.com/150" class="card-img-top" alt="...">
          <div class="card-body">
            <h5 class="card-title">Producto 1</h5>
            <p class="card-text">Descripción del producto 1.</p>
            <a href="#" class="btn btn-primary btn-block">Agregar al carrito</a>
          </div>
        </div>
      </div>
      <div class="col-md-3">
        <div class="card mb-3">
          <img src="https://via.placeholder.com/150" class="card-img-top" alt="...">
          <div class="card-body">
            <h5 class="card-title">Producto 2</h5>
            <p class="card-text">Descripción del producto 2.</p>
            <a href="#" class="btn btn-primary btn-block">Agregar al carrito</a>
          </div>
        </div>
      </div>
      <div class="col-md-3">
        <div class="card mb-3">
          <img src="https://via.placeholder.com/150" class="card-img-top" alt="...">
          <div class="card-body">
            <h5 class="card-title">Producto 3</h5>
            <p class="card-text">Descripción del producto 3.</p>
            <a href="#" class="btn btn-primary btn-block">Agregar al carrito</a>
          </div>
        </div>
      </div>

      <div class="col-md-3">
        <div class="card mb-3">
          <img src="https://via.placeholder.com/150" class="card-img-top" alt="...">
          <div class="card-body">
            <h5 class="card-title">Producto 3</h5>
            <p class="card-text">Descripción del producto 3.</p>
            <a href="#" class="btn btn-primary btn-block">Agregar al carrito</a>
          </div>
        </div>
      </div>
      <!-- Repite esta estructura para mostrar las otras tres tarjetas -->
    </div>
  </div>

  <!-- Botones para llevar y para servir -->
  <div class="container mt-4">
    <div class="row">
      <div class="col-md-12">
        <a href="/pago" class="btn btn-success btn-lg btn-block">Terminar compra</a>
      </div>
     
    </div>
  </div>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
