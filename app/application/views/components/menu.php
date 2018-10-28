<ul class="sidebar navbar-nav">
        <li class="nav-item active">
          <a class="nav-link" href="<?=BASE_URL?>">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
          </a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-fw fa-folder"></i>
            <span>Pages</span>
          </a>
          <div class="dropdown-menu" aria-labelledby="pagesDropdown">
            <h6 class="dropdown-header">Data:</h6>
            <a class="dropdown-item" href="<?=BASE_URL?>book">Books</a>
            <div class="dropdown-divider"></div>
            <h6 class="dropdown-header">Master Data:</h6>
            <a class="dropdown-item" href="<?=BASE_URL?>author">Author</a>
            <a class="dropdown-item" href="<?=BASE_URL?>type">Type</a>
            <!-- <a class="dropdown-item" href="forgot-password.html">Forgot Password</a> -->
            <div class="dropdown-divider"></div>
            <h6 class="dropdown-header">User:</h6>
            <a class="dropdown-item" href="<?=BASE_URL?>logout">Logout</a>
            <!-- <a class="dropdown-item" href="blank.html">Blank Page</a> -->
          </div>
        </li>
        <!-- <li class="nav-item">
          <a class="nav-link" href="charts.html">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Charts</span></a>
        </li> -->
        <!-- <li class="nav-item">
          <a class="nav-link" href="tables.html">
            <i class="fas fa-fw fa-table"></i>
            <span>Tables</span></a>
        </li> -->
      </ul>