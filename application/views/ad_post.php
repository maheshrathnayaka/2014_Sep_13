<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AD Posting</title>

<link rel="stylesheet" href="http://reactiveraven.github.io/jqBootstrapValidation/css/bootstrap.css">

<link rel="stylesheet" href="http://reactiveraven.github.io/jqBootstrapValidation/css/bootstrap.css">

<script>
			<?php 
				require_once(APPPATH.'assets/js/jqBootstrapValidation.js');
			?>
			$(function () { $("input,select,textarea").not("[type=submit]").jqBootstrapValidation(); } );

</script>

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">

<!-- Optional theme -->
<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap-theme.min.css">

<!-- Latest compiled and minified JavaScript -->
		<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
</head>

<body>
        <?php $main_nav = 'post ads' ?>
        <?php require_once (APPPATH . 'views/common/nav_bar.php'); ?>
	<div class="container" style="width:900px; margin:30px auto;">
	<form class="form-horizontal" id="reg-form" role="form" action="<?php echo base_url();?>index.php/ad_post/new_ad" method="post">

	<div class="panel panel-default">

	    <div class="panel-heading">
	     	<h3 class="panel-title"><b>Select Item Category</b></h3>
	    </div>

		<div class="panel-body">

			

				 <div class="form-group">
				    <label class="col-sm-2 control-label">Category</label>
				  		<select class="input-group" id="category" name="category">
				  			<optgroup label="Electronics" data-id="428">
								<option value="mobile_phones" <?php echo set_select('category', 'mobile_phones', TRUE); ?>>Mobile Phones</option>
								<option value="mobile_phone_accessories"<?php echo set_select('category', 'mobile_phone_accessories'); ?>>Mobile Phone Accessories</option>
								<option value="video_games_consoles"<?php echo set_select('category', 'video_games_consoles'); ?>>Video Games & Consoles</option>
								<option value="443">Other Electronics</option>
								<option value="860">Audio & MP3</option>
								<option value="864">TV & Video</option>
								<option value="869">Cameras & Camcorders</option>
								<option value="898">Computers & Accessories</option>
							</optgroup>
							<optgroup label="Animals" data-id="489">
								<option value="Cats"<?php echo set_select('category', 'Cats'); ?>>Cats</option>
								<option value="Dogs"<?php echo set_select('category', 'Dogs'); ?>>Dogs</option>
								<option value="492">Rabbits</option>
								<option value="493">Reptiles</option>
								<option value="494">Birds</option>
								<option value="495">Fish</option>
								<option value="496">Farm Animals</option>
								<option value="499">Accessories</option>
								<option value="502">Other Animals</option>
							</optgroup>
							<optgroup label="Home & Personal Items" data-id="444">
								<option value="445">Furniture</option>
								<option value="455">Home & Garden</option>
								<option value="463">White Goods & Kitchenware</option>
								<option value="470">Clothes, Footwear & Accessories</option>
								<option value="477">Children's Items</option>
								<option value="483">Health & Beauty</option>
								<option value="488">Other Home & Personal Items</option>
							</optgroup>

						</select>
				</div>
			

  		</div>

 </div>

<div class="panel panel-default">
		<div class="panel-heading">
		 <h3 class="panel-title"><b> Add item details</b></h3>
		</div>

		<div class="panel-body">

				<div class="form-group">
					<label class="col-sm-2 control-label">Item Condition </label>
						<select class="input-group" id="item_condition" name="item_condition">
							<option value="select_condition"<?php echo set_select('item_condition', 'select_condition', TRUE); ?>>Select Condition</option>
    						<option value="brand_new"<?php echo set_select('item_condition', 'brand_new'); ?>>Brand New</option>
    						<option value="used"<?php echo set_select('item_condition', 'used'); ?>>Used</option>
    						<option value="4">For parts or not working</option>
						</select>
				</div>
				
				<div class="form-group">
					<label class="col-sm-2 control-label">Title</label> 
					<div class="input-group"><input type="text" name="title" id="title" class="form-control input-sm" data-validation-required-message="Please enter a Title ." required> </div>
				</div>

				<div class="form-group">
					<label class="col-sm-2 control-label">Brand</label>
						<select class="input-group" name="brand" id="brand">
    						<option value="select_brand"<?php echo set_select('brand', 'select_brand', TRUE); ?>>Select brand</option>
							<option value="acer">Acer</option>
							<option value="ag-tel">Ag-tel</option>
							<option value="alcatel">Alcatel</option>
							<option value="apple"<?php echo set_select('brand', 'apple'); ?>>Apple</option>
							<option value="asus">Asus</option>
							<option value="benq">BenQ</option>
							<option value="blackberry">Blackberry</option>
							<option value="china-mobile">China Mobile</option>
							<option value="dell">Dell</option>
							<option value="dialog">Dialog</option>
							<option value="e-tel">E-tel</option>
							<option value="greentel">Greentel</option>
							<option value="google-nexus">Google Nexus</option>
							<option value="hp">HP</option>
							<option value="htc">HTC</option>
							<option value="huawei">Huawei</option>
							<option value="i-mate">I-Mate</option>
							<option value="ipro">iPro</option>
							<option value="lg">LG</option>
							<option value="mega-gate">Mega Gate</option>
							<option value="micromax">Micromax</option>
							<option value="motorola">Motorola</option>
							<option value="nokia">Nokia</option>
							<option value="palm">Palm</option>
							<option value="philips">Philips</option>
							<option value="q-mobile">Q Mobile</option>
							<option value="samsung">Samsung</option>
							<option value="sky">Sky</option>
							<option value="sony">Sony</option>
							<option value="sony-ericsson">Sony Ericsson</option>
							<option value="zigo">Zigo</option>
							<option value="zte">ZTE</option>
							<option value="all_other">Other brands</option>
						</select>
				</div>

				<div class="form-group">
					<label class="col-sm-2 control-label">Modle</label> 
					<div class="input-group"><input type="text" id="modle" name="modle" class="form-control input-sm"> </div>
				</div>

				<div class="form-group">
					<label class="col-sm-2 control-label">Description</label> 
					<div class="input-group"><textarea class="form-control" rows="3" id="description" name="description" style="width:381px"; ></textarea> </div>
				</div>


		</div>
</div>

<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title"><b> Bring your item to life with pictures</b></h3>
		</div>

		<div class="panel-body">
				
				<div class="form-group">
				  <label class="col-sm-2 control-label">  </label> 
				   <div class="input-group"><img src="<?php echo base_url('assests/img/new.jpg'); ?>" hight="155px" width="155px"/></div>
				    <label class="col-sm-2 control-label">  </label>

				    <button type="button" class="btn btn-success" onclick="window.open('http://localhost/AdPosting/index.php/gallery', '_blank', 'location=yes,height=370,width=320,scrollbars=yes,status=yes');">Upload</button>



				</div>

				<div class="form-group">
				   <div class="input-group"><img src="<?php echo base_url('assests/img/new.jpg'); ?>" hight="155px" width="155px"/></div>
				   <button type="button" class="btn btn-success">Upload</button>
				</div>

				<div class="form-group">
				   <div class="input-group"><img src="<?php echo base_url('assests/img/new.jpg'); ?>" hight="155px" width="155px"/></div>
				   <button type="button" class="btn btn-success">Upload</button>
				</div>

				<div class="form-group">
				   <div class="input-group"><img src="<?php echo base_url('assests/img/new.jpg'); ?>" hight="155px" width="155px"/></div>
				   <button type="button" class="btn btn-success">Upload</button>
				</div>
				

		</div>
</div>



<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title"><b> Set a price</b></h3>
		</div>

		<div class="panel-body">

				<div class="form-group">
					<label class="col-sm-2 control-label" >Price</label> 
					<div class="input-group"><input type="text" id="price" name="price" class="form-control input-sm" placeholder="Rs"> </div>
				</div>

		 		<div class="form-group">
			 		<label class="col-sm-2 control-label">Negotiable</label>
					<div class="input-group"><input type="checkbox" name="negotiable" value="1" <?php echo set_checkbox('negotiable', '1'); ?> />
					</div>
				</div>


		</div>
</div>


<div class="panel panel-default">
		<div class="panel-heading">
			<h3 class="panel-title"><b> About you</b></h3>
		</div>

		<div class="panel-body">


				<div class="form-group">
					<label class="col-sm-2 control-label">Name</label> 
					<div class="input-group"><input type="text" id="name" name="name" class="form-control input-sm"> </div>
				</div>


				<div class="form-group">
			    	<label class="col-sm-2 control-label">Email</label>
			    	<div class="input-group"><input type="text" id="email" name="email" class="form-control input-sm" ></div>
			 	</div>

			 	<div class="form-group">
			    	<label class="col-sm-2 control-label">Phone</label>
			    	<div class="input-group"><input type="text" id="phone" name="phone" class="form-control input-sm" ></div>
			 	</div>

			 	<div class="form-group">
			 		<label class="col-sm-2 control-label">Hide Phone No</label>
					<div class="input-group"><input type="checkbox" name="hide_phone_no" value="1" <?php echo set_checkbox('hide_phone_no', '1'); ?> /></div>
				</div>

				<div class="form-group">
        			<label class="col-sm-2 control-label">Location</label>
        				<select class="input-group" id="location" name="location">
        					<option value="selectlocation" <?php echo set_select('location', 'selectlocation', TRUE); ?>>Select a location...</option>
							<option value="">----</option>
							<option value="colombo" <?php echo set_select('location', 'colombo'); ?>>Colombo</option>
							<option value="kandy" <?php echo set_select('location', 'kandy'); ?>>Kandy</option>
							<option value="galle" <?php echo set_select('location', 'galle'); ?>>Galle</option>
							<option value="">--</option>
							<option value="1432">Ampara</option>
							<option value="1452">Anuradhapura</option>
							<option value="1475">Badulla</option>
							<option value="1491">Batticaloa</option>
							<option value="1577">Gampaha</option>
							<option value="1592">Hambantota</option>
							<option value="1605">Jaffna</option>
							<option value="1620">Kalutara</option>
							<option value="1658">Kegalle</option>
							<option value="1670">Kilinochchi</option>
							<option value="1674">Kurunegala</option>
							<option value="1706">Mannar</option>
							<option value="1712">Matale</option>
							<option value="1724">Matara</option>
							<option value="1740">Moneragala</option>
							<option value="1752">Mullativu</option>
							<option value="1757">Nuwara Eliya</option>
							<option value="1763">Polonnaruwa</option>
							<option value="1771">Puttalam</option>
							<option value="1788">Ratnapura</option>
							<option value="1806">Trincomalee</option>
							<option value="1818">Vavuniya</option>
						</select>
				</div>


				




		</div>

				<div class="form-group">
					<label class="col-sm-2 control-label"> </label>

        			<button type="submit" class="btn btn-success btn-lg" value="Submit">Post Ad</button>
				</div>
	</div>
</form>

<div>
</body>
</html>
