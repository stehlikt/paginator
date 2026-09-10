<?php declare(strict_types=1);

function html_escape(string|int $value): string
{
    return htmlspecialchars(
        (string)$value,
        ENT_QUOTES | ENT_SUBSTITUTE,
        'UTF-8',
    );
}

function paginationUrl(int $page, int $perPage): string
{
    return sprintf(
        '?page=%d&per_page=%d',
        $page,
        $perPage,
    );
}

