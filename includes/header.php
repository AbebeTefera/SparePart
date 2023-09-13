<?php 
require_once 'php_action/core.php'; 
error_reporting (E_ALL ^ E_NOTICE); 
?>

<!DOCTYPE html>
<html>
<head>

	<title>Stock Management System</title>

	<!-- bootstrap -->
	<link rel="stylesheet" href="assests/bootstrap/css/bootstrap.min.css">
	<!-- bootstrap theme-->
	<link rel="stylesheet" href="assests/bootstrap/css/bootstrap-theme.min.css">
	<!-- font awesome -->
	<link rel="stylesheet" href="assests/font-awesome/css/font-awesome.min.css">

  <!-- custom css -->
  <link rel="stylesheet" href="custom/css/custom.css">

	<!-- DataTables -->
  <link rel="stylesheet" href="assests/plugins/datatables/jquery.dataTables.min.css">
  <link rel="stylesheet" href="assests/plugins/datatables/dataTables.bootstrap.css">
  <!-- file input -->
  <link rel="stylesheet" href="assests/plugins/fileinput/css/fileinput.min.css">

  <!-- jquery -->
	<script src="assests/jquery/jquery.min.js"></script>
  <!-- jquery ui -->  
  <link rel="stylesheet" href="assests/jquery-ui/jquery-ui.min.css">
  <script src="assests/jquery-ui/jquery-ui.min.js"></script>

  <!-- bootstrap js -->
	<script src="assests/bootstrap/js/bootstrap.min.js"></script>
<?php
	if(isset($_SESSION['userId'])){
		$userId=$_SESSION['userId'];
		
		$mainSql = "SELECT user_id, user_name, user_role_id FROM user WHERE user_id=$userId";
			$mainResult = $connect->query($mainSql);

			if($mainResult->num_rows >0) {
				$value = $mainResult->fetch_assoc();
				$user_id = $value['user_id'];
				$username= $value['user_name'];
				$userroleid= $value['user_role_id'];
				$_SESSION['userName']=$username;
				$_SESSION['userRole']=$userroleid;
			}
	}			
	if($_SESSION['userRole']==1){
		?>
		<!-- custom css header assigns for Admin-->
		<link rel="stylesheet" type="text/css" href="custom/css/admin.css">
		
	<?php
	}else if($_SESSION['userRole']==2){
		?>
		<!-- custom css header assigns for Sales Office-->
		<link rel="stylesheet" type="text/css" href="custom/css/salesOffice.css">
	<?php
	}else if($_SESSION['userRole']==3){
		?>
		<!-- custom css header assigns for Store Keeper-->
		<link rel="stylesheet" type="text/css" href="custom/css/storeKeeper.css">
	<?php
	}else if($_SESSION['userRole']==4){
		?>
		<!-- custom css header assigns for Casher-->
		<link rel="stylesheet" type="text/css" href="custom/css/casher.css">
	<?php
	}else if($_SESSION['userRole']==5){
		?>
		<!-- custom css header assigns for Purchaser-->
		<link rel="stylesheet" type="text/css" href="custom/css/purchaser.css">
	<?php
	}else if($_SESSION['userRole']==6){
		?>
		<!-- custom css header assigns for sales Manager-->
		<link rel="stylesheet" type="text/css" href="custom/css/salesManager.css">
	<?php
	}else if($_SESSION['userRole']==7){
		?>
		<!-- custom css header assigns for Master-->
		<link rel="stylesheet" type="text/css" href="custom/css/master.css">
	<?php
	}else{
		?>
		<!-- custom css header assigns for other user-->
		<link rel="stylesheet" type="text/css" href="custom/css/other.css">
	<?php
	}
?>
</head>
<body>

	<nav class="navbar navbar-default navbar-static-top">
		<div class="container">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
     </div>

    <!-- Collect the nav links, forms, and other content for toggling-->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">      
<ul class="nav navbar-nav navbar-left">
<li><img src="WorkuALogo.jpg" alt="WAASPIE Logo" width="50" height="50"></li>
<li id="logo"><a href="#"> Worku Andarge Auto Spare Part Imp. & Dis. PLC.</a></li>
</ul>
      <ul class="nav navbar-nav navbar-right">        
		<li id="navDashboard"><a href="index.php"><i class="glyphicon glyphicon-list-alt"></i>  Dashboard</a></li>        
            
		<li class="dropdown" id="navProduct">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <i class="glyphicon glyphicon-ruble"></i> Product <span class="caret"></span></a>
          <ul class="dropdown-menu">            
            <li id="navBrand"><a href="brand.php"><i class="glyphicon glyphicon-btc"></i>  Brand</a></li>  
			<li id="navCategories"><a href="categories.php"> <i class="glyphicon glyphicon-th-list"></i> Category</a></li>
			<li id="navShelf"><a href="shelf.php"> <i class="glyphicon glyphicon-list"></i> Shelf</a></li>
			<li id="navStockUnit"><a href="Stock_unit.php"> <i class="glyphicon glyphicon-edit"></i> Stock Unit</a></li>
			<li id="topNavProduct"><a href="product.php"> <i class="glyphicon glyphicon-ruble"></i> Product</a></li>
			<li id="topNavLowstock"><a href="lowstockStore.php"> <i class="glyphicon glyphicon-scale"></i> Low Stock</a></li>			
          </ul>
        </li>
		<li class="dropdown" id="navPrice">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <i class="glyphicon glyphicon-ruble"></i> Price<span class="caret"></span></a>
          <ul class="dropdown-menu">    
            <li id="navManagePrice"><a href="price.php"> <i class="glyphicon glyphicon-edit"></i> Manage Price</a></li>
			<li id="navPricescheme"><a href="price_Scheme.php"> <i class="glyphicon glyphicon-plus"></i> Price Scheme</a></li>
			</ul>
        </li>
		<li class="dropdown" id="navPurchase">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <i class="glyphicon glyphicon-shopping-cart"></i> Purchase <span class="caret"></span></a>
          <ul class="dropdown-menu">
			<li id="topNavVendor"><a href="vendor.php"><i class="glyphicon glyphicon-th-list"></i> Vendor</a></li>
            <li id="topNavAddPurchase"><a href="purchase.php?o=add"> <i class="glyphicon glyphicon-plus"></i> Add Purchases</a></li>   
            <li id="topNavManagePurchase"><a href="purchase.php?o=manpur"> <i class="glyphicon glyphicon-edit"></i> Manage Purchases</a></li>
            <li id="navPRAcc"><a href="PRAcceptance.php"> <i class="glyphicon glyphicon-edit"></i> Purchase Requisition (PR)</a></li>	
            <li id="navGRN"><a href="GRN.php"> <i class="glyphicon glyphicon-edit"></i> Goods Received Note (GRN)</a></li>
			<li id="navPurchaseReport"><a href="purchasereport.php"> <i class="glyphicon glyphicon-check"></i> Purchase Report</a></li> 
			<li id="navPurchaseDetailReport"><a href="purchasedetailreport.php"> <i class="glyphicon glyphicon-check"></i> Purchase Detail Report</a></li>
          </ul>
        </li> 
		
		<li class="dropdown" id="navOrder">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <i class="glyphicon glyphicon-shopping-cart"></i> Sales <span class="caret"></span></a>
          <ul class="dropdown-menu"> 
			<li id="topNavCustomer"><a href="customer.php"><i class="glyphicon glyphicon-king"></i> Customer</a></li>
            <li id="topNavStock"><a href="availablestock.php"> <i class="glyphicon glyphicon-check"></i> Available Stock</a></li>
			<li id="topNavAddOrder"><a href="orders.php?o=add"> <i class="glyphicon glyphicon-plus"></i> Add Orders</a></li>     
            <li id="topNavManageOrder"><a href="orders.php?o=manord"> <i class="glyphicon glyphicon-edit"></i> Manage Orders</a></li>
			<li id="navSalesReport"><a href="salesreport.php"> <i class="glyphicon glyphicon-check"></i> Sales Report</a></li>
			<li id="navSalesDetailReport"><a href="salesdetailreport.php"> <i class="glyphicon glyphicon-check"></i> Sales Detail Report</a></li>
			</ul>
        </li>
		<li class="dropdown" id="navInvoice">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <i class="glyphicon glyphicon-print"></i> Sales Invoice <span class="caret"></span></a>
          <ul class="dropdown-menu">    
            <li id="topNavManage"><a href="manageOrders.php"> <i class="glyphicon glyphicon-edit"></i> Manage Orders</a></li>
			<li id="topNavSR"><a href="SR.php"> <i class="glyphicon glyphicon-edit"></i> Store Requisition (SR)</a></li>
			</ul>
        </li>		
		<li class="dropdown" id="navStore">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <i class="glyphicon glyphicon-th-list"></i> Store <span class="caret"></span></a>
          <ul class="dropdown-menu">            
            <li id="navPRStore"><a href="PR.php"> <i class="glyphicon glyphicon-plus"></i> Purchase Requisition (PR)</a></li>      
            <li id="navGRNAcc"><a href="GRNAcceptance.php"> <i class="glyphicon glyphicon-edit"></i> Goods Received Note (GRN)</a></li>
			<li id="navSRAcc"><a href="SRAcceptance.php"> <i class="glyphicon glyphicon-edit"></i> Store Requisition (SR)</a></li>
			<li id="navSIV"><a href="SIV.php"> <i class="glyphicon glyphicon-edit"></i> Store Issuance Voucher (SIV)</a></li>
			<li id="navStockBalance"><a href="stockbalance.php"> <i class="glyphicon glyphicon-check"></i> Stock Balance</a></li>
			
          </ul>
        </li>
        <li class="dropdown" id="navReport">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <i class="glyphicon glyphicon-check"></i> Report<span class="caret"></span></a>
            <ul class="dropdown-menu">
		    <li id="navPurchaseOutstanding"><a href="purchaseoutstanding.php"> <i class="glyphicon glyphicon-check"></i> Purchase Outstanding </a></li>
			<li id="navSalesOutstanding"><a href="salesoutstanding.php"> <i class="glyphicon glyphicon-check"></i> Sales Outstanding </a></li>
            <li id="navPurchaseReport"><a href="purchasereport.php"> <i class="glyphicon glyphicon-check"></i> Purchase Report</a></li> 
			<li id="navPurchaseDetailReport"><a href="purchasedetailreport.php"> <i class="glyphicon glyphicon-check"></i> Purchase Detail Report</a></li>			
            <li id="navSalesReport"><a href="salesreport.php"> <i class="glyphicon glyphicon-check"></i> Sales Report</a></li>
			<li id="navSalesDetailReport"><a href="salesdetailreport.php"> <i class="glyphicon glyphicon-check"></i> Sales Detail Report</a></li>
			<li id="navStockBalance2"><a href="stockbalance.php"> <i class="glyphicon glyphicon-check"></i> Stock Balance</a></li>           
          </ul>
        </li>
		
		<li class="dropdown" id="navAdmin">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <i class="glyphicon glyphicon-wrench"></i> Admin<span class="caret"></span></a>
          <ul class="dropdown-menu">
		    <li id="topNavUser"><a href="user.php"> <i class="glyphicon glyphicon-edit"></i> Manage User</a></li>
			<li id="topNavRole"><a href="user_role.php"> <i class="glyphicon glyphicon-edit"></i> Manage User Role</a></li>
          </ul>
		  
        </li>
        <li class="dropdown" id="navSetting">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <i class="glyphicon glyphicon-user"></i> <?php echo $_SESSION['userName']; ?><span class="caret"></span> </a>
          <ul class="dropdown-menu">
		    
            <li id="topNavSetting"><a href="setting.php"> <i class="glyphicon glyphicon-wrench"></i> Change Password</a></li>            
            <li id="topNavLogout"><a href="logout.php"> <i class="glyphicon glyphicon-log-out"></i> Logout</a></li>            
          </ul>
		  
        </li>        
               
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
	</nav>

	<div class="container">