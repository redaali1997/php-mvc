<?php require "partials/head.php" ?>
<?php require "partials/nav.php" ?>

<?php require "partials/header.php" ?>

<main>
    <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
        <!-- Your content -->
        <p><?= $note['note'] ?></p>

        <a href="/notes" class="text-blue-500 hover:underline">Go Back</a>
    </div>
</main>

<?php require "partials/foot.php" ?>