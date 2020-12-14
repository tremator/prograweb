<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Welcome to CodeIgniter</title>

	<style type="text/css">

	::selection { background-color: #E13300; color: white; }
	::-moz-selection { background-color: #E13300; color: white; }

	body {
		background-color: #fff;
		margin: 40px;
		font: 13px/20px normal Helvetica, Arial, sans-serif;
		color: #4F5155;
	}

	a {
		color: #003399;
		background-color: transparent;
		font-weight: normal;
	}

	h1 {
		color: #444;
		background-color: transparent;
		border-bottom: 1px solid #D0D0D0;
		font-size: 19px;
		font-weight: normal;
		margin: 0 0 14px 0;
		padding: 14px 15px 10px 15px;
	}

	code {
		font-family: Consolas, Monaco, Courier New, Courier, monospace;
		font-size: 12px;
		background-color: #f9f9f9;
		border: 1px solid #D0D0D0;
		color: #002166;
		display: block;
		margin: 14px 0 14px 0;
		padding: 12px 10px 12px 10px;
	}

	#body {
		margin: 0 15px 0 15px;
	}

	p.footer {
		text-align: right;
		font-size: 11px;
		border-top: 1px solid #D0D0D0;
		line-height: 32px;
		padding: 0 10px 0 10px;
		margin: 20px 0 0 0;
	}

	#container {
		margin: 10px;
		border: 1px solid #D0D0D0;
		box-shadow: 0 0 8px #D0D0D0;
	}
	</style>
</head>
<body>
<button>
	<?php 
		echo anchor("buy/getUserCart?userId=$userId", "Cart");
	?>
</button>
<button>
	<?php
		echo anchor('user/logout', 'Log Out');
	?>
</button>


<div id="container">
	<h1>List of Categories</h1>

	<div id="body">
		<p>This is the list of Categories.</p>

		<table class="table table-light">
      <thead class="thead-light">
        <tr>
          <th>Name</th>
          <th>Last Name</th>
          <th>Username</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <?php
          foreach ($categories as $categorie) {
            $subCategorieLink = anchor("categories/getClientSubCategories?father=$categorie->name&userId=$userId", $categorie->name);
            echo "<tr>
                    <td> $subCategorieLink </a></td>
                    <td>$categorie->description</td>
                    
                  </tr>";
          }
        ?>
      </tbody>
    </table>
	</div>
</div>
<div id="container">
	<h1>List of Categories</h1>

	<div id="body">
		<p>This is the list of your buys.</p>

		<table class="table table-light">
      <thead class="thead-light">
        <tr>
          <th>Name</th>
          <th>Last Name</th>
          <th>Username</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <?php
		if($buys){
          foreach ($buys as $buy) {
            $detailLink = anchor("buy/getDetailBuy?orderId=$buy->id&userId=$userId&total=$buy->total&fecha=$buy->fecha", $buy->fecha);
			echo "<tr>
				<td>$detailLink</td>
                <td> $buy->total </a></td>
                    
                    
                </tr>";
		  }
		}
		else{
			echo 'you dont have buys';
		}
        ?>
      </tbody>
    </table>
	</div>
</div>

</body>
</html>