<?php
include_once("config.php");
if(isset($_GET['mm'])){
    $id = $_GET['mm'];
    $sql = "DELETE FROM bigapp WHERE id=".$id;
   if (mysqli_query($con, $sql)) {
      echo "record deleted successfully";
      //header("Refresh:0");
   }
}
if(isset($_POST['brands'])){
   $brands = $_POST['brands'];
   $min_number = $_POST['min_number'];
   $max_number = $_POST['max_number'];
   $min_amount = $_POST['min_amount'];
   $max_amount = $_POST['max_amount'];
   $brand_ids = implode(",",$brands);
   $sql = "INSERT INTO bigapp (brand_id, min_number, max_number, min_amount, max_amount, status) VALUES ('$brand_ids', '$min_number', '$max_number', '$min_amount', '$max_amount', 1)";
   if (mysqli_query($con, $sql)) {
      echo "New record created successfully";
      //header("Refresh:0");
   }
}
if(isset($_POST['min'])){
   $sql = "INSERT IGNORE INTO bigapp (brand_id, min_number, max_number, min_amount, max_amount, status,) VALUES ('$brand_ids', '$min_number', '$max_number', '$min_amount', '$max_amount', $status)";
   if (mysqli_query($con, $sql)) {
      echo "New record created successfully";
   }
}
?>
<!DOCTYPE html>
<html>
   <head>
      <title>Page</title>
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
      <link rel="stylesheet" type="text/css" href="css/style.css">
      <!-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script> -->
      <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
      
   </head>
   <body>
      <div class="product-wrapper-container">
         <div class="wrap">
            <div class="container">
               <ul class="tabs">
                  
                  <li class="tab-link current" data-tab="tab-2">Product</li>
                  <!-- <li class="tab-link" data-tab="tab-3">Group</li>
                  <!-- <li class="tab-link" data-tab="tab-4">Messages</li>
                  <li class="tab-link" data-tab="tab-4">Preferences</li>
                  <li class="tab-link" data-tab="tab-4">Help</li> -->
               </ul>
               <div id="tab-2" class="tab-content current">
                  <div class="product-container">
                      <p><b> Brand Limits</b></p>
                     <p>Product limits are the minimum and maximum quantity for individual brands that your customers may add to their cart. </p>
                     
                     <div class="inline-toolbox">
                     <div class="toolbar">
                        <div class="Click-here"><button>Add Brand</button></div>        
                          <div class="custom-model-main">
                             <div class="custom-model-inner">        
                               <div class="close-btn">×</div>
                                 <div class="custom-model-wrap">
                                 <form method="post" action="#">
                                    <div class="pop-up-content-wrap">
                                      <h5>Select Brands</h5>
                                      <div class="search-content">
                                          <div class="search">

                                             <svg viewBox="0 0 20 20" class="Polaris-Icon__Svg" focusable="false" aria-hidden="true"><path d="M8 12a4 4 0 1 1 0-8 4 4 0 0 1 0 8zm9.707 4.293-4.82-4.82a5.968 5.968 0 0 0 1.113-3.473 6 6 0 0 0-12 0 6 6 0 0 0 6 6 5.968 5.968 0 0 0 3.473-1.113l4.82 4.82a.997.997 0 0 0 1.414 0 .999.999 0 0 0 0-1.414z"></path></svg>
                                             <!-- <input type="text" name="" placeholder="Type to search"> -->
                                             <select required name="brands[]" class="form-control js-example-placeholder-multiple" multiple="multiple">
                                               <?php
                                               $brand_array = [];
                                                foreach ($bc_products as $bc_key => $product) {
                                                   $brand_array[$product->id] = $product->name;?>
                                                   <option value="<?php echo $product->id;?>"><?php echo $product->name;?></option>
                                                <?php }
                                               ?>
                                             </select>
                                          </div>

                                          <!-- END SEARCH -->
                                        </div>
                                        <!-- END SEARCH-CONTENT -->
                                        <div class="image-checkbox">
                                            <ul>
                                               <li>
                                                 <input required name="min_number" type="text" placeholder="min_number">
                                              
                                               </li>
                                               <li>
                                                 <input required name="max_number" type="text" placeholder="max_number">
                                              
                                               </li>
                                               <li>
                                                 <input required name="min_amount" type="text" placeholder="min_amount">
                                              
                                               </li>
                                               <li>
                                                 <input required name="max_amount" type="text" placeholder="max_amount">
                                              
                                               </li>
                                              </ul>
                                        </div>
                                        <!-- END IMAGE-CHECKBOX -->
                                        <div class="product-select-bottom">
                                           <!-- <div class="stack">
                                              <p>0 products selected</p>
                                           </div> -->
                                           <!-- END STACK -->
                                           <div class="product-btn-container">
                                               <button><a href="">Cancel</a></button>
                                                <button type="submit">select</button>
                                           </div>
                                           </form>
                                           <!-- END PRODUCT-BTN-CONTAINER -->
                                        </div>
                                        <!-- end product-select-bottom -->
                                    </div>
                                    <!-- END POP-UP-CONTENT-WRAP -->
                                 </div>
                                 <!-- end custom-model-wrap -->  
                               </div> 
                               <!-- end custom-model-inner --> 
                           <div class="bg-overlay"></div>
                        </div>
                        <!-- end custom-model-main --> 
                        <!-- <div class="add-button"><button>Add SKU</button></div> 
                        <div class="csv-button"><button>Add By CSV</button></div> -->
                        <div class="csv-model-main">
                             <div class="csv-model-inner">        
                               <div class="close-btn">×</div>
                                 <div class="csv-model-wrap">
                                    <div class="csv-pop-up-content-wrap">
                                     Content Here
                                    </div>
                                 </div>
                                 <!-- end custom-model-wrap -->  
                               </div> 
                               <!-- end custom-model-inner --> 
                           <div class="bg-overlay"></div>
                        </div>
                        <!-- END CUSTOM-MODEL-MAIN --> 
                     </div> 
                     <!-- END TOOLBAR -->
                      <div class="search-container">
                           <div class="search-box">
                              <svg viewBox="0 0 20 20" class="Polaris-Icon__Svg" focusable="false" aria-hidden="true"><path d="M8 12a4 4 0 1 1 0-8 4 4 0 0 1 0 8zm9.707 4.293-4.82-4.82a5.968 5.968 0 0 0 1.113-3.473 6 6 0 0 0-12 0 6 6 0 0 0 6 6 5.968 5.968 0 0 0 3.473-1.113l4.82 4.82a.997.997 0 0 0 1.414 0 .999.999 0 0 0 0-1.414z"></path></svg>
                              <input type="text" name="" placeholder="Type to search">
                           </div>
                       </div>
                       <!-- END SEARCH-CONTAINER -->
                      </div>
                      <!-- END INLINE-TOOLBOX -->
                          <div class="product-table">
                              <div class="product-content">
                                  
                                  <table id="customers" class="Condition">
                                    <!-- <tr class="product-left">
                                      <p>Product</p>
                                  </tr> -->
                                  <!-- END PRODUCT-LEFT -->
                                  <thead >
                                    <tr class="add-sku-container">
                                    <th>Brands</th>
                                    <th>Min quantity</th>
                                    <th>Max quantity</th>
                                    <th>Min amount</th>
                                    <th>Max amount</th>
                                    <th>Remove</th>
                                      <!-- END UL -->
                                </tr></thead> 
                                  <!-- END PRODUCT-RIGHT -->
                                                               </div>
                              <form name="deleteform" method="post" action="#">
                              <?php 
                              $empQuery = "select * from  bigapp WHERE 1=1";
                              //var_dump( $empQuery);die;
                              $empRecords = mysqli_query($con, $empQuery);
                              while ($order = mysqli_fetch_assoc($empRecords)) {
                                 $brand_ids = explode(",",$order['brand_id']);
                                 $brand_name_array = array();
                                 foreach($brand_ids as $brandID){
                                    $brand_name_array[] = $brand_array[$brandID]; 
                                 }
                                 $brand_name = implode(",", $brand_name_array);?>
                              <!-- END PRODUCT-CONTENT -->
                              
                                <input type="hidden" name="brand_id" value="<?php echo $order['id']?>">
                                      <tr class="add-sku-container">
                                          <td>
                                                <?php echo $brand_name?>
                                          </td>
                                          <!-- END SKU-LEFT -->
                                                 <td><?php echo $order['min_number']?></td>
                                                 <td><?php echo $order['max_number']?></td>
                                                 <td><?php echo $order['min_amount']?></td>
                                                 <td><?php echo $order['max_amount']?></td>
                                          <!-- END ADD-SKU-RIGHT -->
                                          <td class="add-remove">
                                              <a href="https://store-sligwemgi.mybigcommerce.com/manage/app/43319?mm=<?php echo $order['id']?>" class="close-remove">×</a>
                                          </td>
                                      </tr>
                                       
                                      <!-- END ADD-SKU-CONTAINER -->
                                 
                              <?php }?></form>
                          </table>
                              
                              
                             
                          </div> 
                          <!-- END PRODUCT-TABLE -->
                  </div>
                  <!-- END PRODUCT-CONTAINER -->
               </div>
               <!-- END TAB-CONTENT -->
               <div id="tab-3" class="tab-content">
                   <div class="group-container">
                       <p><b>What are Group Limits?</b></p>
                       <p>Group limits are limit rules you set that apply across more than one item. You can categorize your items based on a common keyword in product titles, types, handles, variant titles, SKU, collection, tag or by similar price. Please read more tips in this article.</p>
                       <div class="add-row">
                       <div class="group-left">
                          <div class="add-group-section">
                               <button>add group</button> 
                              <nav id="top-nav-menu">
                                <ul class=""> 
                                  <li class="dropdown-select"><a href="#"> <span>&diams;</span> </a>
                                    <ul class="dropdown-menu">
                                      <li><a href="#">Add generic group</a></li>
                                      <li><a href="#">Add SKU List group</a></li>
                                      <li><a href="#">Select profile products</a></li>
                                    </ul>
                                    <!-- END DROPDOWN-MENU -->
                                  </li>
                                </ul>
                              </nav>
                              <!-- END TOP-NAV-MENU -->
                          </div>
                          <!-- END ADD-GROUP-SECTION --> 
                          <div class="add-link-btn">
                             <div class="box">
                               <!-- <a class="add-button" href="#csv-popup1"><button>Add By CSV</button></a> -->
                             </div>
                           <div id="csv-popup1" class="overlay">
                              <div class="popup-container">
                                 <h3>CSV Input</h3>
                                 <a class="close" href="#">&times;</a>
                                 <div class="column-csv">
                                    <div class="group">
                                       <div class="pro-select">
                                        <label>Group by</label>
                                        <select>
                                           <option>product type</option>
                                           <option>Condition Set</option>
                                           <option>Collection</option>
                                           <option>Customer Tag</option>
                                           <option>Description</option>
                                           <option>Price</option>
                                           <option>Product</option>
                                           <option>Product Tag</option>
                                           <option>Product Title</option>
                                           <option>Product Handle</option>
                                           <option>Vendor</option>
                                           <option>Variant Title</option>
                                           <option>SKU</option>
                                           <option>Weight in grams</option>
                                        </select>
                                        </div>
                                        <!-- END PRO-SELECT -->
                                        <div class="equal-select">
                                            <select>
                                           <option>equal to</option>
                                           <option>containing</option>
                                           <option>not containing</option>
                                           <option>not equal to</option>
                                           <option>equal one of</option>
                                           <option>not one of</option>
                                        </select>
                                        </div>
                                        <!-- END EQUAL-SELECT -->
                                    </div>
                                    <!-- END GROUP -->
                                    <div class="form-inline">
                                       <label>CSV Columns:&nbsp;</label>
                                       <span><code>Filter</code>,&nbsp;</span>
                                       <span><code>Title</code>,&nbsp;</span>
                                       <span><code>Min</code>,&nbsp;</span>
                                       <span><code>Max</code>,&nbsp;</span> 
                                       <span><code>Multiple</code></span>
                                    </div>
                                    <!-- end form-inline -->
                                   <div class="form-group">  
                                     <textarea class="form-control"></textarea>
                                   </div>
                                   <!-- end form-group -->
                                 </div>
                                 <!-- END COLUMN-CSV -->
                                 <div class="popup-bottom-row">
                                     <button class="cancel-btn">cancel</button>
                                     <button class="add-btn">Add</button>
                                 </div>
                                 <!-- end popup-bootom-row -->
                              </div>
                              <!-- END POPUP-CONTAINER -->
                           </div>
                           <!-- END CSV-POPUP1 -->
                          </div>
                          <!-- END ADD-LINK-BTN -->
                       </div>
                       <!-- END GROUP-LEFT -->
                       <div class="group-right">
                         <div class="search-container">
                           <div class="search-box">
                              <svg viewBox="0 0 20 20" class="Polaris-Icon__Svg" focusable="false" aria-hidden="true"><path d="M8 12a4 4 0 1 1 0-8 4 4 0 0 1 0 8zm9.707 4.293-4.82-4.82a5.968 5.968 0 0 0 1.113-3.473 6 6 0 0 0-12 0 6 6 0 0 0 6 6 5.968 5.968 0 0 0 3.473-1.113l4.82 4.82a.997.997 0 0 0 1.414 0 .999.999 0 0 0 0-1.414z"></path></svg>
                              <input type="text" name="" placeholder="Type to search">
                           </div>
                           <!-- END SEARCH-BOX -->
                       </div>
                       <!-- END SEARCH-CONTAINER" --> 
                       </div>
                       <!-- END GROUP-RIGHT -->
                       </div>
                       <!-- END ADD-ROW -->
                       
                       <div class="drag-container">
                           <div class="group-limit">
                              <button class="close-icon"><span class="Button__Text">×</span></button>
                              <div class="product-selector">
                                 <div class="price-selection">
                                    <div class="price-wrap">
                                       <label>Group by</label>
                                       <div class="price-box">
                                          <select>
                                             <option>Condition Set</option>
                                             <option>Customer Tag</option>
                                             <option>Description</option>
                                             <option>Price</option>
                                             <option>Product</option>
                                             <option>Product Tag</option>
                                             <option>Product Title</option>
                                             <option>Product Type</option>
                                             <option>Product Handle</option>
                                             <option>Vendor</option>
                                             <option>Variant Title</option>
                                             <option>Weight in grams</option>
                                          </select>
                                       </div>
                                       <!-- END PRICE-BOX -->
                                    </div>
                                    <!-- END PRICE-WRAP -->
                                 </div>
                                 <!-- END PRICE-SELECTION --> 
                                 <div class="equal-section">
                                     <select>
                                        <option>equal to</option>
                                        <option>not equal to</option>
                                        <option>greater than</option>
                                        <option>less than</option>
                                        <option>between</option>
                                     </select>
                                 </div>
                                 <!-- END EQUAL-SECTION -->
                                 <div class="price-input-connect">
                                     <input type="text" name="" value="0.0">
                                 </div>
                                 <!-- END PRICE-INPUT-CONNECT -->
                              </div>
                              <!-- END PRODUCT-SELECTOR -->
                              <div class="title-box">
                                  <label>Title</label>
                                  <input type="text" name="" placeholder="Free item">
                              </div>
                              <div class="quantity-container">
                                 <div class="quantity-row">
                                  <div class="min-quantity">
                                      <label>minimum</label>
                                      <input type="number" name="" placeholder="Min quantity">
                                  </div>
                                  <!-- END MIN-QUANTITY -->
                                  <div class="max-quantity">
                                      <label>maximum</label>
                                      <input type="number" name="" placeholder="Max quantity">
                                  </div>
                                  <!-- END MIN-QUANTITY -->
                                  </div>
                                  <!-- END QUANTITY-ROW -->
                                  <button type="button" class="Polaris-Link">more options</button>
                              </div>
                              <!-- END QUANTITY-CONTAINER -->
                           </div>
                           <!-- END GROUP-LIMIT -->
                       </div>
                       <!-- END DRAG-CONTAINER -->
                       <div class="remove-toolbar">
                           <button>Remove all</button>
                       </div>
                       <!-- END REMOVE-TOOLBAR -->
                   </div>
                   <!-- END GROUP-CONTAINER -->
               </div>
               <!-- END TAB-CONTENT -->
               <!-- <div id="tab-4" class="tab-content">
                  Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim 
               </div> -->
               <!-- END TAB-CONTENT -->
            </div>
            <!-- container -->
         </div>
         <!-- END INNERPADDING -->
      </div>
      <!-- END PRODUCT-WRAPPER-CONTAINER -->

      <!-- Script Start -->
      <script src="js/jquery.min.js"></script>
      <script src="bootstrap/js/bootstrap.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
      <script src="js/main.js"></script>
      

   </body>
</html>
<?php


?>