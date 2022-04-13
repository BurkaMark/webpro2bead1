<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="Cache-control" content="no-cache">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo SITENAME; ?></title>
    <link rel="stylesheet" href="<?php echo URLROOT ?>/public/css/styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@300;400;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700&display=swap" rel="stylesheet" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
</head>
<body>
<div class="head">
    <?php if(isset($_SESSION['user_id'])): ?>
        <p>Bejelentkezett: <?php echo $_SESSION['lastName']; ?> <?php echo $_SESSION['firstName']; ?> (<?php echo $_SESSION['username']; ?>)</p>
    <?php endif; ?>
</div>