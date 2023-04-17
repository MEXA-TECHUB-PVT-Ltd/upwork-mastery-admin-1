<?php 
session_start();
if (!isset($_SESSION["admin_email"]) && !isset($_SESSION["admin_id"])) {
    header("location:login.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php include("include/links.php");?>
<style>
        .bd-placeholder-img {
          font-size: 1.125rem;
          text-anchor: middle;
          -webkit-user-select: none;
          -moz-user-select: none;
          user-select: none;
        }
  
        @media (min-width: 768px) {
          .bd-placeholder-img-lg {
            font-size: 3.5rem;
          }
        }
        .thumbnail-container {
  position: relative;
  display: inline-block;
}

.thumbnail-container img {
  margin-left: 40px;
  display: block;
  width: 700px;
  height: 300px;
}

.play-button {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  background: transparent;
  border: none;
  color: #14a800;
  font-size: 3rem;
  cursor: pointer;
}

.play-button i {
  display: inline-block;
  margin: 0.5rem;
}
.show-more {
  display: none; /* Hide by default */
  font-weight: bold;
}

.confirm-button-class {
  background-color: #14a800 !important;
  color: #14a800 !important;
  border: 1px solid #14a800 !important;
}
.title-class {
  font-size: 15px !important;
}
.icon-class {
  font-size: 10px !important;
}
.confirm-button-class .swal2-icon svg {
  width: 12px !important;
  height: 12px !important;
}
.swal2-actions .swal2-confirm {
  background-color: #14a800 !important;
  color: white !important;
  border: none !important;
  box-shadow: none !important;
}
.swal2-actions .swal2-cancel {
  background-color: #fff !important;
  color: #14a800 !important;
  border: 1px solid #14a800 !important;
  box-shadow: none !important;
}
.swal2-confirm:focus, .swal2-cancel:focus {
  box-shadow: none !important;
  border: 1px solid #14a800;
}
.swal2-actions button:hover {
  border: none !important;
}
      </style>
    <link rel="stylesheet" href="assets/css/dashboard.css">
</head>
<body>
<?php include("include/header.php");?>
  <div class="container-fluid ">
    <div class="row mt-120">
      <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block sidebar collapse shadow">
        <div class="position-sticky pt-3">
    <a class="navbar-brand col-md-3 col-lg-2 me-0 px-1" href="index.php"><img style="height: 50px;" src="assets/image/logo.png" alt="logo"></a>
          <ul class="nav flex-column">
            <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                <span>Menu</span>
                <a class="link-secondary" href="#" aria-label="Add a new report"></a>
              </h6>
            <li class="nav-item">
              <a class="nav-link" aria-current="page" href="index.php">
                <span data-feather="home"></span>
                Dashboard
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="users.php">
                <span data-feather="users"></span>
                Users
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" href="videos.php">
                <span data-feather="video"></span>
                Videos
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="terms-and-conditions.php">
                <span data-feather="folder"></span>
                Terms And Conditions
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="Licence.php">
                <span data-feather="file"></span>
                License Agreement
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="privacy.php">
                <span data-feather="bookmark"></span>
                Privacy Policy
              </a>
            </li>
          </ul>
        </div>
      </nav>
      <main class="col-md-10 ms-sm-auto col-lg-10 px-md-4 mt-5 mb-5">
        <div class="row">
          <div class="col-md-6">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
              <h1 style="color: #14a800;" class="h2">Videos</h1>
            </div>
          </div>
          <div class="col-md-6 text-end">
            <button href="#" class="border-0 fw-600 btn btn-primary " data-bs-toggle="modal" data-bs-target="#exampleModal">Add Video</button>
          </div>
        </div>
        
            <div class="row">
            <?php
include_once("../include/db.php");
$conn=connect();
$sql = "SELECT * FROM videos";
$run = pg_query($conn,$sql);
while($result = pg_fetch_assoc($run)){
    $id = $result["id"];
    $title = $result["title"];
    $link = $result["link"];
    $description = $result["description"];
parse_str( parse_url( $link, PHP_URL_QUERY ), $my_array_of_vars );
  ?>
              <div class="col-md-4 mb-3">
                <div id class="card" style="width: 400px">
                <a style="color:black" class="text-end mx-2" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="fa-solid fa-ellipsis-vertical"></i>
                </a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" onclick="loadEdit(<?php echo $id?>)" data-bs-toggle="modal" data-bs-target="#Modaledit" href="#"><i class="text-primary fa-solid fa-pen-to-square"></i> Update</a></li>
                    <li><a class="dropdown-item" onclick="confirmation(<?php echo $id?>)" href="#"><i class="text-danger fa-solid fa-trash"></i> Delete</a></li>
                </ul>
                  <a href="#" onclick="view(<?php echo $id?>)" data-bs-toggle="modal" data-bs-target="#exampleModal2"><img style="width:385px; height:200px" src="https://img.youtube.com/vi/<?php echo $my_array_of_vars['v']?>/0.jpg" class="card-img-top" alt="thumbnail"></a>
                  <div class="card-body" style="height:150px">
                    <h5 style="color:#14a800" class="card-title"><?php echo $title?></h5>
                    <?php
$words = explode(" ", $description);
if (count($words) > 15) {
  $description = implode(" ", array_slice($words, 0, 15)) . "...";
?>
                    <p id="description" class="card-text"><?php echo $description?><a href="#" style="color:#14a800; text-decoration:none;" onclick="view(<?php echo $id?>)" data-bs-toggle="modal" data-bs-target="#exampleModal2">show more</a></p>
<?php
}else {
  ?>
                    <p id="description" class="card-text"><?php echo $description?></p>
  <?php
}
?>
                  </div>
                </div>
              </div>
              <?php
}
?>
            </div>
<!-- Button trigger modal -->
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Add Video</h1>
        <button style="box-shadow: none;" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="backend/manage-video/add-video.php" method="post">
      <div class="modal-body">
        <div class="input-group mb-3">
          <input style="box-shadow: none;" name="title" type="text" class="form-control" placeholder="Video Title">
        </div>
        <div class="input-group mb-3">
          <input style="box-shadow: none;" type="text" name="link" class="form-control" placeholder="Link Of Youtube">
        </div>
        <div class="input-group mb-3">
          <textarea style="box-shadow: none;" name="description" class="form-control" rows="5" placeholder="Description" id="floatingTextarea"></textarea>
        </div>
      </div>
      <div class="modal-footer d-flex justify-content-center mt-3">
        <button style="padding:7px 150px;" type="submit" class="btn btn-primary ">Add</button>
      </div>
      </form>
    </div>
  </div>
</div>
<!-- Modal -->
<div class="modal fade" id="Modaledit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Video</h1>
        <button style="box-shadow: none;" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="backend/manage-video/edit-video.php" method="post">
      <div class="modal-body">
        <div class="input-group mb-3">
          <input style="box-shadow: none;" id="title" name="title" type="text" class="form-control" placeholder="Video Title">
        </div>
        <div class="input-group mb-3">
          <input style="box-shadow: none;" id="link" type="text" name="link" class="form-control" placeholder="Link Of Youtube">
        </div>
        <div class="input-group mb-3">
          <textarea style="box-shadow: none;" id="description3" name="description" class="form-control" rows="5" placeholder="Description" id="floatingTextarea"></textarea>
        </div>
        <input type="hidden" name="id" id="id">
      </div>
      <div class="modal-footer d-flex justify-content-center mt-3">
        <button style="padding:7px 150px;" type="submit" class="btn btn-primary ">Edit</button>
      </div>
      </form>
    </div>
  </div>
</div>
<!-- Modal -->
<div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Video Details</h1>
        <button style="box-shadow: none;" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="thumbnail-container">
          <img src="https://img.youtube.com/vi/U69WLdfsa9jInW0/0.jpg" alt="thumbnail">
          <button class="play-button" data-bs-dismiss="modal" aria-label="Close" onclick="video()" data-bs-toggle="modal" data-bs-target="#exampleModal3"><i class="fa fa-play"></i></button>
        </div>
        <div class="row mt-3">
          <div class="col-4">
            <div class="primary-title">
              <h4 class="ms-5 mt-2" style="color: #14a800;">video title</h4>
            </div>
          </div>
          <div class="col-8">
            <div class="primary-title">
              <h6 class="text-end me-5 mt-2" id="title2"></h6>
            </div>
          </div>
        </div>
        <div class="row mt-2">
          <div class="col-4">
            <div class="primary-title">
              <h4 class="ms-5" style="color: #14a800;">Link Of Youtube</h4>
            </div>
          </div>
          <div class="col-8">
            <div class="primary-title">
              <h6 class="text-end me-5 mt-2" id="link2"></h6>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <h5 class="ms-5 mt-2" style="color: #14a800;">Description:</h5>
          </div>
          <div class="col-11 ms-5 mt-2" id="des-text">
          </div>
        </div>
      </div>
      <div class="modal-footer d-flex justify-content-center">
        <button type="button" class="btn btn-primary"><i class="fa-solid fa-link"></i> Copy Link</button>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="exampleModal3" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button style="box-shadow: none;" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="modal-body">
          <div class="embed-responsive embed-responsive-16by9">
            <iframe id="cartoonVideo" class="embed-responsive-item" width="100%" height="315" src="//www.youtube.com/embed/YE7VzlLtp-4" allowfullscreen></iframe>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
    </main>
    </div>
    </div>
<?php include("include/scripts.php");?>
<script>
  $(document).ready(function(){
      /* Get iframe src attribute value i.e. YouTube video url
      and store it in a variable */
      var url = $("#cartoonVideo").attr('src');
      
      /* Assign empty url value to the iframe src attribute when
      modal hide, which stop the video playing */
      $("#myModal").on('hide.bs.modal', function(){
          $("#cartoonVideo").attr('src', '');
      });
      
      /* Assign the initially stored url back to the iframe src
      attribute when modal is displayed again */
      $("#myModal").on('show.bs.modal', function(){
          $("#cartoonVideo").attr('src', url);
      });
  });
  </script>
  <?php 
if (isset($_SESSION["message"])) {
	# code...
	?>
	<script>
$.toast({
            heading: 'Looks Good!',
            text: '<?php echo $_SESSION["message"]?>',
            position: 'top-right',
            loaderBg:'#878787',
            hideAfter: 3500
        });
	</script>
	<?php
	unset($_SESSION["message"]);
}

?>
		<?php 
if (isset($_SESSION["message_error"])) {
	# code...
	?>
	<script>
$.toast({
            heading: 'Opps! Failed',
            text: '<?php echo $_SESSION["message_error"]?>',
            position: 'top-right',
            loaderBg:'#fec107',
            icon: 'error',
            hideAfter: 3500
        });
	</script>
	<?php
	unset($_SESSION["message_error"]);
}
?>
    <script>
            function view(id) {
        $.ajax({
            url: "backend/manage-video/get-video-by-id.php",
            method: "POST",
            data: {id: id},
            success: function (response) {
                response = JSON.parse(response);
                console.log(response);
                $('#title2').html(response.title);
                $('#link2').html(response.link);
                $('#des-text').html(response.description);
 // And finally you can this function to show the pop-up/dialog
 $("#exampleModal2").modal();
            }
        });
    }
  </script>
      <script>
            function loadEdit(id) {
        $.ajax({
            url: "backend/manage-video/get-video-by-id.php",
            method: "POST",
            data: {id: id},
            success: function (response) {
                response = JSON.parse(response);
                console.log(response);
                $('#title').val(response.title);
                $('#link').val(response.link);
                $('#description3').val(response.description);
                $('#id').val(response.id);
 // And finally you can this function to show the pop-up/dialog
 $("#Modaledit").modal();
            }
        });
    }
  </script>
  <script>
    function confirmation(id){
        console.log(id);
        Swal.fire({
  title: 'Conformation',
  text: "Do You want to delete!",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Delete'
}).then((result) => {
  if (result.isConfirmed) {
    var myHeaders = new Headers();
        myHeaders.append("Content-Type", "application/json");
        var raw = JSON.stringify({
          "id": id,
        });
        var requestOptions = {
            method: 'POST',
            headers: myHeaders,
            body: raw,
            redirect: 'follow'
          };
          fetch("backend/manage-video/delete-video.php", requestOptions)
          .then((response) => response.json())
          .then((data) => {
            if(data.status){
            window.location = 'videos.php';
            }else{
                console.log(data.message);
            }
          })
          .catch((error) => {
            console.error('Error:', error);
          });
  }
})
}
</script>
</body>
</html>