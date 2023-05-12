<?php view('partials/head.php') ?>
<?php view('partials/nav.php') ?>

<?php view('partials/header.php', ['heading' => $heading]) ?>

<main>
    <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
        <!-- Your content -->
        <p><?= $note['note'] ?></p>

        <form method="POST">
            <input type="hidden" name="_method" value="DELETE">
            <button type="submit" class="text-red-500 my-4">Delete</button>
        </form>

        <a href="/notes" class="text-blue-500 hover:underline">Go Back</a>
    </div>
</main>

<?php view('partials/foot.php') ?>