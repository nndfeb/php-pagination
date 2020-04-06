<?php

require_once 'class/Pagination.php';

$pagination = new Pagination('users');


$users = $pagination->get_data();
