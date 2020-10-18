<?php
session_start();
/*Connexion base de donnée*/
include 'request.php';
if (($_SESSION['chk_pwd_admin'] != 'ok') || (!isset($_SESSION['mail']))) {
    header('Location: login.php');
}
$comments = getComments();
header('Content-Type: text/html; charset=utf-8');

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Admin | Erreurs</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
</head>
<body class="hold-transition sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Accueil</a>
      </li>
    </ul>

    <!-- SEARCH FORM -->
    <form class="form-inline ml-3">
      <div class="input-group input-group-sm">
        <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-navbar" type="submit">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </div>
    </form>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link"  href="logout.php" role="button">
          <i class="fas fa-sign-out-alt"></i>
        </a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="../index3.html" class="brand-link">
      <img src="../dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Admin</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="../dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block text-capitalize"><?php echo $_SESSION['prenom'].' '.$_SESSION['nom'] ?></a>
        </div>
      </div>


       <!-- Sidebar Menu -->
       <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item menu-open">
            <a href="admin.php" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Tableau de bord
              </p>
            </a>
          </li>
          <li class="nav-item menu-open">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-comments"></i>
              <p>
                Rapport d'erreurs
              </p>
            </a>
          </li>
          
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Rapport d'erreur</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="admin.php">Tableau de bord</a></li>
              <li class="breadcrumb-item active">Erreurs</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Liste des erreurs</h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
              <i class="fas fa-minus"></i>
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
              <i class="fas fa-times"></i>
            </button>
          </div>
        </div>
        <div class="card-body p-0">
          <table class="table table-striped projects">
              <thead>
                  <tr>
                      <th style="width: 1%" class="text-center">
                          #
                      </th>
                      <th style="width: 20%">
                          Dispositif médical
                      </th>
                      <th style="width: 20%">
                          Type d'erreur
                      </th>
                      <th style="width: 20%">
                          Utilisateur
                      </th>
                      <th style="width: 20%">
                          Type d'utilisateur
                      </th>
                      <th style="width: 20%">
                          Contenu
                      </th>
                      
                  </tr>
              </thead>
              <tbody>
                  <tr>
                      <td class="text-center">
                        <?php echo $comments['idCommentaire'];?>
                      </td>
                      <td>
                          <a>
                          <?php echo $comments['appelation'];?>
                          </a>
                          <br/>
                          <small>
                              Publié le <?php echo date('d-m-Y', strtotime($comments['dateCom']));?>
                          </small>
                      </td>
                      <td>
                        <?php echo $comments['textErreur'];?>
                      </td>
                      <td class="text-capitalize">
                        <?php echo $comments['prenom'].' '.$comments['nom'];?>
                      </td>
                      <td class="text-capitalize">
                        <?php echo $comments['typeUtilisateur'];?>
                      </td>
                      <td>
                        <?php echo $comments['commentaire']?>
                      </td>
                      <td class="project-actions text-right">
                          
                          <a class="btn btn-danger btn-sm" href="#">
                              <i class="fas fa-trash">
                              </i>
                              Supprimer
                          </a>
                      </td>
                  </tr>
                  <tr>
                      <td class="text-center">
                        <?php echo $comments['idCommentaire'];?>
                      </td>
                      <td>
                          <a>
                          <?php echo $comments['appelation'];?>
                          </a>
                          <br/>
                          <small>
                              Publié le <?php echo date('d-m-Y', strtotime($comments['dateCom']));?>
                          </small>
                      </td>
                      <td>
                        Les utilisateurs n'ont pas massé le site d'injection après l'injection.
                      </td>
                      <td class="text-capitalize">
                        <?php echo $comments['prenom'].' '.$comments['nom'];?>
                      </td>
                      <td class="text-capitalize">
                        <?php echo $comments['typeUtilisateur'];?>
                      </td>
                      <td>
                        <?php echo $comments['commentaire']?>
                      </td>
                      <td class="project-actions text-right">
                          
                          <a class="btn btn-danger btn-sm" href="#">
                              <i class="fas fa-trash">
                              </i>
                              Supprimer
                          </a>
                      </td>
                  </tr>
                  <tr>
                      <td class="text-center">
                        <?php echo $comments['idCommentaire'];?>
                      </td>
                      <td>
                          <a>
                          <?php echo $comments['appelation'];?>
                          </a>
                          <br/>
                          <small>
                              Publié le <?php echo date('d-m-Y', strtotime($comments['dateCom']));?>
                          </small>
                      </td>
                      <td>
                      Les utilisateurs ont touché l'aiguille avant l'injection
                      </td>
                      <td class="text-capitalize">
                        <?php echo $comments['prenom'].' '.$comments['nom'];?>
                      </td>
                      <td class="text-capitalize">
                        <?php echo $comments['typeUtilisateur'];?>
                      </td>
                      <td>
                        <?php echo $comments['commentaire']?>
                      </td>
                      <td class="project-actions text-right">
                          
                          <a class="btn btn-danger btn-sm" href="#">
                              <i class="fas fa-trash">
                              </i>
                              Supprimer
                          </a>
                      </td>
                  </tr>
                  <tr>
                      <td class="text-center">
                        <?php echo $comments['idCommentaire'];?>
                      </td>
                      <td>
                          <a>
                          <?php echo $comments['appelation'];?>
                          </a>
                          <br/>
                          <small>
                              Publié le <?php echo date('d-m-Y', strtotime($comments['dateCom']));?>
                          </small>
                      </td>
                      <td>
                      Certains utilisateurs n'ont pas déverrouillé le verrou de sécurité
                      </td>
                      <td class="text-capitalize">
                        <?php echo $comments['prenom'].' '.$comments['nom'];?>
                      </td>
                      <td class="text-capitalize">
                        <?php echo $comments['typeUtilisateur'];?>
                      </td>
                      <td>
                        <?php echo $comments['commentaire']?>
                      </td>
                      <td class="project-actions text-right">
                          
                          <a class="btn btn-danger btn-sm" href="#">
                              <i class="fas fa-trash">
                              </i>
                              Supprimer
                          </a>
                      </td>
                  </tr>
                  <tr>
                      <td class="text-center">
                        <?php echo $comments['idCommentaire'];?>
                      </td>
                      <td>
                          <a>
                          <?php echo $comments['appelation'];?>
                          </a>
                          <br/>
                          <small>
                              Publié le <?php echo date('d-m-Y', strtotime($comments['dateCom']));?>
                          </small>
                      </td>
                      <td>
                        La durée du contact entre le dispositif et le corps était trop courte, l'injection n'a pas été déclenchée.
                      </td>
                      <td class="text-capitalize">
                        <?php echo $comments['prenom'].' '.$comments['nom'];?>
                      </td>
                      <td class="text-capitalize">
                        <?php echo $comments['typeUtilisateur'];?>
                      </td>
                      <td>
                        <?php echo $comments['commentaire']?>
                      </td>
                      <td class="project-actions text-right">
                          
                          <a class="btn btn-danger btn-sm" href="#">
                              <i class="fas fa-trash">
                              </i>
                              Supprimer
                          </a>
                      </td>
                  </tr>
                 
              </tbody>
          </table>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 1.0.0
    </div>
    <strong>Copyright &copy; 2020 <a href="">DM akinator</a>.</strong> All rights reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../dist/js/demo.js"></script>
</body>
</html>
