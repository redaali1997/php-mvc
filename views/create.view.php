<?php view('partials/head') ?>

<div id="app" class="mb-10">
    <form action="/products" method="post" id="product_form">
        <input type="hidden" name="_token" value="<?= $csrfToken ?>">
        <header class="flex justify-content-between px-5 py-3 shadow-md">
            <h1 class="text-xl">Product Add</h1>
            <div class="mt-2">
                <button type="submit" href="/products" class="bg-blue-500 mr-6 px-3 py-2 rounded text-white">Save</button>
                <a href="/" class="bg-red-800 mr-6 px-3 py-2 rounded text-white">Cancel</a>
            </div>
        </header>

        <div class="container mt-10">
            <div class="mt-2">
                <label class="form-label" for="sku">SKU</label>
                <input type="text" class="form-control" id="sku" name="sku" value="<?= $_SESSION['data']['sku'] ?>">
                <?php if (isset($_SESSION['errors']['sku'])) : ?>
                    <p class="mt-1 text-red-800 text-sm">* <?= $_SESSION['errors']['sku'] ?></p>
                <?php endif ?>
            </div>

            <div class="mt-2">
                <label class="form-label" for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="<?= $_SESSION['data']['name'] ?>">
                <?php if (isset($_SESSION['errors']['name'])) : ?>
                    <p class="mt-1 text-red-800 text-sm">* <?= $_SESSION['errors']['name'] ?></p>
                <?php endif ?>
            </div>

            <div class="mt-2">
                <label class="form-label" for="price">Price</label>
                <input type="number" class="form-control" id="price" name="price" value="<?= $_SESSION['data']['price'] ?>">
                <?php if (isset($_SESSION['errors']['price'])) : ?>
                    <p class="mt-1 text-red-800 text-sm">* <?= $_SESSION['errors']['price'] ?></p>
                <?php endif ?>
            </div>

            <div class="mt-2">
                <label class="form-label" for="type">Type</label>
                <select name="type_id" id="productType" class="form-select" @change="switchType" v-model="type">
                    <?php foreach ($types as $type) : ?>
                        <option value="<?= $type->id ?>" <?= $_SESSION['data']['type_id'] == $type->id ? 'selected' : '' ?>><?= $type->name ?></option>
                    <?php endforeach ?>
                </select>
                <?php if (isset($_SESSION['errors']['type_id'])) : ?>
                    <p class="mt-1 text-red-800 text-sm">* <?= $_SESSION['errors']['type_id'] ?></p>
                <?php endif ?>
            </div>

            <div id="">
                <div v-for="(attribute, id) in attributes" :key="id">
                    <label class="form-label" :for="attribute['name']" v-text="attribute['name'] + ' (' + attribute['unit'] + ')'"></label>
                    <input :type="attribute['type']" class="form-control" :id="attribute['name'].toLowerCase()" :name="`attributes[${id}]`" value="<?= $_SESSION['data'][''] ?>">
                    <p v-if="Object.keys(attributes).length < 2" class="mt-2">Please, provide {{ attribute['name'] }}</p>
                </div>
                <p v-if="Object.keys(attributes).length > 1" class="mt-2">Please, provide dimensions</p>
            </div>
            <?php if (isset($_SESSION['errors']['attributes'])) : ?>
                <p class="mt-1 text-red-800 text-sm">* <?= $_SESSION['errors']['attributes'] ?></p>
            <?php endif ?>
    </form>
</div>

<?php view('partials/footer') ?>