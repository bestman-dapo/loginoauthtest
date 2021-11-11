<?php
session_start();
if (!isset($_SESSION['access_token'])) {
    if (!isset($_SESSION['state'])) {
        header("location:javascript://history.go(-1)");
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Profile Page</title>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="profile-header">
                <div class="logo"></div>
                <a href="signout.php" class="btn btn-primary">Sign Out</a>
                
            </div>
        </div>
        <div class="row profile-row">
            <div class="col-md-4">
                <div class="text-center">
                    <img src="https://via.placeholder.com/300x250" alt=""><br>
                    <div style="text-align: left;">
                        <h3>Name: <?php echo $_SESSION['first_name']." ".$_SESSION['last_name'];?></h3>
                        <h4 >Gender: <?php echo $_SESSION['gender'];?></h4>
                        <h4 >Email: <?php echo $_SESSION['user_email'];?></h4>
                        <h4 >Username: <?php echo $_SESSION['user_name'];?></h4>
                    </div>
                    <br>

                    <a class="btn btn-primary btn-xs" href="#" role="button">Facebook</a>
                    <a class="btn btn-primary btn-xs" href="#" role="button">Twitter</a>
                    <a class="btn btn-primary btn-xs" href="#" role="button">Instagram</a>
                    <a class="btn btn-primary btn-xs" href="#" role="button">Website</a>
                </div>
            </div>
            <div class="col-md-8">
                <p class="lead profile-row">Lorem ipsum dolor sit amet consectetur adipisicing elit. Sed sunt quis maxime accusamus nesciunt, doloremque tempore debitis odio? Quidem ullam ipsa temporibus assumenda non inventore consequuntur vero velit, iure ipsam. </p> <hr>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ea, incidunt?</p>
                <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Blanditiis enim expedita eaque dolorem corrupti accusamus.</p>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolorem maxime deleniti velit accusamus modi excepturi ullam hic ex fuga odit repellendus, libero earum aliquid molestiae!</p>
                <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Deserunt natus aliquid dignissimos obcaecati assumenda magnam amet eveniet voluptates corrupti inventore?</p>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Blanditiis, accusamus.</p>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Rem sunt, possimus fuga incidunt vel reiciendis commodi sed dolorem alias officiis deleniti minus tenetur, enim, quisquam qui sequi. Sit, quas dolorem.</p>
            </div>
        </div>
    </div>
</body>
</html>

