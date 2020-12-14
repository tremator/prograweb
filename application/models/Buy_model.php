<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Buy_model extends CI_Model {


    public function getSales(){
        $query = $this->db->get('ventas');
        if($query->result()){
            return $query->result();
        }else{
            return false;
        }
    }

    public function addProduct($product){
      $query = $this->db->insert('usercart', $product);
      if ($this->db->affected_rows() > 0) {
        return true;
      } else {
        return false;
      }

    }

    public function getUserCart($userId){
      $query = $this->db->get_where('usercart', array('id_user' => $userId));
      if($query->result()){
          return $query->result();
      }else{
          return false;
      }
    } 
    public function createOrder($order){
      $query = $this->db->insert('userbuy', $order);
      if ($this->db->affected_rows() > 0) {
        return $this->db->insert_id();
      } else {
        return false;
      }

    }
    public function buyProduct($product){
      $query = $this->db->insert('ventas', $product);
      if ($this->db->affected_rows() > 0) {
        return true;
      } else {
        return false;
      }
    }
    public function clearUserCart($userId){
      $query = $this->db->delete('usercart', array('id_user'=>$userId));
      
      if ($this->db->affected_rows() > 0) {
        return true;
      } else {
        return false;
      }
    }
    public function getUserBuys($userId){
      $query = $this->db->get_where('userbuy', array('user_id' => $userId));
      if($query->result()){
          return $query->result();
      }else{
          return false;
      }
    } 
    public function getBuyDetail($orderId){
      $query = $this->db->get_where('ventas', array('order_id' => $orderId));
      if($query->result()){
        return $query->result();
      }else{
          return false;
      }
    }
    
}