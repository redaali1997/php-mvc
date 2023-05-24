<?php view('partials/head') ?>

<body>
    <div id="app">
        <form action="/products" method="post">
            <input type="hidden" name="_method" value="DELETE">
            <input type="hidden" name="_token" value="<?= $csrfToken ?>">
            <header class="flex justify-content-between px-5 py-3 shadow-md">
                <h1 class="text-xl">Product List</h1>
                <div>
                    <a href="/add-product" class="bg-blue-500 mr-6 px-3 py-2 rounded text-white">Add</a>
                    <button type="submit" class="bg-red-800 mr-6 px-3 py-2 rounded text-white">Mass Delete</button>
                </div>
            </header>
            <div class="gap-4 grid grid-cols-4 m-5">
                <?php foreach ($products as $product) : ?>
                    <div class="border-3 border-red-800 p-2 text-center relative">
                        <input type="checkbox" name="products[]" value="<?= $product->id ?>" class="absolute" style="left: 5px;">
                        <p><?= $product->sku ?></p>
                        <p><?= $product->name ?></p>
                        <p><?= $product->price ?> $</p>
                        <p><?= $product->attributes() ?></p>
                    </div>
                <?php endforeach ?>
            </div>
        </form>
    </div>

    <?php view('partials/footer') ?>