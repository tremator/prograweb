<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->load->view('welcome_message');
    }
    
    public function createProductForm(){
       $father = $this->input->get('father');
       $data['father'] = $father;
       $this->load->view('product\product_create_form.php',$data); 
    }
    public function editProductForm(){
        $id = $this->input->get('id');
        $this->load->model('Products_model');
        $result = $this->Products_model->getProductById($id);
        if($result){
            $data['product'] = $result;
            $this->load->view('product/edit_product',$data);
        }else{
            redirect(site_url(['user','login']));
        }
    }
    public function editProduct(){
        $this->load->model('Products_model');
        $this->load->model('Categories_model');
        $image = $this->input->post('image');
        $saveImage = '';
        $fileObject = $_FILES['image'];
        $target_dir = "images/";
        $target_file = $target_dir . basename($fileObject["name"]);
        $uploadOk = 0;
        if (move_uploaded_file($fileObject["tmp_name"], $target_file)) {
            $father = $this->input->post('father');
            $name = $this->input->post('name');
            $description = $this->input->post('description');
            $SKU = $this->input->post('SKU');
            $price = $this->input->post('price');
            $stock = $this->input->post('stock');
            $id = $this->input->post('id');
            $product = ['name' => $name,'id' => $id, 'price' => $price, 'stock' => 0, 'image' => $target_file, 'SKU' => $SKU, 'description' => $description,'stock' => $stock];
            $result = $this->Products_model->editProduct($product);
            if($result){
                $subCatgorie = $this->Categories_model->getSubCategories($father);
                $products = $this->Products_model->getProductsByCategorie($father);
                    $data['categories'] = $subCatgorie;
                    $data['products'] = $products;
                    $data['father'] = $father;
                    $this->load->view('categories/subCategories',$data);
                
            }
        } else {
            $father = $this->input->post('father');
            $name = $this->input->post('name');
            $description = $this->input->post('description');
            $SKU = $this->input->post('SKU');
            $price = $this->input->post('price');
            $stock = $this->input->post('stock');
            $id = $this->input->post('id');
            $product = ['name' => $name,'id' => $id, 'price' => $price, 'stock' => 0, 'SKU' => $SKU, 'description' => $description,'stock' => $stock];
            $result = $this->Products_model->editProduct($product);
            if($result){
                $subCatgorie = $this->Categories_model->getSubCategories($father);
                $products = $this->Products_model->getProductsByCategorie($father);
                    $data['categories'] = $subCatgorie;
                    $data['products'] = $products;
                    $data['father'] = $father;
                    $this->load->view('categories/subCategories',$data);
        }
    }
}
    public function createProduct(){
        $this->load->model('Products_model');
        $this->load->model('Categories_model');
        $saveImage = '';
        $fileObject = $_FILES['image'];
        $target_dir = "images/";
        $target_file = $target_dir . basename($fileObject["name"]);
        $uploadOk = 0;
        if (move_uploaded_file($fileObject["tmp_name"], $target_file)) {
            $name = $this->input->post('name');
            $description = $this->input->post('description');
            $SKU = $this->input->post('SKU');
            $price = $this->input->post('price');
            $father = $this->input->post('father');
            $product = ['name' => $name,'categorie' => $father, 'price' => $price, 'stock' => 0, 'image' => $target_file, 'SKU'=> $SKU,'description' => $description];
            $result = $this->Products_model->createProduct($product);
            if($result){
                $subCatgorie = $this->Categories_model->getSubCategories($father);
                $products = $this->Products_model->getProductsByCategorie($father);
               
                    $data['categories'] = $subCatgorie;
                    $data['products'] = $products;
                    $data['father'] = $father;
                    $this->load->view('categories/subCategories',$data);
               
            }
        } else {
            return '';
        }
    }
    public function deleteProduct(){
        $this->load->model('Categories_model');
        $this->load->model('Products_model');
        $id = $this->input->get('id');
        $father = $this->input->get('father');  
        $result =$this->Products_model->deleteProduct($id);
        if($result){
            $subCatgorie = $this->Categories_model->getSubCategories($father);
            $products = $this->Products_model->getProductsByCategorie($father);
            
                $data['categories'] = $subCatgorie;
                $data['products'] = $products;
                $data['father'] = $father;
                $this->load->view('categories/subCategories',$data);
           
        }
    }
}