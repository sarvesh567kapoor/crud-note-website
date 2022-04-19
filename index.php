<?php

// INSERT INTO `notes` (`Sno`, `title`, `description`, `timestamp`) VALUES (NULL, 'lets go for a walk ', 'Its Nice to go for a walk every day thankyou ', current_timestamp());
$insert= false;
$update= false;
$delete= false;

//connect to the database
$servername = "localhost";
$username = "root";
$password = "";
$database = "notes";

// create a connection 
$conn = mysqli_connect($servername, $username, $password, $database);

//die if connection was not sucessful
if (!$conn) {
  die("<br> Sorry we are failed to connect <br>" . mysqli_connect_error());
}


if(isset($_GET['delete'])) {
     $sno = $_GET['delete'];

$sql = "DELETE FROM `notes` WHERE `notes`.`Sno` = $sno";

$result2=mysqli_query($conn,$sql);
// $aff= mysqli_affected_rows($conn);
if($result2)
{
   $delete = true;
}


}


if ($_SERVER['REQUEST_METHOD'] == 'POST'){

if(isset($_POST['snoedit'])) {
    // echo "yes";
    //update the record

    $sno = $_POST["snoedit"];
    $title = $_POST["titleedit"];
    $description = $_POST["descedit"];
    
    //sql query to update the data
    $sql ="UPDATE `notes` SET `title` = '$title', `description` = '$description' WHERE `notes`.`Sno` = $sno";
    $result1 = mysqli_query($conn,$sql);
    if($result1){
        $update = true;
    }

      
} 

else 
{  
// variable to be inserted into the table
$title = $_POST['title'];
$desc = $_POST['desc'];
 
// inserting the record in the table notes 
$sql = "INSERT INTO `notes` (`title`, `description`, `timestamp`) VALUES ('$title','$desc',current_timestamp())";

$result=mysqli_query($conn,$sql);

// check for the  insertion in the table notes 
if($result)
{
      // echo "<br> the data  was inserted  sucessfully ";
      $insert= true;
}
else
{
    // echo "<br>  the data  was not  inserted  sorry !<br> ";
    echo mysqli_error($conn);
}
}

}


?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
      <link rel="stylesheet" href="./style.css">
      <link rel="stylesheet" href="//cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    

    <title> iNotes - Notes Tking made easy </title>
 
</head>

<body>
    <!-- Edit modal -->
<!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editmodal">
  Launch Edit Modal
</button> -->

<!-- Edit  Modal -->
<div class="modal fade" id="editmodal" tabindex="-1" aria-labelledby="editmodalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
    <form action="/crud_application/index.php" method="post" >
      <div class="modal-header">
        <h5 class="modal-title" id="editmodalLabel">Edit Note</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
     
          <input type="hidden" name="snoedit" id ="snoedit" >
            <div class="form-group my-2">
                <label for="titleedit" class="form-label">Note Title</label>
                <input type="text" name="titleedit" class="form-control" id="titleedit" aria-describedby="emailHelp">
            </div>
            <div class="form-group my-2">
                <label for="descedit">Note Description</label>
                <textarea class="form-control" name="descedit" id="descedit" rows="3"></textarea>
            </div>
            
        
      </div>
      <div class="modal-footer d-block mr-auto">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class=" my-2 btn btn-primary">Update Note</button>
      </div>
      </form>
    </div>
  </div>
</div>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">PHP CRUD</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">About Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Contact Us</a>
                    </li>
                </ul>
                <form class="d-flex">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
            </div>
        </div>
    </nav>
    <?php
    if($insert){

      echo '<div class="alert alert-success alert-dismissible" role="alert">
      
      <strong>Success !</strong> Your note has been recorded sucessfully
      <span type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></span>
    </div>';

    }

    if($update){

        echo '<div class="alert alert-success alert-dismissible" role="alert">
        
        <strong>Success !</strong> Your note has been update sucessfully
        <span type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></span>
      </div>';
  
      }

    if($delete){

        echo '<div class="alert alert-success alert-dismissible" role="alert">
        
        <strong>Success !</strong> Your note has been deleted sucessfully
        <span type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></span>
      </div>';
  
      }
  

    ?>
    <div class="container my-4">
        <h1>Add a Note</h1>
        <form action="/crud_application/index.php" method="post" >
            <div class="form-group my-2">
                <label for="title" class="form-label">Note Title</label>
                <input type="text" name="title" class="form-control" id="title" aria-describedby="emailHelp">
            </div>
            <div class="form-group my-2">
                <label for="desc">Note Description</label>
                <textarea class="form-control" name="desc" id="desc" rows="3"></textarea>
            </div>
            <button type="submit" class=" my-2 btn btn-primary">Add Note</button>
        </form>
    </div>

    <div class="container">

        <table class="table my-3" id="myTable">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">Sno</th>
                    <th scope="col">Title</th>
                    <th scope="col">Description</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
            <?php


// fetching the record in the notes employee 
$sql = "SELECT * FROM `notes`";

$result = mysqli_query($conn, $sql);
$sno=1;

while ($row = mysqli_fetch_assoc($result)) {
  //  echo var_dump($row);
  echo "<br>";
  echo ' <tr>
  <th scope="row">'. $sno.'</th>
  <td>'.$row['title'].'</td>
  <td>'. $row['description'].'</td>
  <td> <button id=d"'.$row['Sno'].'" class="btn delete btn-sm  btn-danger">Delete</button> <button class="btn edit btn-sm btn-primary " id="'.$row['Sno'].'" >Edit</button></td>
</tr>';


$sno+=1;
}


?>
               
            </tbody>
        </table>

    </div>
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    <script src="//cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
   
   <script>
     $(document).ready( function () {
 $('#myTable').DataTable();
} );
   </script>
      <script>
        const edits= document.getElementsByClassName("edit");
        const deletes = document.getElementsByClassName("delete");


        Array.from(edits).forEach((element)=>{
            element.addEventListener('click',(e)=>{
                // console.log("edit",e.target.parentNode.parentNode);
               let  tr=e.target.parentNode.parentNode;
               let title = tr.getElementsByTagName("td")[0].innerText;
               let description = tr.getElementsByTagName("td")[1].innerText;
               titleedit.value = title;
               descedit.value = description;
               snoedit.value =e.target.id;
               console.log(e.target.id);
             $('#editmodal').modal('toggle');
            })

        })

        Array.from(deletes).forEach((element)=>{
            element.addEventListener('click',(e)=>{
                // console.log("delete",e.target.parentNode.parentNode);
               
               let sno = e.target.id.substr(1,);
               if(confirm("Confirm that you want to delete Note!")){
                   console.log("Yes");
                   window.location = `/crud_application/index.php?delete=${sno}`;
                   // todo : create a form and use post request to sumit a form
                   // if a  person reload the delete page it again showw the same message
               }
               else {
                console.log("No");
               }

            })

        })
    </script>
</body>

</html>