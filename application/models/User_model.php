<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

  /**
   *  Validate in the database that the user exists
   *
   * @param $username  The username
   * @param $password The user's password
   */
  public function authenticate($username, $password){
    $this->load->database();
      $query = $this->db->get_where('users', array('name' => $username, 'password' => $password));
      if ($query->result()) {
        return $query->result()[0];
      } else {
        return false;
      }
  }

  /**
   *  Inserts a new user in the database
   *
   * @param $user  An associative array with all user data
   */
  public function insert($user){
      $query = $this->db->insert('users', $user);

      if ($this->db->affected_rows() > 0) {
        return true;
      } else {
        return false;
      }
  }


  /**
   *  Validate in the database that the user exists
   *
   * @param $username  The username
   * @param $password The user's password
   */
  public function getByName($name){
      $query = $this->db->get_where('users', array('name' => $name));
      if ($query->result()) {
        return $query->result();
      } else {
        return false;
      }
  }
  public function edit($newDataUser){
    $query = $this->db->update('users',$newDataUser, "id = '{$newDataUser['id']}'");
    if ($query) {
      return true;
    } else {
      return false;
    }
  }
  public function delete($id){
    $user =['id' => $id];
    $query = $this->db->delete('users',$user);
    if ($query) {
      return true;
    } else {
      return false;
    }
  }

  /**
   *  Get user by Id
   *
   * @param $id  The user's id
   */
  public function getById($id){
      $query = $this->db->get_where('users', array('id' => $id));
      if ($query->result()) {
        return $query->result();
      } else {
        return false;
      }
  }

  /**
   *  Get all users from the database
   *
   */
  public function all(){
      $query = $this->db->get('users');
      return $query->result();
  }

}