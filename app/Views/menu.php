<!-- Barra de navegación -->
<nav class="navbar sticky-top navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">
            <img src="<?= site_url('images/icon.png'); ?>" width="auto" height="30" alt="Indi">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
            <a class="nav-link" aria-current="page" href="#"> <i class="fa fa-home" aria-hidden="true"></i> Inicio</a>
            </li>
            
            <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="fa-solid fa-file-pen"></i> Captación
            </a>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#"><i class="fa fa-file-pen"></i> Captar disciplina estadística</a></li>
                <li><a class="dropdown-item" href="#"><i class="fa fa-edit" aria-hidden="true"></i> Captar datos 2</a></li>
                <li><a class="dropdown-item" href="#"><i class="fa fa-edit" aria-hidden="true"></i> Captar datos 3</a></li>
                <li><a class="dropdown-item" href="#"><i class="fa fa-edit" aria-hidden="true"></i> Captar datos 4</a></li>
                <li><a class="dropdown-item" href="#"><i class="fa fa-edit" aria-hidden="true"></i> Captar datos 5</a></li>
            </ul>
            </li>

            <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fa fa-file-lines" aria-hidden="true"></i> Reportes
            </a>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#"><i class="fa-solid fa-chart-bar"></i> Disciplina estadística</a></li>
                <li><a class="dropdown-item" href="#"><i class="fa fa-calculator" aria-hidden="true"></i> Consolidado</a></li>
            </ul>
            </li>

            <!-- <li class="nav-item">
                <a class="nav-link" href="#"><i class="fa fa-cog" aria-hidden="true"></i> Administración</a>
            </li> -->

            <?php if($userInfo['admin']): ?>

            <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="fa fa-cog" aria-hidden="true"></i> Administración
            </a>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="<?= site_url('users-list'); ?>"><i class="fa-solid fa-users"></i> Gestionar usuarios</a></li>
                <li><a class="dropdown-item" href="<?= site_url('municipios-list'); ?>"><i class="fa-solid fa-location-dot"></i> Municipios</a></li>
                <li><a class="dropdown-item" href="#"><i class="fa-solid fa-table-list"></i> Tipo</a></li>
                <li><a class="dropdown-item" href="#"><i class="fa-solid fa-building"></i> Entidades</a></li>
            </ul>
            </li>

            <?php endif; ?>

            <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fa-solid fa-shield-halved"></i> Seguridad
            </a>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#"><i class="fa fa-key" aria-hidden="true"></i> Cambiar Contraseña</a></li>
            </ul>
            </li>
        </ul>


        <!-- Right links -->
        <ul class="navbar-nav ms-auto d-flex align-items-center">
            <li class="nav-item mx-2 mx-lg-1">
            <a class="nav-link" href="<?= site_url('auth/logout'); ?>"><i class="fa fa-sign-out"></i> Salir</a>
            </li>
            <li class="nav-item mx-2 mx-lg-1">
            <span class="navbar-text">
                <i class="fa-regular fa-user"></i> <?= $userInfo['email']; ?>
            </span>
            </li>
        </ul>
        <!-- Right links -->
        
        </div>
    </div>
</nav>
<!-- Fin de Barra de navegación -->