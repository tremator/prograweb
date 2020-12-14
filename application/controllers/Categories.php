<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Categories extends CI_Controller {

  /**
   *  Validate in the database that the user exists
   *
   * @param $username  The username
   * @param $password The user's password
   */
  public function createForm(){
    
    $father = $this->input->get('father');
    $data['father'] = $father;
    $this->load->view('categories/createCategorieForm',$data);
  }

  public function createCategorie(){
    $this->load->model('Categories_model');
    $father = $this->input->post('father');
    $name = $this->input->post('name');
    $description = $this->input->post('description');
    $categorie = ['father' => $father, 'name' => $name, 'description' => $description];
    $this->Categories_model->create($categorie);
    $result = $this->Categories_model->getFathers();
    $data['categories'] = $result;
     $this->load->view('categories/fathers',$data);
  }

  public function getFathers(){
      $this->load->model('Categories_model');
      $result = $this->Categories_model->getFathers();
      if($result){
        $data['categories'] = $result;
        $this->load->view('categories/fathers',$data);
      }else{
        redirect(site_url(['user','login']));
      }
  }
  public function getSubCategories(){
        $father = $this->input->get('father');
        $this->load->model('Categories_model');
        $this->load->model('Products_model');
        $result = $this->Categories_model->getSubCategories($father);
        $products = $this->Products_model->getProductsByCategorie($father);
            $data['categories'] = $result;
            $data['products'] = $products;
            $data['father'] = $father;
            $this->load->view('categories/subCategories',$data);
    }
    public function getClientSubCategories(){
      $father = $this->input->get('father');
      $this->load->model('Categories_model');
      $this->load->model('Products_model');
      $userId = $this->input->get('userId');
      $result = $this->Categories_model->getSubCategories($father);
      $products = $this->Products_model->getProductsByCategorie($father);
          $data['categories'] = $result;
          $data['products'] = $products;
          $data['father'] = $father;
          $data['userId'] = $userId;
          $this->load->view('categories/clientSubCategories',$data);
  }
    public function edit(){
        $id = $this->input->post('id');
        $name = $this->input->post('name');
        $description = $this->input->post('description');
        $father = $this->input->post('father');
        $newDataCategorie = ['id' => $id, 'name' => $name,'description' => $description];
        $this->load->model('Categories_model');
        $this->load->model('Products_model');
        $result =  $this->Categories_model->edit($newDataCategorie);
        if($result){
            $subCategories = $this->Categories_model->getSubCategories($father);
            $products = $this->Products_model->getProductsByCategorie($father);
            $data['categories'] = $subCategories;
            $data['products'] = $products;
            $data['father'] = $father;
            $this->load->view('categories/subCategories',$data);
        }
    }
    public function delete(){
        $this->load->model('Categories_model');
        $father = $this->input->get('father');
        $result = $this->Categories_model->delete($father);
        if($result){
          $result = $this->Categories_model->getFathers();
          if($result){
            $data['categories'] = $result;
            $this->load->view('categories/fathers',$data);
          }else{
            redirect(site_url(['user','login']));
          }
        }
    }
    public function editForm(){ 
      $id = $this->input->get('id');
      $this->load->model('Categories_model');
      $result = $this->Categories_model->getById($id);
      if($result){
        $data['categorie'] = $result;
        $this->load->view('categories/editCategorie',$data);
    }
    }
}   