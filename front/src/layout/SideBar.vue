<template>
        
        <nav class="sidebar sidebar-offcanvas" id="sidebar">
          <ul class="nav">
            <li class="nav-item nav-profile">
              <a href="#" class="nav-link">
                <div class="nav-profile-image">
                  <img src="@/assets/images/faces/face1.jpg" alt="profile">
                  <span class="login-status online"></span>
                  <!--change to offline or busy as needed-->
                </div>
                <div class="nav-profile-text d-flex flex-column">
                  <span class="font-weight-bold mb-2">David Grey. H</span>
                  <span class="text-secondary text-small">Project Manager</span>
                </div>
                <i class="mdi mdi-bookmark-check text-success nav-profile-badge"></i>
              </a>
            </li>
            <li class="nav-item">

              <router-link to="/" class="nav-link">
                <span class="menu-title">Inicio</span>
                <i class="mdi mdi-home menu-icon"></i>
              </router-link>

            </li>
            <li class="nav-item">
              <router-link to="/usuarios" class="nav-link">
                <span class="menu-title">Empleados</span>
                <i class="mdi mdi-account menu-icon"></i>
              </router-link>
            </li>

            <li class="nav-item">
              <router-link to="/cuentas" class="nav-link">
                <span class="menu-title">Cuentas</span>
                <i class="mdi mdi-credit-card menu-icon"></i>
              </router-link>
            </li>

            <li class="nav-item">
              <router-link to="/pagos" class="nav-link">
                <span class="menu-title">Pagos</span>
                <i class="mdi mdi-credit-card-multiple menu-icon"></i>
              </router-link>
            </li>


            <li class="nav-item">
              <router-link to="/tipopagos" class="nav-link">
                <span class="menu-title">Tipos de pago</span>
                <i class="mdi mdi-contacts menu-icon"></i>
              </router-link>
            </li>

            <li class="nav-item">
              <router-link to="/pagos/reporte" class="nav-link">
                <span class="menu-title">Reporte</span>
                <i class="mdi mdi-file-find menu-icon"></i>
              </router-link>
            </li>


          </ul>
        </nav>

    </template>
