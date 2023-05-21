<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Create</title>
</head>

<body>
    <h1>Create Product</h1>

    <form action="/products" method="post">
        <div>
            <label for="sku">SKU</label>
            <input type="text" id="sku" name="sku">
        </div>

        <div>
            <label for="name">Name</label>
            <input type="text" id="name" name="name">
        </div>

        <div>
            <label for="price">Price</label>
            <input type="text" id="price" name="price">
        </div>

        <div>
            <label for="type">Type</label>
            <select name="type_id" id="type">
                <?php foreach ($types as $type) : ?>
                    <option value="<?= $type->id ?>"><?= $type->name ?></option>
                <?php endforeach ?>
            </select>
        </div>

        <button type="submit">Add Product</button>
    </form>
</body>

</html>