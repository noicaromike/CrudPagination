<?php

class Product_model extends CI_Model
{
    public function count_product()
    {

        return $this->db->count_all('product');
    }
    public function getSearchResult($data)
    {
        $search = $data['searchByName'];
        $query = $this->db->query("SELECT * FROM product WHERE product_name LIKE '%$search%' ");
        $result = $query->result();
        if ($query) {
            return $result;
        } else {
            return false;
        }
    }
    public function get_product($limit, $start, $search)
    {
        $this->db->limit($limit, $start);
        $query = $this->db->get('product');

        return $query->result();
    }



    public function getAllProduct()
    {
        $query = $this->db->query("SELECT * FROM product");
        $products = $query->result();
        if ($query) {
            return $products;
        } else {
            return false;
        }
    }
    // public function getTotalProduct()
    // {
    //     $query = $this->db->query("SELECT SUM(amount) as totalAmount FROM product");
    //     $totalAmount = $query->row();
    //     if ($query) {
    //         return $totalAmount->totalAmount;
    //     } else {
    //         return false;
    //     }
    // }

    public function addProduct($data)
    {
        $add = $this->db->insert('product', $data);
        if ($add) {
            return true;
        } else {
            return false;
        }
    }
    // public function deleteProduct($data)
    // {
    //     $this->db->where('id', $data['id']);
    //     return $this->db->delete('product');
    // }
    public function deleteProductById($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('product');
    }

    public function getProductById($id)
    {
        $this->db->where('id', $id);
        $query = $this->db->get('product');
        return $query->row_array();
    }

    public function updateProductById($id, $data)
    {
        $this->db->where('id', $id);
        $query = $this->db->update('product', $data);
        if ($query) {
            return true;
        } else {
            return false;
        }
    }
    public function TransactionList()
    {
        $query = $this->db->query("SELECT * FROM transaction ORDER BY id ASC ");
        if ($query) {
            return $query->result();
        } else {
            return false;
        }
    }


    public function TransactionTotalAmount()
    {
        $this->db->select('SUM(amount) as totalAmount');
        $this->db->from('transaction');
        $query = $this->db->get();
        $row = $query->row();
        if ($query) {
            return $row->totalAmount;
        } else {
            return false;
        }
    }



    public function addTransaction($data)
    {
        $addTransaction = $this->db->insert('transaction', $data);
        if ($addTransaction) {
            return true;
        } else {
            return false;
        }
    }

    public function deleteTransactionById($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('transaction');
    }

    public function getProductDetails($product_id)
    {
        $this->db->where('id', $product_id);
        $query = $this->db->get('transaction');
        return $query->row_array();
    }

    public function updateTransactionPrice($data, $id)
    {
        $this->db->where('id', $id);
        $query = $this->db->update('transaction', $data);
        if ($query) {
            return true;
        } else {
            return false;
        }
    }
}
