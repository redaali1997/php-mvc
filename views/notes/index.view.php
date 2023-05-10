<?php require "views/partials/head.php" ?>
<?php require "views/partials/nav.php" ?>

<?php require "views/partials/header.php" ?>

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

        <a href="/notes/create" class="bg-blue-500 text-white py-2 px-4 round my-4">Add a Note</a>
    </div>
</main>

<?php require "views/partials/foot.php" ?>