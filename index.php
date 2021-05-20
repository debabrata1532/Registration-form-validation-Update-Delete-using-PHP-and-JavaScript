<?php

$con = mysqli_connect('localhost', 'deb', 'Debabrata@123', 'register');

if(isset($_POST['submit'])){


$email=$_POST['email'];
$name=$_POST['name'];
$password = $_POST['password'];
$hobbies = $_POST['hobbies'];
$hobbies = implode(",", $hobbies);

$file = $_FILES['file'];

$filename= $file['name'];
$filepath = $file['tmp_name'];
$fileerr = $file['error'];
$filesize = $file['size'];
$filetype = $file['type'];

/* 1. First we will check Email id is alreay exist in database or not
    2. If email is not exist we will check uploaded file size and type 
*/



$sql2= "select * from user where email= '$email'";
$result = mysqli_query($con, $sql2);
$num = mysqli_num_rows($result);

// check Email id is alreay exist in database or not

if($num > 0){
    echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
    <strong>Ooopsss</strong>Email id is already exist
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
}
else {


    if($fileerr == 0){

        // If email is not exist we will check uploaded file size 

        if($filesize > 500000){
            // print_r($file);
            echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
    <strong>Ooopsss</strong>Upload file less than 500KB
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
        }else{
            
    $filedest = 'uploads/'. $filename;

    move_uploaded_file($filepath, $filedest);
    $sql ="insert into user (email,name, password, hobbies, image) values ('$email', '$name', '$password', '$hobbies', '$filedest')";
    $res = mysqli_query($con, $sql);

            
            
        }
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">
    <link rel="stylesheet" href="/registration/syle.css">
    <title>Hello, world!</title>
</head>

<body>
    <?php  include 'header.php';  ?>

        <!-- Registration form  -->

    <div class="container my-3 form-container">
        <form enctype="multipart/form-data" action="index.php" method="post" name="myform" class="userform"
            onsubmit="return validateform()">
            <div class="heading">
                <H3>
                    <pre>Register your self </H3>
            </div>
            <div>
                <input type="text" id="email" name="email" placeholder="Email">
                <b><span class="error"> </span></b>
            </div>
            <div id="name">
                <input type="text" id="fname" name="name" placeholder="Name" autocomplete="off">
                <b><span class="error"></span></b>
            </div>
            <div>
                <input type="password" id="pass" name="password" placeholder="Password" autocomplete="off"
                    title="password">
                <b><span class="error"> </span></b>
            </div>
            <div class="title">
                <span>Password must contain 1 capital letter, 1 number, <br>1 special charecter & length should be 8 to
                    16</span>
            </div>
            <span class="boxhead"><b>Hobbies</b></span>
            <div class="btn-group " role="group" aria-label="Basic checkbox toggle button group">
                <!-- <ul>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                    <li></li>
                </ul> -->
                <input type="checkbox" class="" name="hobbies[]" id="btncheck1" autocomplete="off" value="Dance">
                <label class="boxlabel" for="btncheck1">Dance</label>

                <input type="checkbox" class="" id="btncheck2" name="hobbies[]" autocomplete="off" value="Yoga">
                <label class="boxlabel" for="btncheck2">Yoga</label>

                <input type="checkbox" class="" id="btncheck3" name="hobbies[]" autocomplete="off" value="cooking">
                <label class="boxlabel" for="btncheck3">cooking</label>

                <input type="checkbox" class="" id="btncheck4" name="hobbies[]" autocomplete="off" value="Blogging">
                <label class="boxlabel" for="btncheck4">Bloging</label>

                <input type="checkbox" class="" id="btncheck5" name="hobbies[]" autocomplete="off" value="Singing">
                <label class="boxlabel" for="btncheck5">Singing</label>
                <span class="error"></span>
            </div>
            <div>
                <input type="file" id="file" name="file" value="upload">
            </div>

            <div>
                <button class="btn btn-primary my-2 border-radius-15px" name="submit" type="submit">Submit</button>
            </div>
        </form>

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
    <script src="index.js"></script>



</body>

</html>