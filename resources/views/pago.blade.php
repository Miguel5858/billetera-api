<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Carrito de Compras</title>
  <!-- Bootstrap CSS -->
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <style>
    .card {
      margin-bottom: 20px;
    }
    .product-img {
      width: 50px;
      height: 50px;
      border-radius: 50%;
      object-fit: cover;
    }
  </style>
</head>
<body>
  <div class="container">
  
      <!-- Agrega más productos aquí -->
    
    <hr>
    <h2>Carrito de Compras</h2>
    <div id="shopping-cart">
      <table class="table">
        <thead>
          <tr>
            <th>Producto</th>
            <th>Precio</th>
            <th>Cantidad</th>
            <th>Total</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>
              <img src="https://via.placeholder.com/150" class="product-img" alt="Producto 1">
              Producto 1
            </td>
            <td>$10</td>
            <td>1</td>
            <td>$10</td>
            <td><button class='delete-item btn btn-danger' data-name='Producto 1'>Eliminar</button></td>
          </tr>
          <tr>
            <td>
              <img src="https://via.placeholder.com/150" class="product-img" alt="Producto 2">
              Producto 2
            </td>
            <td>$15</td>
            <td>1</td>
            <td>$15</td>
            <td><button class='delete-item btn btn-danger' data-name='Producto 2'>Eliminar</button></td>
          </tr>
          <!-- Más productos pueden agregarse aquí -->
        </tbody>
      </table>
      <h3>Total: <span id="total">25</span></h3>
      <a id="btn-pay" href="/" class="btn btn-success btn-lg btn-block">Pagar</a>
    </div>
  </div>

  <!-- Bootstrap JS y jQuery -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
