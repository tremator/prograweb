<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Categories_model extends CI_Model {


    public function getFathers(){
        $query = $this->db->get_where('categories', array('father' => 'father'));
        if ($query->result()) {
            return $query->result();
        } else {
            return false;
        }
    }
    public function getById($id){
        $query = $this->db->get_where('categories', array('id' => $id));
        if($query->result()){
            return $query->result();
        }else{
            return false;
        }
    }
    public function getSubCategories($father){
        $query = $this->db->get_where('categories', array('father' => $father));
        if ($query->result()) {
        return $query->result();
        } else {
        return false;
        }
    }
    public function edit($newDataCategorie){
        $query = $this->db->update('categories',$newDataCategorie, "id = '{$newDataCategorie['id']}'");
        if ($query) {
          return true;
        } else {
          return false;
        }
    }
    public function create($categorie){
        $query = $this->db->insert('categories', $categorie);

      if ($this->db->affected_rows() > 0) {
        return true;
      } else {
        return false;
      }
    }
    public function delete($name){
        $categorie =['name' => $name];
        $query = $this->db->delete('categories',$categorie);
        if ($query) {
        return true;
        } else {
        return false;
        }
    }
}