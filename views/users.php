<?php

declare(strict_types=1);

/**
 * @var \Paginator\PaginationResult $result
 */

$firstItem = $result->itemsCount === 0 ? 0 : $result->offset + 1;

$lastItem = min($result->offset + $result->perPage, $result->itemsCount,
);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>DEMO Users</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="/assets/style.css">
</head>

<body data-per-page="<?= html_escape($result->perPage) ?>">
<div class="container py-4 py-md-5">

    <div class="card shadow-sm border-0">
        <div class="card-body p-3 p-md-4">

            <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-2 mb-4">
                <div>
                    <h1 class="h3 mb-1">Users</h1>
                    <p class="text-body-secondary mb-0">
                        Responsive paginated user list
                    </p>
                </div>

                <span class="badge text-bg-light align-self-start">
                    <?= html_escape($result->itemsCount) ?> users
                </span>
            </div>

            <?php if ($result->itemsCount === 0): ?>

                <div class="alert alert-info mb-0">
                    No users found.
                </div>

            <?php else: ?>

                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                        </tr>
                        </thead>

                        <tbody>
                        <?php foreach ($result->items as $user): ?>
                            <?php /** @var \User\User $user */ ?>

                            <tr>
                                <td><?= html_escape($user->id) ?></td>
                                <td class="fw-medium">
                                    <?= html_escape($user->username) ?>
                                </td>
                                <td><?= html_escape($user->email) ?></td>
                            </tr>

                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

                <div class="d-flex flex-column flex-md-row justify-content-between align-items-center gap-3 mt-4">

                    <div class="text-body-secondary small">
                        Showing
                        <strong><?= html_escape($firstItem) ?></strong>
                        –
                        <strong><?= html_escape($lastItem) ?></strong>
                        of
                        <strong><?= html_escape($result->itemsCount) ?></strong>
                    </div>

                    <?php if ($result->pagesCount > 1): ?>

                        <nav aria-label="User pagination">
                            <ul class="pagination mb-0">

                                <li class="page-item <?= $result->hasPreviousPage() ? '' : 'disabled' ?>">
                                    <?php if ($result->hasPreviousPage()): ?>
                                        <a
                                                class="page-link"
                                                href="<?= html_escape(paginationUrl($result->currentPage - 1, $result->perPage)) ?>"
                                                aria-label="Previous page"
                                        >
                                            &laquo;
                                        </a>
                                    <?php else: ?>
                                        <span class="page-link">&laquo;</span>
                                    <?php endif; ?>
                                </li>

                                <?php for ($pageNumber = 1; $pageNumber <= $result->pagesCount; $pageNumber++): ?>

                                    <li class="page-item <?= $pageNumber === $result->currentPage ? 'active' : '' ?>">
                                        <a
                                                class="page-link"
                                                href="<?= html_escape(paginationUrl($pageNumber, $result->perPage)) ?>"
                                                <?= $pageNumber === $result->currentPage ? 'aria-current="page"' : '' ?>
                                        >
                                            <?= html_escape($pageNumber) ?>
                                        </a>
                                    </li>

                                <?php endfor; ?>

                                <li class="page-item <?= $result->hasNextPage() ? '' : 'disabled' ?>">
                                    <?php if ($result->hasNextPage()): ?>
                                        <a
                                                class="page-link"
                                                href="<?= html_escape(paginationUrl($result->currentPage + 1, $result->perPage)) ?>"
                                                aria-label="Next page"
                                        >
                                            &raquo;
                                        </a>
                                    <?php else: ?>
                                        <span class="page-link">&raquo;</span>
                                    <?php endif; ?>
                                </li>

                            </ul>
                        </nav>

                    <?php endif; ?>

                </div>

            <?php endif; ?>

        </div>
    </div>

</div>

<script src="/assets/app.js"></script>
</body>
</html>