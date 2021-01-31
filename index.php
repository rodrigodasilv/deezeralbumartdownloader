<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Website that downloads album covers from Spofity and Deezer">
    <meta name="keywords" content="Deezer, spotify, album art download, cover album download">
    <title>DAAD - Deezer Album Art Downloader</title>
    <link rel="stylesheet" href="assets/css/bootstrap.css">
    <link rel="stylesheet" href="assets/css/main.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>

<?php
if(isset($_GET['link'])){
    $code = $_GET['link'];
    $link = "https://api.deezer.com/album/" . $code;
    $curl = curl_init();
    curl_setopt_array($curl, array(
    CURLOPT_URL => $link,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",
    CURLOPT_HTTPHEADER => array(
        "cache-control: no-cache"
    ),
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    $response = json_decode($response, true);
    if (isset($response['cover_xl'])){
        $img = $response['cover_xl'];
    }else{
        echo "<div style='border:0' class='red-bg alert alert-warning text-white alert-dismissible fade show' role='alert'>
            <strong>Error:</strong> Please verify the code in the field.
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                <span aria-hidden='true'>&times;</span>
            </button>
        </div>";
    }
}
?>
<body class="dark-bg">
<div class="container">
    <div class="row text-center">
        <div class="col-12">
            <h1 id="header" class="text-white custom-font" style="margin-top: 1em"></h1>
        </div> 
    </div>
    <div class="row text-center">
        <div class="col-12">
            <form action="index.php" method="get">
                <button class="btn" type="submit"><i class="material-icons" style="color: white">cloud_download</i></button>
                <input class="dark-bg bar deezer-border" type="number" name="link" id="link" placeholder="6875949" required="">
            </form>
        </div> 
    </div>
    <div class="row text-center">
        <div class="col-12">
            <div>
                <?php 
                    if(isset($response['cover_xl'])){ echo '<img style="margin-top:2em" class="img-fluid" src='. $img . '>';} 
                ?>
            </div>
        </div>
    </div>
    <div class="row text-center">
        <div class="col-12">
            <h1 class="text-white custom-font" style="margin-top: 1em">How to use?</h1>
        </div>
        <div style="overflow:hidden" class="col-sm-12 col-md-6">
            <img class="img-fluid" src="assets/imgs/instructions.png">
        </div>
        <div class="col-sm-12 col-md-6">
            <h1 style="margin-top:25%" class="text-white custom-font">Copy the last digits of the link of the album you want the cover of...</h1>
        </div>
        <div style="overflow:hidden" class="col-sm-12 col-md-6">
        <h1 style="margin-top:25%" class="text-white custom-font">Paste the digits on the field and click on download. Right-click the cover and download it.</h1>
        </div>
        <div class="col-sm-12 col-md-6">
            <img class="img-fluid" src="assets/imgs/instructions2.png">
        </div>
    </div>
</div>
</body>
    <script src="https://unpkg.com/ityped@1.0.3"></script>
    <script>
        ityped.init(document.querySelector("#header"), {
            loop: false,
            strings: ['Deezer Album Art Downloader']
        })
    </script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="assets/js/bootstrap.js"></script>
</html>
