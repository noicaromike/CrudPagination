<div class="container">
    <div class="mt-5">
        <h3>Transaction List</h3>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#transactionModal">
            Create Transaction
        </button>

        <form id="transactionSave" action="" method="POST">
            <input type="hidden" id="base_url" value="<?php echo base_url(); ?>">
            <div class="modal fade" id="transactionModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Create Transaction</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <select class="form-select mb-3" aria-label="Default select example" id="select_id">
                                <option selected>Select Product</option>
                                <?php foreach ($products as $product) : ?>
                                    <option value="<?php echo $product->id; ?>"><?php echo $product->product_name; ?></option>
                                <?php endforeach; ?>
                            </select>
                            <div class="mb-3">
                                <label for="qty" class="form-label">Qty</label>
                                <input type="text" class="form-control" id="order_qty" name="order_qty" placeholder="Enter Product Qty">
                                <span class="p-2 text-sm text-danger" id="ErrorMessage" name="ErrorMessage"></span>
                            </div>
                            <input type="hidden" id="addproduct_name">
                            <input type="hidden" id="selected_id">
                            <input type="hidden" id="product_price">
                            <input type="hidden" id="product_qty">



                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary" id="addTransaction">Add</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <table class="table">
        <thead>
            <tr>

                <th scope="col">Product Name</th>
                <th scope="col">Price</th>
                <th scope="col">Qty</th>
                <th scope="col">Amount</th>
                <th scope="col">Action</th>

            </tr>
        </thead>
        <tbody>
            <?php foreach ($transactions as $transaction) : ?>
                <tr>

                    <td><?php echo $transaction->product_name; ?></td>
                    <td>
                        <button type="button" class="btn btn-sm btn-link getIdTransactionPrice" data-bs-toggle="modal" data-bs-target="#transactionPriceEdit" data-id="<?php echo $transaction->id; ?>">
                            <?php echo $transaction->price; ?>
                        </button>
                    </td>
                    <td><?php echo $transaction->qty; ?></td>
                    <td><?php echo $transaction->amount; ?></td>
                    <td>
                        <form action=" <?php echo base_url('transaction/delete'); ?>" method="post">
                            <input type="hidden" name="transaction_id" value="<?php echo $transaction->id; ?>">
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>

                </tr>
            <?php endforeach; ?>
        </tbody>
        <tfoot>
            <tr>
                <td></td>
                <td></td>
                <td scope="col">Total</td>
                <td><?php echo $totalTransaction; ?></td>

            </tr>
        </tfoot>

    </table>


</div>


<form id="transactionSave" action="<?php echo base_url('transaction/updateProduct'); ?>" method="POST">
    <input type="hidden" id="base_url" value="<?php echo base_url(); ?>">
    <div class="modal fade" id="transactionPriceEdit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Price</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <label for="EditTransactionPrice" class="form-label">Product Price</label>
                    <input type="text" class="form-control" id="EditTransactionPrice" name="EditTransactionPrice">
                    <input type="hidden" id="EditTransactionId" name="EditTransactionId">
                    <input type="hidden" id="EditTransactionQty" name="EditTransactionQty">


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="updatePrice">Update</button>
                </div>
            </div>
        </div>
    </div>
</form>