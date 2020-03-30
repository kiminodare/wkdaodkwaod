<?php 
include 'middleware/session.php';
session_start();
$session = new Checksession();
$session->CheckSession();

?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <title></title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.min.js"></script>
        <link rel="stylesheet" href="Vendor/CSS/checker.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.min.css">

    <link rel="stylesheet" href="Vendor/CSS/loading.css">
    <script src="Vendor/JS/pace.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.6.4/jquery.min.js"></script>
    <script src="Vendor/JS/checker.js"></script>
    <link href='https://fonts.googleapis.com/css?family=Alata' rel='stylesheet'>
    <script src="https://kit.fontawesome.com/226b6b947f.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>

<body>
    <div class="pace">
        <div class="wrapper">
            <div class="sidebar">
                <h2 style="font-family: Alata;">Checker Wibu</h2>
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link active tablinks" data-cheker="gate1" onclick="openGate(event, 'gate1')"
                            href="#"><i class="fas fa-torii-gate"></i>Gate 1</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link tablinks" data-cheker="gate2" onclick="openGate(event, 'gate2')" href="#"><i
                                class="fas fa-torii-gate"></i>Gate 2</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link tablinks" data-cheker="gate3" onclick="openGate(event, 'gate3')"
                            id="defaultOpen" href="#"><i class="fas fa-torii-gate"></i>Gate 3</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="defaultOpen" href="profile.php"><i class="fas fa-torii-gate"></i>profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="defaultOpen" href="middleware/logout.php"><i class="fas fa-torii-gate"></i>Logout</a>
                    </li>
                </ul>
            </div>
            <div id="gate1" class="tabcontent">
                <div id="checker">
                    <div class="form-group">
                        <label class="CreditCard_Gate1" for="CreditCard_Gate1">Credit Card Gate 1</label>
                        <textarea class="form-control" id="CreditCard_Gate1" cols="50" rows="5"></textarea>
                        <div class="buttonHolder">
                            <input name="tatakae" style="" type="submit" class="startbtn" value="Start"></input>
                        </div>
                        <p style="text-align: center;">CHARGE: 0 USD<br>live -2 CRE/ dead -1 CRE<br>RECHECK if UNKNOWN
                        </p>
                        <label class="Label_Gate1" for="Label_Live_Gate1">Results Live</label>
                        <input id="ClearLive_gate1" name="ClearLive_gate1" type="submit" class="startbtn"
                            value="Clear"></input>
                        <textarea class="form-control" id="Results_live_Gate1" name="Results_live_Gate3" cols="50"
                            rows="5" value="tytyd"></textarea>
                        <label class="Label_Gate1" for="Label_Dead_Gate1">Results Dead</label>
                        <input id="ClearDead_gate1" name="ClearDead_gate1" type="submit" class="startbtn"
                            value="Clear"></input>

                        <textarea class="form-control" id="Results_dead_Gate1" name="Results_dead_Gate3" cols="50"
                            rows="5" value="tytyd"></textarea>
                    </div>
                </div>
            </div>

            <div id="gate2" class="tabcontent">
                <div id="checker">
                    <div class="form-group">
                        <label class="CreditCard_Gate2" for="CreditCard_Gate2">Credit Card Gate 2</label>
                        <textarea class="form-control" id="CreditCard_Gate2" cols="40" rows="5"></textarea>
                        <div class="buttonHolder">
                            <input name="tatakae" style="" type="submit" class="startbtn" value="Start"></input>
                        </div>
                        <p style="text-align: center;">CHARGE: 1 USD<br>live -2 CRE/ dead -1 CRE<br>RECHECK if UNKNOWN
                        </p>
                        <label class="Label_Gate2" for="Label_Live_Gate2">Results Live</label>
                        <input id="ClearLive_gate2" name="ClearLive_gate2" type="submit" class="startbtn"
                            value="Clear"></input>
                        <textarea class="form-control" id="Results_live_Gate2" name="Results_live_Gate2" cols="90"
                            rows="5" value="tytyd"></textarea>
                        <label class="Label_Gate2" for="Label_Dead_Gate2">Results Dead</label>
                        <input id="ClearDead_gate2" name="ClearDead_gate2" type="submit" class="startbtn"
                            value="Clear"></input>
                        <textarea class="form-control" id="Results_dead_Gate2" name="Results_dead_Gate2" cols="90"
                            rows="5" value="tytyd"></textarea>
                    </div>
                </div>
            </div>

            <div id="gate3" class="tabcontent">
                <div id="checker">
                    <div class="form-group">
                        <label class="CreditCard_Gate3" for="CreditCard_Gate3">Credit Card Gate 3</label>
                        <textarea class="form-control" id="CreditCard_Gate3" name="CreditCard_Gate3" cols="40"
                            rows="5"></textarea>
                        <div class="buttonHolder">
                            <input name="tatakae" style="" type="submit" class="startbtn" value="Start"></input>
                        </div>
                        <p style="text-align: center;">CHARGE: 0 USD<br>live -2 CRE/ dead -1 CRE<br>RECHECK if UNKNOWN</p>
                        <label class="Label_Gate3" for="Label_Live_Gate3">Results Live</label>
                        <input id="ClearLive_gate3" name="ClearLive_gate3" type="submit" class="startbtn"
                            value="Clear"></input>
                        <textarea class="form-control" id="Results_live_Gate3" name="Results_live_Gate3" cols="90"
                            rows="5"></textarea>
                        <label class="Label_Gate3" for="Label_Dead_Gate3">Results Dead</label>
                        <input id="ClearDead_gate3" name="ClearDead_gate3" type="submit" class="startbtn"
                            value="Clear"></input>
                        <textarea class="form-control" id="Results_dead_Gate3" name="Results_dead_Gate3" cols="90"
                            rows="5"></textarea>
                    </div>
                </div>
            </div>
        </div>
        <script>
            function openGate(evt, cityName) {
                var i, tabcontent, tablinks;
                tabcontent = document.getElementsByClassName("tabcontent");
                for (i = 0; i < tabcontent.length; i++) {
                    tabcontent[i].style.display = "none";
                }
                tablinks = document.getElementsByClassName("tablinks");
                for (i = 0; i < tablinks.length; i++) {
                    tablinks[i].className = tablinks[i].className.replace(" active", "");
                }
                document.getElementById(cityName).style.display = "block";
                evt.currentTarget.className += " active";
            }

            // Get the element with id="defaultOpen" and click on it
            document.getElementById("defaultOpen").click();
        </script>

</body>

</html>