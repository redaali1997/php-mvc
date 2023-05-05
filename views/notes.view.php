<?php require "partials/head.php" ?>
<?php require "partials/nav.php" ?>

<?php require "partials/header.php" ?>

<main>
    <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
        <!-- Your content -->
        <ul>
            <?php foreach ($notes as $note) : ?>
                <li class="text-blue-500 hover:underline">
                    <a href="note?id=<?= $note['id'] ?>">
                        <?= $note['note'] ?>
                    </a>
                </li>
            <?php endforeach ?>
        </ul>
    </div>
</main>

<?php require "partials/foot.php" ?>