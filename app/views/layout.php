<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>
    <!-- CDN bootstrap css -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <!-- Navegación -->
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <span class="navbar-brand mb-0 h1">Cafetería</span>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
              <div class="navbar-nav">
                <!-- <a class="nav-link active" aria-current="page" href="#">Home</a> -->
                <a class="nav-link" href="index.php?action=venta">Ventas</a>
                <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Productos
                  </a>
                  <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="index.php?action=index">Lista</a></li>
                    <li><a class="dropdown-item" href="index.php?action=create">Crear</a></li>
                  </ul>
                </li>
              </div>
            </div>
        </div>
    </nav>

    <!-- Contenido -->
    <div class="container mt-4 p-5 card"> 
      <!-- Mostrar mensajes de error o éxito -->
      <?php if (isset($_SESSION['error'])): ?>
          <div class="alert alert-danger">
              <?php echo $_SESSION['error']; unset($_SESSION['error']); ?>
          </div>
      <?php endif; ?>
      <?php if (isset($_SESSION['success'])): ?>
          <div class="alert alert-success">
              <?php echo $_SESSION['success']; unset($_SESSION['success']); ?>
          </div>
      <?php endif; ?>
      <!-- Contenido dinamico -->
      <?php echo $content; ?>
    </div>
    <!-- CDN bootstrap js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>