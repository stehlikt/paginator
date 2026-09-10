<?php declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';

$page = filter_input(
    INPUT_GET,
    'page',
    FILTER_VALIDATE_INT,
);

$perPage = filter_input(
    INPUT_GET,
    'per_page',
    FILTER_VALIDATE_INT,
);

$page = $page !== false && $page !== null
    ? $page
    : \Paginator\Paginator::DEFAULT_PAGE;

$perPage = $perPage !== false && $perPage !== null && $perPage > 0 && $perPage <= \Paginator\Paginator::MAXIMUM_PER_PAGE
    ? $perPage
    : \Paginator\Paginator::DEFAULT_PER_PAGE;

$dataProvider = new \User\MockUserRepository();

$paginator = new \Paginator\Paginator(
    dataProvider: $dataProvider,
);

$result = $paginator->paginate(
    page: $page,
    perPage: $perPage,
);

require __DIR__ . '/../views/users.php';
