<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Products_model extends CI_Model {


    public function getProductsByCategorie($categorie){
        $query = $this->db->get_where('productos', array('categorie' => $categorie));
        if ($query->result()) {
            return $query->result();
        } else {
            return false;
        }
    }
    public function getProductById($id){
        $query = $this->db->get_where('productos', array('id' => $id));
        if ($query->result()) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function createProduct($product){
        $query = $this->db->insert('productos', $product);

      if ($this->db->affected_rows() > 0) {
        return true;
      } else {
        return false;
      }
    }
    public function editProduct($product){
        $query = $this->db->update('productos',$product, "id ='{$product['id']}'");
        if ($query) {
          return true;
        } else {
          return false;
        }
    }

    public function deleteProduct($id){
        $product =['id' => $id];
        $query = $this->db->delete('productos',array('id' => $id));
        if ($query) {
            return true;
        } else {
            return false;
        }
    }
    
}