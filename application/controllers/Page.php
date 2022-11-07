<?php
class Page extends CI_Controller
{

        public function __construct()
        {
                parent::__construct();
                $this->load->database();
                $this->load->model('Product_model');
                $this->load->library("pagination");
        }

        public function product($action = null)
        {
                $config = array();
                $config["base_url"] = base_url('product');
                $config["total_rows"] = $this->Product_model->count_product();
                $config["per_page"] = 2;
                $config["uri_segment"] = 2;
                $config['full_tag_open'] = '<ul class="pagination justify-content-end gap-2">';
                $config['full_tag_close'] = '</ul>';
                $config['first_link'] = false;
                $config['last_link'] = false;


                $config['first_tag_open'] = '<li class="page-item">';
                $config['first_tag_close'] = '</li>';

                $config['prev_link'] = 'Prev';

                $config['prev_tag_open'] = '<li class="prev">';
                $config['prev_tag_close'] = '</li>';

                $config['next_link'] = 'Next';
                $config['next_tag_open'] = '<li class="page-item">';
                $config['next_tag_close'] = '</li>';

                $config['last_tag_open'] = '<li class="page-item">';
                $config['last_tag_close'] = '</li>';

                $config['cur_tag_open'] = '<li class="page-item active"><a class="page-link" href="#">';
                $config['cur_tag_close'] = '</a></li>';

                $config['num_tag_open'] = '<li class="page-item">';
                $config['num_tag_close'] = '</li>';
                $config['full_tag_close'] = '</ul>';






                $this->pagination->initialize($config);
                $page = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;

                $data["links"] = $this->pagination->create_links();

                $data['products'] = $this->Product_model->get_product($config["per_page"], $page);








                if ($action == 'create_item') {
                        $data = array(
                                'product_name' => $this->input->post('product_name'),
                                'price' => $this->input->post('price'),
                                'qty' => $this->input->post('qty'),
                                'description' => $this->input->post('description'),

                        );
                        $this->Product_model->addProduct($data);

                        echo json_encode($data);
                        exit();
                }

                // if ($action == 'delete') {

                //         $data = array(
                //                 'id' => $this->input->post('del_id'),
                //         );
                //         $this->Product_model->deleteProduct($data);

                //         echo json_encode($data);
                //         exit();
                // }

                if ($action == 'delete') {
                        $id = $this->input->post('deleteProduct_id');
                        $deleted = $this->Product_model->deleteProductById($id);
                        if ($deleted) {
                                redirect(base_url('product'));
                        } else {
                                die('something went wrong');
                        }
                }


                if ($action == 'showEdit') {

                        $id = $this->input->post('product_id');
                        $data = $this->Product_model->getProductById($id);

                        echo json_encode($data);
                        exit();
                }

                if ($action == 'update') {
                        $id = $this->input->post('editProduct_id');
                        $data = array(

                                'price' => $this->input->post('editProduct_price'),
                                'product_name' => $this->input->post('editProduct_name'),
                                'qty' => $this->input->post('editProduct_qty'),
                                'description' => $this->input->post('editProduct_description'),

                        );
                        $update = $this->Product_model->updateProductById($id, $data);
                        if ($update) {
                                redirect(base_url('product'));
                        } else {
                                die('something went wrong');
                        }
                }







                $this->load->view('templates/header');
                $this->load->view('page/product', $data);
                $this->load->view('templates/footer');
        }



        public function transaction($action = null)
        {
                $products = $this->Product_model->getAllProduct();
                $transactions = $this->Product_model->TransactionList();
                $totalTransaction = $this->Product_model->TransactionTotalAmount();
                // var_dump($totalTransaction);
                $data = array(
                        'products' => $products,
                        'transactions' => $transactions,
                        'totalTransaction' => $totalTransaction,
                );


                if ($action == 'onchange') {
                        $id = $this->input->post('product_id');
                        $data = $this->Product_model->getProductById($id);
                        echo json_encode($data);
                        exit();
                }

                if ($action == 'addTransaction') {
                        $data = array(
                                'product_name' => $this->input->post('addproduct_name'),
                                'price' => $this->input->post('product_price'),
                                'qty' => $this->input->post('order_qty'),
                                'amount' => $this->input->post('amount'),

                        );
                        $this->Product_model->addTransaction($data);

                        echo json_encode($data);
                        exit();
                }


                if ($action == 'delete') {
                        $id = $this->input->post('transaction_id');

                        $deleted = $this->Product_model->deleteTransactionById($id);
                        if ($deleted) {
                                redirect(base_url('transaction'));
                        } else {
                                die('Something went wrong');
                        }
                }

                if ($action == 'EditTransactionPrice') {
                        $product_id = $this->input->post('product_id');
                        $data = $this->Product_model->getProductDetails($product_id);
                        echo json_encode($data);
                        exit();
                }

                if ($action == 'updateProduct') {
                        $id = $this->input->post('EditTransactionId');
                        $price = $this->input->post('EditTransactionPrice');
                        $qty = $this->input->post('EditTransactionQty');
                        $amount = $price * $qty;
                        $data = array(
                                'amount' => $amount,
                                'price' => $price,
                        );
                        $updated = $this->Product_model->updateTransactionPrice($data, $id);
                        if ($updated) {
                                redirect(base_url('transaction'));
                        } else {
                                die('something went wrong');
                        }
                }



                $this->load->view('templates/header');
                $this->load->view('page/transaction', $data);
                $this->load->view('templates/footer');
        }
}
