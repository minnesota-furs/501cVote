<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <?php include 'includes/head.php'; ?>

    <?php
    if (isset($_POST['submit'])) {
        if (!empty($_POST['accept'])) {
            header("Location:voted.php");
        }
    }
    ?>

    <title>MNFurs Voting - Vote</title>
</head>

<body class="d-flex flex-column h-100">

    <?php include 'includes/nav.php'; ?>
    <?php $voter = $_GET['voteid']; ?>
    <?php $debug = 0; ?>

    <div class="container" role="main">
        <div class="container">
            <div class="py-5 text-center">
                <!-- steps -->
                <ul id="progressbar">
                    <li class="active" id="step1"><strong>Validate</strong></li>
                    <li class="active" id="step2"><strong>Vote</strong></li>
                    <li id="step3"><strong>Submit</strong></li>
                    <li id="step4"><strong>Finished</strong></li>
                </ul>
                <!-- steps end -->
                <i class="fas fa-tasks fa-6x" style="color: Dodgerblue;"></i>
                <h2>Time to Vote!</h2>
                <p class="lead">We found your voter ID in our system. Please make your voting selection for <strong>2</strong> canidates.</p>
            </div>

            <div class="row">
                <div class="col-md-12 order-md-1">
                    <h4 class="mb-3">Step 2: Make vote selections</h4>
                    <form class="" method="POST" action="">
                        <div class="mb-3">
                            <label for="username">Voting Key</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-key"></i></span>
                                </div>
                                <input type="text" class="form-control" id="voterkey" name="voteid" value="<?php echo (isset($voter)) ? $voter : ''; ?>" required disabled>
                            </div>
                        </div>
                        <h4>Canidate Votes</h4>
                        <p>Please select no more than two. Selecting more than 2 will result in your ballot being void, and not counted.</p>

                        <div class="form-check">
                            <input type="hidden" name="canidate_1" value="0" />
                            <input class="form-check-input" type="checkbox" name="canidate_1" id="canidate_1" value="1">
                            <label class="form-check-label" for="canidate_1">
                                Patrick “Kitsunekla/Yancha/Deja” Cain
                            </label>
                        </div>
                        <div class="form-check">
                            <input type="hidden" name="canidate_2" value="0" />
                            <input class="form-check-input" type="checkbox" name="canidate_2" id="canidate_2" value="1">
                            <label class="form-check-label" for="canidate_2">
                                Michael “Midnight” Zupec
                            </label>
                        </div>
                        <div class="form-check">
                            <input type="hidden" name="canidate_3" value="0" />
                            <input class="form-check-input" type="checkbox" name="canidate_3" id="canidate_3" value="1">
                            <label class="form-check-label" for="canidate_3">
                                Cameron “Papillon” Cegelske
                            </label>
                        </div>




                        <hr class="mb-4">
                        <p class="lead">Once your vote is placed, you will not be able to alter your ballot!</p>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="accept" id="accept" required>
                            <label class="form-check-label" for="accept">
                                I understand my vote cannot be changed once placed
                            </label>
                        </div>
                        <button class="btn btn-success btn-lg btn-block" type="submit" name="submit"><i class="fas fa-check-square"></i> Place Vote!</button>
                    </form>

                    <?php
                    if (isset($_POST['submit'])) {
                        include 'dbconnect.php';
                        if ($debug == 1) {
                            echo 'Voter: ' . $voter . '<br>';
                            echo 'Candiate 1: ' . $_POST['canidate_1'] . '<br>';
                            echo 'Candiate 2: ' . $_POST['canidate_2'] . '<br>';
                            echo 'Candiate 3: ' . $_POST['canidate_3'] . '<br>';
                        }

                        $sql = "UPDATE `votes` SET `voted` = '1', `canidate1` = '" . $_POST['canidate_1'] . "', `canidate2` = '" . $_POST['canidate_2'] . "', `canidate3` = '" . $_POST['canidate_3'] . "' WHERE `votes`.`voterId` = '" . $voter . "';";
                        $result = $conn->query($sql);
                        $conn->close();
                        if ($result == 1) {
                            echo "It worked.";
                        } else {
                            echo "Bad!";
                        }
                    }
                    ?>



                </div>
            </div>
        </div>

    </div>
    <?php include 'includes/footer.php'; ?>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
</body>

</html>