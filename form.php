<?php

$con = mysqli_connect('localhost', 'deb', 'Debabrata@123', 'register');



if (isset($_POST['submit'])){
    $email = $_POST['email'];
    $pass = $_POST['password'];
    $file = $_FILES['file'];
    

    $filename= $file['name'];
    $filepath = $file['tmp_name'];
    $fileerr = $file['error'];
    $filesize = $file['size'];

/* 
    To update profile picture of any user, user need to validate their email id and password

*/

    $sql = "select * from user where email= '$email' ";
    $result = mysqli_query($con, $sql);
    while($row = mysqli_fetch_assoc($result)){

        // Check email is exist or not if exist thn check password 

        if ($row['email'] == $email){

            // if password is correct thn update profile picture other wise show error 

            if($row['password'] == $pass){
                if($fileerr == 0){
                    $filedest = 'uploads/'. $filename;
                
                    move_uploaded_file($filepath, $filedest);
                    $sql ="update user set image='$filedest' where email= '$email' ";
                    $res = mysqli_query($con, $sql);
                
                
                }
            }
            else{
                // echo "Invalid pass";
                echo '<div class="alert alert-Danger alert-dismissible fade show" role="alert">
                <strong>Holy guacamole!</strong> Use correct password
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>';
            }
        } 
    else{
        // echo "not exist";
        echo '<div class="alert alert-Danger alert-dismissible fade show" role="alert">
        <strong>Ooopss</strong>Email id is not exist
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';

    }
    }
    

}



function deleted(){
    
}

?>


<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">

    <title>Hello, world!</title>
</head>

<body>
    <?php  include 'header.php';  ?>
    <!-- <Edit modal  -->

    
<!-- Modal to update profile pcture of user  -->

    <div class="modal fade" id="editmodal" tabindex="-1" aria-labelledby="editmodalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editmodalLabel">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form enctype="multipart/form-data" action="form.php" method="post" name="myform" class="userform"
                        onsubmit="return validateform()">
                        <div>
                            <input type="text" id="email" name="email" placeholder="Email">
                            <b><span class="error"> </span></b>
                        </div>

                        <div>
                            <input type="password" id="pass" name="password" placeholder="Password" autocomplete="off"
                                title="password">
                            <b><span class="error"> </span></b>
                        </div>

                        <div>
                            <input type="file" id="file" name="file" value="upload">
                        </div>

                        <div>
                            <button class="btn btn-primary my-2" name="submit" type="submit">Submit</button>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Show users details  -->

    <div class="container bg-primary my-2 color-white">

        <div class="users">

        <!-- Display all user in a table  -->

               <table class="table" id="mytable">
                <thead>
                    <tr>
                        <th scope="col">
                            <pre>User id</th>
                        <th scope="col"><pre>Email</th>
                        <th scope="col"><pre>Name</th>
                        <th scope="col"><pre>Hobbies</th>
                        <th scope="col"><pre>Image</th>
                        
                    </tr>
                </thead>
                <tbody>
                    <?php


$sql  = "select * from user";
$res =mysqli_query($con, $sql);
$no=0;
while ($row = mysqli_fetch_assoc($res)){
    $no++;
    

  echo   ' <tr>
        <th scope="row"> ' . $no . '</th>
        <td>' . $row["email"] . '</td>
        <td>' . $row["name"] . '</td>
        <td>' . $row["hobbies"] . '</td>
        <td><img src= " ' . $row['image'] . '" width=70px ></td>
        
      </tr>
      ';

}
?>

                </tbody>
            </table>
        </div>

    </div>

    <!-- Edit and add button  -->


    <div class="container">
    
      <a href="index.php" class=" btn btn-success">Add User</a>
       <button data-bs-toggle="modal" data-bs-target="#editmodal" class="edit btn-primary btn">Update Picture</button> 
      <!-- <button class="btn-secondary">Delete</button> -->
    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8" crossorigin="anonymous">
    </script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.min.js" integrity="sha384-lpyLfhYuitXl2zRZ5Bn2fqnhNAKOAaM/0Kr9laMspuaMiZfGmfwRNFh8HlMy49eQ" crossorigin="anonymous"></script>
    -->
   
<!-- <script>
     edits = document.getElementsByClassName('edit');
    Array.from(edits).forEach((element) => {
        element.addEventListener("click", (e) =>{
            tr = e.target.parentNode.parentNode;
            email = tr.getElementsByTagName("td")[0].innerText;
            name = tr.getElementsByTagName("td")[1].innerText;
            // console.log(email);

            $('#editmodal').modal('toggle');
        })
        
    })

</script> -->

</body>

</html>