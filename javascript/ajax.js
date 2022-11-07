$('#productSave').submit('click', function(e){
    e.preventDefault();
    var product_name = $('#product_name').val();
    var price = $('#price').val();
    var qty = $('#qty').val();
    var description = $('#description').val();
    var base_url = $('#base_url').val();
    
    $.ajax({
        url: base_url+ 'product/create_item',
        type: 'post',
        dataType: 'json',
        data: {
            product_name: product_name,
            price: price,
            qty: qty,
            description: description,
        },
        success: function(data){
            // console.log(data);
            $('#product_name').val("");
            $('#price').val("");
            $('#qty').val("");
            $('#description').val("");
            $('#productModal').modal('hide');
            window.location = base_url+'product';
            
        }
    });

})


// search


// $('.deleteBtn').on('click', function(e){
//     e.preventDefault();
//     var base_url = $('#base_url').val();
//     var del_id = $(this).attr("data-id");
//     // var product_id = $('#product_id').val();
   
//     $.ajax({
//         url: base_url+ 'product/delete',
//         type: 'post',
//         dataType: 'json',
//         data: {
//             del_id: del_id,  
//         },
//         success: function(data){
            
//             window.location.reload();
            
//         },
//         error: function(XMLHttpRequest, textStatus, errorThrown) {
//             alert("some error");
//             console.log(XMLHttpRequest);
//          }
//     });
//   });


  $('.editBtn').on('click',function(e){
    e.preventDefault();
    var product_id = $(this).attr("data-id");
    var base_url = $('#base_url').val();
    // console.log(product_id);
    $.ajax({
        url: base_url+ 'product/showEdit',
        type: 'post',
        dataType: 'json',
        data: {
            product_id: product_id,
        },
        success: function(response){
            // console.log(response);
            $('#editProduct_name').val(response.product_name);
            $('#editProduct_price').val(response.price);
            $('#editProduct_qty').val(response.qty);
            $('#editProduct_description').val(response.description);
            $('#editProduct_id').val(response.id);
            

        }
    });
  });



//   transaction section
$('#select_id').on('change',function(){
    var product_id = $(this).val();
    var base_url = $('#base_url').val();
    $.ajax({
        url: base_url+ 'transaction/onchange',
        type: 'post',
        dataType: 'json',
        data: {
            product_id: product_id,
        },
        success: function(response){
            console.log(response);
            $('#addproduct_name').val(response.product_name);
            $('#selected_id').val(response.id);
            $('#product_qty').val(response.qty);
            $('#product_price').val(response.price);
            
        }
    });
})



$('#transactionSave').submit('click', function(e){
    e.preventDefault();
    var base_url = $('#base_url').val();
    var order_qty = $('#order_qty').val();
    var addproduct_name = $('#addproduct_name').val();
    var product_price = $('#product_price').val();
    var amount = order_qty * product_price;
    console.log('clicked');
    $.ajax({
        url: base_url+ 'transaction/addTransaction',
        type: 'post',
        dataType: 'json',
        data: {
            addproduct_name: addproduct_name,
            order_qty: order_qty,
            product_price: product_price,
            amount: amount,

        },
        success: function(response){
            console.log('it works');
            $('#transactionModal').modal('hide');
            window.location = base_url+'transaction';
        }
    });
});



$('.getIdTransactionPrice').on('click', function(e){
    e.preventDefault();
    var product_id = $(this).attr("data-id");
    var base_url = $('#base_url').val();
    console.log(product_id);
    console.log('clicked');

    $.ajax({
        url: base_url+ 'transaction/EditTransactionPrice',
        type: 'post',
        dataType: 'json',
        data: {
            product_id: product_id,
        },
        success: function(response){
            $('#EditTransactionPrice').val(response.price);
            $('#EditTransactionId').val(response.id);
            $('#EditTransactionQty').val(response.qty);


        }
    });

});






 
 



