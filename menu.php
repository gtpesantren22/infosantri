<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">INFO SANTRI<sup> </sup></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="index.php">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Data Santri
    </div>

    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePagessa" aria-expanded="true" aria-controls="collapsePages">
            <i class="fas fa-fw fa-folder"></i>
            <span>Data Santri</span>
        </a>
        <div id="collapsePagessa" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Putra & Putri</h6>
                <a class="collapse-item" href="santri.php?jk=Laki-laki">Putra</a>
                <a class="collapse-item" href="santri.php?jk=Perempuan">Putri</a>
                <a class="collapse-item" href="exp.php">Download Data</a>
            </div>
        </div>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="santri_pulang.php">
            <i class="fas fa-fw fa-car"></i>
            <span>Santri Pulang</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="santri_sakit.php">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Santri Sakit</span></a>
    </li>

    <!-- Nav Item - Utilities Collapse Menu -->
    <!-- <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fas fa-fw fa-wrench"></i>
            <span>Utilities</span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Custom Utilities:</h6>
                <a class="collapse-item" href="utilities-color.html">Colors</a>
                <a class="collapse-item" href="utilities-border.html">Borders</a>
                <a class="collapse-item" href="utilities-animation.html">Animations</a>
                <a class="collapse-item" href="utilities-other.html">Other</a>
            </div>
        </div>
    </li> -->

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Addons
    </div>
    <?php if ($level != 'madin') { ?>
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
                <i class="fas fa-fw fa-folder"></i>
                <span>Kelas Formal</span>
            </a>
            <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Kelas & Siswa</h6>
                    <a class="collapse-item" href="dt_kelas.php">Daftar Kelas</a>
                    <a class="collapse-item" href="nisn.php">Isi NISN Santri</a>
                </div>
            </div>
        </li>

        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item">
            <a class="nav-link" href="absen_formal.php">
                <i class="fas fa-fw fa-car"></i>
                <span>Absensi (Formal)</span></a>
        </li>
    <?php }
    if ($level == 'madin') { ?>
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
                <i class="fas fa-fw fa-folder"></i>
                <span>Kelas Madin</span>
            </a>
            <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Kelas & Siswa</h6>
                    <a class="collapse-item" href="dt_kelasMd.php">Daftar Kelas</a>
                    <a class="collapse-item" href="dt_madinPa.php">Isi Santri (Putra)</a>
                    <a class="collapse-item" href="dt_madinPi.php">Isi Santri (Putri)</a>
                </div>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages2" aria-expanded="true" aria-controls="collapsePages">
                <i class="fas fa-fw fa-car"></i>
                <span>Absensi Madin</span>
            </a>
            <div id="collapsePages2" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Absensi Kehadiran</h6>
                    <a class="collapse-item" href="absen_madinPa.php">Absensi Putra</a>
                    <a class="collapse-item" href="absen_madinPi.php">Absensi Putri</a>
                </div>
            </div>
        </li>

    <?php } ?>
    <!-- Nav Item - Pages Collapse Menu -->


    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->