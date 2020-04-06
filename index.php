<?php

require_once 'class/Pagination.php';

$pagination = new Pagination('users');

$users = $pagination->get_data();
$pages = $pagination->get_pagination_numbers();

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagination PDO Class</title>
    <style>
        .active {
            background-color: rgb(23, 169, 201);
            color: white;
        }
    </style>
</head>

<body>
    <ul>
        <?php foreach ($users as $user) : ?>
            <li>
                <?= $user->username . ':' . $user->email ?>
            </li>
        <?php endforeach; ?>
    </ul>
    <hr>

    <a href="?page=<?= $pagination->prev_page() ?>">
        << </a> <?php for ($i = 1; $i <= $pages; $i++) : ?> <a class="<?= $pagination->is_active_page($i); ?>" href="?page=<?= $i ?> "> <?= $i ?>
    </a>
<?php endfor; ?>
<a href="?page=<?= $pagination->next_page() ?>">
    >> </a>
</body>

</html>