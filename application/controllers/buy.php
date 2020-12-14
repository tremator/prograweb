<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Buy extends CI_Controller {

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

    public function addCartProductForm(){
        $this->load->model('Products_model');
        $productId = $this->input->get('id');
        $userId = $this->input->get('userId');

        $result = $this->Products_model->getProductById($productId);
        if($result){
            $data['product'] = $result;
            $data['userId'] = $userId;
            $this->load->view('userCart/addProduct',$data);
        }else{
            redirect(site_url(['user','login']));
        }
    }

    public function addCartProduct(){
        $this->load->model('Buy_model');
        $userId = $this->input->post('userId');
        $productId = $this->input->post('productId');
        $amount = $this->input->post('amount');
        $price = $this->input->post('price');
        $totalPrice = $amount * $price;
        $product = ['id_user' => $userId, 'id_producto' => $productId, 'cantidad' => $amount, 'precio' => $totalPrice];
        $result = $this->Buy_model->addProduct($product);
        if($result){
            $this->load->model('Categories_model');
            $categories = $this->Categories_model->getFathers();
            $buys = $this->Buy_model->getUserBuys($userId);
            if($categories){
              $data['categories'] = $categories;
              $data['userId'] = $userId;
              $data['buys'] = $buys;
               $this->load->view('user/client',$data);
            }else{
              redirect(site_url(['user','login']));
            }
          
        }
    }
    public function getUserCart(){
        $this->load->model('Buy_model');
        $userId = $this->input->get('userId');
        $result = $this->Buy_model->getUserCart($userId);
        $data['products'] = $result;
        $data['userId'] = $userId;
        $this->load->view('userCart/userCart',$data);
    }

    public function buyCart(){
        $this->load->model('Buy_model');
        $this->load->model('Products_model');
        $userId = $this->input->get('userId');
        $total = $this->input->get('total');
        $result = $this->Buy_model->getUserCart($userId);
        $today = getdate();
        $date = "{$today['year']}/{$today['month']}/{$today['mday']}";
        $order = ['fecha' => $date, 'total' => $total, 'user_id' => $userId];
        $orderId = $this->Buy_model->createOrder($order);
        foreach($result as $product){
            $totalProduct = $product->cantidad * $product->precio;
            $buyProduct = ['id_producto' => $product->id_producto,'cantidad' => $product->cantidad,'total'=> $totalProduct, 'id_user' => $userId, 'fecha' => $date, 'order_id' => $orderId];
            $tarjetproduct = $this->Products_model->getProductById($product->id_producto);
            $newStock = $tarjetproduct[0]->stock - $product->cantidad;
            $this->Products_model->editProduct(['id'=> $tarjetproduct[0]->id,'stock'=>$newStock]);
            $this->Buy_model->buyProduct($buyProduct);
        }
        $this->Buy_model->clearUserCart($userId);
        $this->load->model('Categories_model');
        $result = $this->Categories_model->getFathers();    
        $buys = $this->Buy_model->getUserBuys($userId);    
        $data['categories'] = $result;
        $data['userId'] = $userId;
        $data['buys'] = $buys;
        $this->load->view('user/client',$data);
    }

    public function getDetailBuy(){
        $this->load->model('Buy_model');
        $this->load->model('Products_model');
        $orderId = $this->input->get('orderId');
        $userId = $this->input->get('userId');
        $fecha = $this->input->get('fecha');
        $total = $this->input->get('total');
        $result = $this->Buy_model->getBuyDetail($orderId);
        $detail = [];
        foreach($result as $buy){
            $product = $this->Products_model->getProductById($buy->id_producto);
            $detail[] = ['name' => $product[0]->name,'description' => $product[0]->description,'total' => $buy->total,'cantidad' => $buy->cantidad]; 
        }
        $data['detail'] = $detail;
        $data['userId'] = $userId;
        $data['fecha'] = $fecha;
        $data['total'] = $total;
        $this->load->view('userCart/userBuy',$data);

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
            print('fallo');
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