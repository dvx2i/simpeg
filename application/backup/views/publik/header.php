<!-- begin #header -->
<div id="header" class="header navbar navbar-default navbar-fixed-top navbar-expand-lg">
    <!-- begin container -->
    <div class="container">
        <!-- begin navbar-brand -->
        <a href="<?= site_url() ?>" class="navbar-brand">
            <img src="<?= base_url('assets/publik') ?>/img/logo-2021.png" alt="">
        </a>
        <!-- end navbar-brand -->
        <!-- begin navbar-toggle -->
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#header-navbar">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <!-- end navbar-toggle -->
        <!-- begin navbar-collapse -->
        <div class="collapse navbar-collapse" id="header-navbar">
            <ul class="nav navbar-nav navbar-right">
                <li class="nav-item">
                    <a class="nav-link active" href="#home" data-click="scroll-to-target" data-scroll-target="#home">HOME</a>
                </li>
                <li class="nav-item"><a class="nav-link" href="#contact" data-click="scroll-to-target">CONTACT</a></li>
                <li class="nav-item"><a href="<?= site_url('Akun/register') ?>">MUTASI ONLINE</a></li>
                <li class="nav-item"><a class="nav-link" href="#contact" data-click="scroll-to-target">LOGIN</a></li>
            </ul>
        </div>
        <!-- end navbar-collapse -->
    </div>
    <!-- end container -->
</div>
<!-- end #header -->