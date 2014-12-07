<!DOCTYPE html>

<html>

  <head>

    <link href="css/bootstrap.min.css" rel="stylesheet"/>
    <link href="css/bootstrap-theme.min.css" rel="stylesheet"/>
    <link href="css/styles.css" rel="stylesheet"/>
    <link href='http://fonts.googleapis.com/css?family=Exo' rel='stylesheet' type='text/css'>

    <?php if (isset($title)): ?>
     <title>Sensor Cloud: <?= htmlspecialchars($title) ?></title>
    <?php else: ?>
    <title>Sensor Cloud</title>
    <?php endif ?>

    <script src="js/jquery-1.10.2.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/scripts.js"></script>
    <script src="js/Chart.js"></script>

  </head>

  <body>

    <div class="container">

      <div id="top">
      <a href="."><img alt="Sensor Cloud" src="img/logo.gif"/></a>

    </div>
    <div style="width:100%; height:115px margin-left:auto; margin-right:auto">
           <a href="newChart.php"> <span class="mainNavBar">&nbsp;  Custom Chart &nbsp; </span></a>
             <span style="width:15px">&nbsp; </span>
           <a href="myDevices.php"> <span class="mainNavBar">&nbsp;  My Devices &nbsp; </span></a>
             <span style="width:15px">&nbsp; </span>
           <a href="dataMan.php"> <span class="mainNavBar">&nbsp;  Add Data &nbsp; </span></a>
             <span style="width:15px">&nbsp; </span>
           <a href="logout.php"> <span class="mainNavBar">&nbsp;  Log Out &nbsp; </span></a>

    </div>
    <div style="height:25px">&nbsp;
    </div>
    <div id="middle">
