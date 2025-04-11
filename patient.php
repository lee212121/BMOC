 <?php
 session_start();
 if(!isset($_SESSION['user']))
 {
     header("Location:index.php"); 
 }else{
   ob_start();
include("layouts/header.php");
 include("layouts/navbar.php");
 include("layouts/sidebar.php");
?>

 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->

    <section class="content-header">  
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">

          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content-header -->
  
     <!-- Main content -->
     <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
              <h3>Patients List  
                <button type="button" class="text-light btn bg-gradient-success btn-sm float-right rounded-2" data-bs-toggle="modal" data-bs-target="#exampleModal">Add Patient</button></h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example2" class="table table-striped table-bordered dt-responsive nowrap" style="width:100%">
                  <thead>
                
                          <th scope="col">Patient Name</th>
                          <th scope="row">Address</th>
                          <th scope="row">Age</th>
                          <th scope="row" style = "text-align:center;">Action</th>

                  </thead>
                  <tbody>
                  
                  </tbody>
                </table>
                <?php include('patient/addmodal.php'); ?>
              </div>
       
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->

  </div>
  <!-- /.content-wrapper -->

  <?php } include("layouts/footer.php");?>