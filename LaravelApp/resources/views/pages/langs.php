<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Languages</title>
</head>
<body>
    <ul>
        <?php
            foreach ($items as $item) {
                echo "<li>$item</li>";
            }
        ?>
    </ul>
</body>
</html>
