<?php view('partials/head') ?>
<div id="app">
    <form action="/products" method="post" id="product_form">
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
                <input type="text" class="form-control" id="sku" name="sku">
            </div>

            <div class="mt-2">
                <label class="form-label" for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name">
            </div>

            <div class="mt-2">
                <label class="form-label" for="price">Price</label>
                <input type="number" class="form-control" id="price" name="price">
            </div>

            <div class="mt-2">
                <label class="form-label" for="type">Type</label>
                <select name="type_id" id="productType" class="form-select" @change="switchType" v-model="type">
                    <?php foreach ($types as $type) : ?>
                        <option value="<?= $type->id ?>"><?= $type->name ?></option>
                    <?php endforeach ?>
                </select>
            </div>

            <div id="">
                <div v-for="(attribute, id) in attributes" :key="id">
                    <label class="form-label" :for="attribute['name']" v-text="attribute['name']"></label>
                    <input :type="attribute['type']" class="form-control" :id="attribute['name'].toLowerCase()" :name="`attributes[${id}]`" :placeholder="`Please provide ${attribute['name'].toLowerCase()}`">
                </div>
            </div>
    </form>
</div>

<?php view('partials/footer') ?>