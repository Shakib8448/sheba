<?php
session_start();
include ("connection.php");
include ("function.php");

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $id = $_SESSION['id'];

    if( !empty($name) ) {
        $_SESSION['name'] = $name;
        $query = "UPDATE `user` SET `name` = '$name' WHERE `users`.`id` = '$id'";
        mysqli_query($con, $query);
    }
    if( !empty($email) ) {
        $_SESSION['email'] = $email;
        $query = "UPDATE `user` SET `email` = '$email' WHERE `users`.`id` = '$id'";
        mysqli_query($con, $query);
    }
    if( !empty($username) && !is_numeric($username) ) {
        $_SESSION['username'] = $username;
        $query = "UPDATE `user` SET `username` = '$username' WHERE `users`.`id` = '$id'";
        mysqli_query($con, $query);
    }
    if( !empty($password) ) {
        $_SESSION['password'] = $password;
        $query = "UPDATE `user` SET `password` = '$password' WHERE `users`.`id` = '$id'";
        mysqli_query($con, $query);
    }
    header("Location: profile.php");
    die;
}
//$user_data = check_login($con);
?>

<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <link rel="stylesheet" href="aboutus.css">

    <!-- Footer css-->
    <link rel="stylesheet" href="footer.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">

    <title>Profile</title>
    <style>
        .one {
            font-weight: bold;
            color: black;
            font-size: 22px;
            padding: 2px
        }
        .two {
            font-weight: bold;
            color: black;
            font-size: 32px;
        }
    </style>
</head>
<body>

<!--navigation bar-->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="index.php">SHEBA</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="about.php">About</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="allservice.php" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Services
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="ac.php">AC Service</a>
                    <a class="dropdown-item" href="ceilingfan.php">Ceiling Fan Service</a>
                    <a class="dropdown-item" href="drilling.php">Drilling</a>
                    <a class="dropdown-item" href="driving.php">Driving</a>
                    <a class="dropdown-item" href="painting.php">Painting</a>
                    <a class="dropdown-item" href="plumbing.php">Plumbing</a>
                    <a class="dropdown-item" href="welding.php">Welding</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">Special Services <span class="badge badge-pill badge-danger">New</span></a>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="contact.php">Contact Us</a>
            </li>
            <?php
            if(isset($_SESSION['user_id'])) {
                if($_SESSION['id'] == 1) {
                    ?>
                    <li class="nav-item">
                        <a class="nav-link" href="dashboard.php">Dashboard</a>
                    </li>
                    <?php
                }
            }
            ?>
        </ul>
        <!--        <form class="form-inline my-2 my-lg-0">
                    <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-light my-2 my-sm-0" type="submit">Search</button>
                </form>-->
        <div class="mx-2">
            <?php
            if(isset($_SESSION['user_id'])) {
                $user = $_SESSION['name'];
                ?>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" style="color: white" href="profile.php" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <?php echo $user?>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="profile.php">Account Info</a>
                        <a class="dropdown-item" href="profile.php">Pending Orders</a>
                        <?php
                        if(isset($_SESSION['user_id'])) {
                            if($_SESSION['id'] == 1) {
                                ?>
                                <a class="dropdown-item" href="dashboard.php">Dashboard</a>
                                <?php
                            }
                        }
                        ?>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="logout.php">Log out</a>
                    </div>
                </li>
                <!-- <a class="btn btn-danger" href="logout.php" role="button">Log out</a>-->
                <?php
            } else {
                ?> <button class="btn btn-danger" data-toggle="modal" data-target="#loginModal">Login</button>
                <button class="btn btn-danger" data-toggle="modal" data-target="#signupModal">Sign Up</button> <?php
            }
            ?>
        </div>
    </div>
</nav>

<!-- Login Modal -->
<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="loginModalLabel">Login In To Sheba</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="accept_login.php" method="post">
                    <div class="form-group">
                        <label for="email">Username</label>
                        <input type="text" class="form-control" name="username" aria-describedby="emailHelp">
                        <!--                        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>-->
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" class="form-control" name="password">
                    </div>
                    <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                        <label class="form-check-label" for="exampleCheck1">Remember me</label>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


<div class="container" >
    <div class="row">
        <div class="col-md-6">
            <p></p>
            <p class="one"><span class="badge badge-pill badge-danger">Name</span></a></p>
            <p class="two"><?php echo $_SESSION['name'] ?></p>

            <p class="one"><span class="badge badge-pill badge-danger">Email</span></a></p>
            <p class="two"><?php echo $_SESSION['email'] ?></p>

            <p class="one"><span class="badge badge-pill badge-danger">Userame</span></a></p>
            <p class="two"><?php echo $_SESSION['username'] ?></p>

            <p class="one"><span class="badge badge-pill badge-danger">Password</span></a></p>
            <p class="two"><?php echo $_SESSION['password'] ?></p>

            <p class="one"><span class="badge badge-pill badge-danger">Total orders</span></a></p>
            <p class="two"><?php echo $_SESSION['orders'] ?></p>
            <p></p>
            <button class="btn btn-success" data-toggle="modal" data-target="#editinfo">Edit Info</button>
            <button class="btn btn-danger"><a href="delete_account.php" style="color: white;" onclick="return confirm('Are you sure you want to delete the account?')"
                >Delete Account</a> </button>
            <p></p>
         </div>
        <div class="col-md-6">
            <p></p>
            <p class="one"><span class="badge badge-pill badge-danger">Pending Orders</span></a></p>
            <table class="table">
                <thead class="thead-dark">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Ordering For</th>
                    <th scope="col">Phone</th>
                    <th scope="col">Address</th>
                    <th scope="col">Type</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $count = 1;
                $user_id = $_SESSION['user_id'];

                $query = "SELECT * FROM `plumbing` WHERE `orderuser` =  $user_id";
                $result = mysqli_query($con, $query);
                while ($info = mysqli_fetch_array ($result) ) {
                    ?>
                    <tr>
                        <th scope="row"> <?php echo $count?></th>
                        <td> <?php echo $info['name'] ?> </td>
                        <td> <?php echo $info['phone'] ?> </td>
                        <td> <?php echo $info['address'] ?> </td>
                        <td> Plumbing </td>
                    </tr>
                    <?php
                    $count++;
                }

                $query = "SELECT * FROM `drill` WHERE `orderuser` =  $user_id";
                $result = mysqli_query($con, $query);
                while ($info = mysqli_fetch_array ($result) ) {
                    ?>
                    <tr>
                        <th scope="row"> <?php echo $count?></th>
                        <td> <?php echo $info['name'] ?> </td>
                        <td> <?php echo $info['phone'] ?> </td>
                        <td> <?php echo $info['address'] ?> </td>
                        <td> Drilling </td>
                    </tr>
                    <?php
                    $count++;
                }

                $query = "SELECT * FROM `ceil` WHERE `orderuser` =  $user_id";
                $result = mysqli_query($con, $query);
                while ($info = mysqli_fetch_array ($result) ) {
                    ?>
                    <tr>
                        <th scope="row"> <?php echo $count?></th>
                        <td> <?php echo $info['name'] ?> </td>
                        <td> <?php echo $info['phone'] ?> </td>
                        <td> <?php echo $info['address'] ?> </td>
                        <td> Ceiling Fan Service </td>
                    </tr>
                    <?php
                    $count++;
                }

                $query = "SELECT * FROM `ac` WHERE `orderuser` =  $user_id";
                $result = mysqli_query($con, $query);
                while ($info = mysqli_fetch_array ($result) ) {
                    ?>
                    <tr>
                        <th scope="row"> <?php echo $count?></th>
                        <td> <?php echo $info['name'] ?> </td>
                        <td> <?php echo $info['phone'] ?> </td>
                        <td> <?php echo $info['address'] ?> </td>
                        <td> AC Service </td>
                    </tr>
                    <?php
                    $count++;
                }

                $query = "SELECT * FROM `drive` WHERE `orderuser` =  $user_id";
                $result = mysqli_query($con, $query);
                while ($info = mysqli_fetch_array ($result) ) {
                    ?>
                    <tr>
                        <th scope="row"> <?php echo $count?></th>
                        <td> <?php echo $info['name'] ?> </td>
                        <td> <?php echo $info['phone'] ?> </td>
                        <td> <?php echo $info['address'] ?> </td>
                        <td> Driving </td>
                    </tr>
                    <?php
                    $count++;
                }

                $query = "SELECT * FROM `paint` WHERE `orderuser` =  $user_id";
                $result = mysqli_query($con, $query);
                while ($info = mysqli_fetch_array ($result) ) {
                    ?>
                    <tr>
                        <th scope="row"> <?php echo $count?></th>
                        <td> <?php echo $info['name'] ?> </td>
                        <td> <?php echo $info['phone'] ?> </td>
                        <td> <?php echo $info['address'] ?> </td>
                        <td>Painting</td>
                    </tr>
                    <?php
                    $count++;
                }

                $query = "SELECT * FROM `weld` WHERE `orderuser` =  $user_id";
                $result = mysqli_query($con, $query);
                while ($info = mysqli_fetch_array ($result) ) {
                    ?>
                    <tr>
                        <th scope="row"> <?php echo $count?></th>
                        <td> <?php echo $info['name'] ?> </td>
                        <td> <?php echo $info['phone'] ?> </td>
                        <td> <?php echo $info['address'] ?> </td>
                        <td> Welding </td>
                    </tr>
                    <?php
                    $count++;
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Edit info modal -->
<div class="modal fade" id="editinfo" tabindex="-1" role="dialog" aria-labelledby="editinfoModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editinfoModalLabel">Edit Your Account</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="post">
                    <div class="form-group">
                        <label for="email">Name</label>
                        <input type="text" class="form-control" name="name" placeholder="<?php echo $_SESSION['name']?>">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" name="email" aria-describedby="emailHelp" placeholder="<?php echo $_SESSION['email']?>">
                    </div>
                    <div class="form-group">
                        <label for="email">Username</label>
                        <input type="text" class="form-control" name="username" placeholder="<?php echo $_SESSION['username']?>">
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" class="form-control" name="password">
                    </div>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!--Footer-->
<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="footer-col">
                <h4>company</h4>
                <ul>
                    <li><a href="#">about us</a></li>
                    <li><a href="#">our services</a></li>
                    <li><a href="#">privacy policy</a></li>
                    <li><a href="#">affiliate program</a></li>
                </ul>
            </div>
            <div class="footer-col">
                <h4>get help</h4>
                <ul>
                    <li><a href="#">FAQ</a></li>
                    <li><a href="#">returns</a></li>
                    <li><a href="#">service status</a></li>
                    <li><a href="#">payment options</a></li>
                </ul>
            </div>
            <div class="footer-col">
                <h4>popular services</h4>
                <ul>
                    <li><a href="#">plumbing</a></li>
                    <li><a href="#">painting</a></li>
                    <li><a href="#">welding</a></li>
                    <li><a href="#">driving</a></li>
                </ul>
            </div>
            <div class="footer-col">
                <h4>follow us</h4>
                <div class="social-links">
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-linkedin-in"></i></a>
                </div>
            </div>
        </div>
    </div>
</footer>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>