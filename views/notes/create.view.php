<?php
view('partials/head.php');
view('partials/nav.php');
view('partials/header.php', ['heading' => $heading]);
?>
<main>
    <div class="mx-auto max-w-7xl py-6 sm:px-6 lg:px-8">
        <form method="POST">
            <label for="note"></label>
            <textarea name="note" id="note"><?= $_POST['note'] ?? '' ?></textarea>
            <?php if (isset($errors['note'])) : ?>
                <p class="text-sm text-red-500 mb-2">* <?= $errors['note'] ?></p>
            <?php endif ?>
            <div>
                <button type="submit" class="bg-blue-500 rounded py-2 px-4 text-white">Add</button>
            </div>
        </form>
    </div>
</main>

<?php view('partials/foot.php') ?>