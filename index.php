<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP &bull; MySQL</title>

    <link rel="stylesheet" href="styles.css">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <br>
        <button type="button" class="btn btn-dark" data-toggle="modal" data-target="#dodaj">Dodaj</button>
        <br><br>
        <form action="index.php" method="post">
            <input type="text" class="form-control" name="search" id="search" placeholder="Iskalnik">
        </form>
        <br>
        <button type="button" class="btn btn-dark" onclick="location.href='index.php';">Pokaži vse</button>
        <br><br>
        <table class="table table-light table-hover ">
            <thead class="thead-dark">
                <th>#</th>
                <th>Ime</th>
                <th>Priimek</th>
                <th>Email</th>
            </thead>
            <?php
            $db = new mysqli('localhost', 'root', '', 'razred');
            $db->query("SET NAMES utf8");
            if (isset($_POST['search'])) {
                $sql = "SELECT * FROM dijaki WHERE ime LIKE '%$_POST[search]%' OR priimek LIKE '%$_POST[search]%'";
                $dijaki = $db->query($sql);

                while ($d = $dijaki->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>$d[idDijak]</td>";
                    echo "<td>$d[ime]</td>";
                    echo "<td>$d[priimek]</td>";
                    echo "<td>$d[email]</td>";
                    echo "</tr>";
                }
            } else {
                $sql = "SELECT * FROM dijaki";
                $dijaki = $db->query($sql);

                while ($d = $dijaki->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>$d[idDijak]</td>";
                    echo "<td>$d[ime]</td>";
                    echo "<td>$d[priimek]</td>";
                    echo "<td>$d[email]</td>";
                    echo "</tr>";
                }
            }

            $dijaki->free();
            $db->close();
            ?>
        </table>
    </div>
    <div class="modal fade" id="dodaj" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="dodajModalLongTitle">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="needs-validation" novalidate method="post">
                        <div class="form-row">
                            <div class="col-md-4 mb-3">
                                <label for="ime">Ime</label>
                                <input type="text" class="form-control" name="ime" id="ime" placeholder="ime" value="" required>
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="priimek">Priimek</label>
                                <input type="text" class="form-control" name="priimek" id="priimek" placeholder="Priimek" value="" required>
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="email">Email</label>
                                <input type="text" class="form-control" name="email" id="email" placeholder="Email" value="" required>
                                <div class="valid-feedback">
                                    Looks good!
                                </div>
                            </div>
                        </div>
                        <button class="btn btn-primary" type="submit" name="dodaj">Dodaj</button>
                    </form>
                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>
    <?php
    if (isset($_POST["dodaj"])) {
        $db = new mysqli('localhost', 'root', '', 'razred');
        $sql = "INSERT INTO dijaki(ime, priimek, email) VALUES('$_POST[ime]', '$_POST[priimek]', '$_POST[email]')";
        $db->query($sql);
        $db->close();
        header('Refresh: 0; url=index.php');
    }
    ?>

    <script>
        (function() {
            'use strict';
            window.addEventListener('load', function() {
                var forms = document.getElementsByClassName('needs-validation');
                var validation = Array.prototype.filter.call(forms, function(form) {
                    form.addEventListener('submit', function(event) {
                        if (form.checkValidity() === false) {
                            event.preventDefault();
                            event.stopPropagation();
                        }
                        form.classList.add('was-validated');
                    }, false);
                });
            }, false);
        })();
    </script>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bubbly-bg@1.0.0/dist/bubbly-bg.js"></script>
    <script>
        bubbly({
            colorStart: "#fff4e6",
            colorStop: "#ffe9e4",
            blur: 1,
            compose: "source-over",
            bubbleFunc: () => `hsla(${Math.random() * 50}, 100%, 50%, .3)`
        });;
    </script>
</body>

</html>