<div class="container">
    <h3 class="mt-5">CRUD ajax</h3>
    <!-- add modal -->
    <!-- Button trigger modal -->
    <div class="d-flex gap-2 justify-content-between align-items-center">
        <div class="d-flex gap-2">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#productModal">
                Add Product
            </button>
            <a href="<?php echo base_url('transaction'); ?>" class="btn btn-primary ">Create Transaction</a>
        </div>
        <div class="d-flex gap-2 ">
            <form action="<?php echo base_url('product/searchByName'); ?>" method="post">
                <div class="input-group mb-3">
                    <input type="text" id="SearchByName" name="SearchByName" class="form-control" placeholder="Search By Name" aria-label="Search By Name" aria-describedby="button-addon2">
                    <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Search</button>
                </div>
            </form>

        </div>
    </div>

    <!-- Modal -->
    <form id="productSave" action="<?php echo base_url('product/create_item'); ?>" method="POST">
        <input type="hidden" id="base_url" value="<?php echo base_url(); ?>">
        <div class="modal fade" id="productModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add Product Details</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="product" class="form-label">Product Name</label>
                            <input type="text" class="form-control" id="product_name" name="product_name" placeholder="Enter product name">
                        </div>
                        <div class="mb-3">
                            <label for="price" class="form-label">Price</label>
                            <input type="text" class="form-control" id="price" name="price" placeholder="Enter product price">
                        </div>
                        <div class="mb-3">
                            <label for="qty" class="form-label">Qty</label>
                            <input type="text" class="form-control" id="qty" name="qty" placeholder="Enter product Quantity">
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <input class="form-control" id="description" name="description" placeholder="Enter Description">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" id="addProduct">Add Product</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <!-- add modal ends -->


    <table class="table">
        <thead>
            <tr>
                <th scope="col">id</th>
                <th scope="col">Product Name</th>
                <th scope="col">Price</th>
                <th scope="col">Qty</th>
                <th scope="col">Description</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($searchItem)) : ?>
                <?php foreach ($products as $product) : ?>
                    <tr>
                        <td><?php echo $product->id; ?></td>
                        <td><?php echo $product->product_name; ?></td>
                        <td>
                            <?php echo $product->price; ?>
                        </td>
                        <td><?php echo $product->qty; ?></td>
                        <td><?php echo $product->description; ?></td>
                        <td class="d-flex gap-2">

                            <input type="hidden" id="product_id" value="<?php echo $product->id; ?>">
                            <input type="hidden" id="product_price" value="<?php echo $product->price; ?>">

                            <!-- <a id="deleteProduct" data-id="<?php echo $product->id; ?>" class=" btn deleteBtn btn-sm btn-danger">Delete</a> -->
                            <button type="button" class="btn btn-sm btn-success editBtn" data-id="<?php echo $product->id; ?>" data-bs-toggle="modal" data-bs-target="#priceModal">
                                Edit
                            </button>
                            <form action="<?php echo base_url('product/delete'); ?>" method="post">
                                <input type="hidden" name="deleteProduct_id" value="<?php echo $product->id; ?>">
                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                            </form>

                        </td>

                    </tr>
                <?php endforeach; ?>
            <?php else : ?>
                <?php foreach ($searchItem as $search) : ?>
                    <tr>
                        <td><?php echo $search->id; ?></td>
                        <td><?php echo $search->product_name; ?></td>
                        <td>
                            <?php echo $search->price; ?>
                        </td>
                        <td><?php echo $search->qty; ?></td>
                        <td><?php echo $search->description; ?></td>
                        <td class="d-flex gap-2">

                            <input type="hidden" id="product_id" value="<?php echo $search->id; ?>">
                            <input type="hidden" id="product_price" value="<?php echo $search->price; ?>">

                            <!-- <a id="deleteProduct" data-id="<?php echo $search->id; ?>" class=" btn deleteBtn btn-sm btn-danger">Delete</a> -->
                            <button type="button" class="btn btn-sm btn-success editBtn" data-id="<?php echo $search->id; ?>" data-bs-toggle="modal" data-bs-target="#priceModal">
                                Edit
                            </button>
                            <form action="<?php echo base_url('product/delete'); ?>" method="post">
                                <input type="hidden" name="deleteProduct_id" value="<?php echo $search->id; ?>">
                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                            </form>

                        </td>

                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>



    </table>

    <nav aria-label="Page navigation example">
        <?php if (empty($searchItem)) : ?>
            <?php echo $links; ?>
        <?php endif; ?>
    </nav>
</div>



<form action="<?php echo base_url('product/update'); ?>" method="post" id="">
    <div class="modal fade" id="priceModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Product</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="product" class="form-label">Product Name</label>
                        <input type="text" class="form-control" id="editProduct_name" name="editProduct_name" value="">
                        <label for="product" class="form-label">Price</label>
                        <input type="text" class="form-control" id="editProduct_price" name="editProduct_price" value="">
                        <label for="product" class="form-label">Qty</label>
                        <input type="text" class="form-control" id="editProduct_qty" name="editProduct_qty" value="">
                        <label for="product" class="form-label">Description</label>
                        <input type="text" class="form-control" id="editProduct_description" name="editProduct_description" value="">
                        <input type="hidden" id="editProduct_id" name="editProduct_id">

                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="EditPrice">Update</button>
                </div>
            </div>
        </div>
    </div>
</form>