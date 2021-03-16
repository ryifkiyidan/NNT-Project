<!-- <div class="container-fluid p-0">
    <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top">
        <a class="navbar-brand" href="<?php echo base_url('index.php/page/dashboard'); ?>"><i class="fad fa-head-side-virus fa-2x"></i> V-Learning</a>
        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div id="navbar" class="collapse navbar-collapse">
            <div class="navbar-nav">

                <a class="nav-item nav-link" href="<?php echo base_url('index.php/page/dashboard'); ?>" id = "nav-dashboard" >Dashboard</a>
            
                <?php
              
                ?>
            
                <a class="nav-item nav-link" href="<?php echo base_url('index.php/page/lesson'); ?>" id = "nav-lesson" >Lesson</a>
                <a class="nav-item nav-link" href="<?php echo base_url('index.php/page/quiz'); ?>" id = "nav-quiz" >Quiz</a>
                <a class="nav-item nav-link" href="<?php echo base_url('index.php/page/profile'); ?>" id = "nav-profile" >Profile</a>
            
            </div>
            
            <div class="navbar-nav ml-auto">
                <a class="nav-item nav-link" href="<?php echo base_url('index.php/auth/logout'); ?>" id = "nav-logout" >Logout</a>
            </div>

        </div>
        
    </nav>
</div> -->

<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-dark sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">NNT ADMIN</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="<?php echo base_url('index.php/page/dashboard'); ?>">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        CRUD Tables
    </div>

    <!-- Nav Item Company -->
    <li class="nav-item">
        <a class="nav-link" href="<?php echo base_url('index.php/page/company'); ?>">
            <i class="fas fa-fw fa-building"></i>
            <span>Perusahaan</span></a>
    </li>

    <!-- Nav Item CusReqSize -->
    <li class="nav-item">
        <a class="nav-link" href="<?php echo base_url('index.php/page/cusreqsize'); ?>">
            <i class="fas fa-fw fa-ruler-triangle"></i>
            <span>Pengukuran</span></a>
    </li>

    <!-- Nav Item Product -->
    <li class="nav-item">
        <a class="nav-link" href="charts.html">
            <i class="fas fa-fw fa-tshirt"></i>
            <span>Produk</span></a>
    </li>

    <!-- Nav Item Fabric -->
    <li class="nav-item">
        <a class="nav-link" href="charts.html">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Bahan Kain</span></a>
    </li>

    <!-- Nav Item PurchaseOrder -->
    <li class="nav-item">
        <a class="nav-link" href="charts.html">
            <i class="fas fa-fw fa-shopping-basket"></i>
            <span>Pesanan Pembelian</span></a>
    </li>

    <!-- Nav Item Delivery Order -->
    <li class="nav-item">
        <a class="nav-link" href="charts.html">
            <i class="fas fa-fw fa-truck"></i>
            <span>Surat Jalan</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Status
    </div>

    <!-- Nav Item - Charts -->
    <li class="nav-item">
        <a class="nav-link" href="charts.html">
            <i class="fas fa-fw fa-clock"></i>
            <span>Pending</span></a>
    </li>

    <!-- Nav Item - Tables -->
    <li class="nav-item">
        <a class="nav-link" href="tables.html">
            <i class="fas fa-fw fa-truck-loading"></i>
            <span>Delivered</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->