<?php include'inc/header.php'; ?>

<?php
  $products = $db->get_data();
  if(isset($_POST['delete'])){
    // var_dump( $_POST);
    $ids = $_POST['chk_id'];
    var_dump($ids.length);
    $cnt = 0;
    foreach($ids as $id){
      $db->delete_data($id);
      $cnt++;
    }
    if($cnt == count($ids)){
      header('Location: index.php');
    } else {
      echo '<script>alert("Error:")</script>';
    }
  }
?>


        <main>
          <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?> ?> " method="POST">
            <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-1 mb-4 border-bottom">
                <h2>Product List</h2>
                <div class="col-md-3-end">
                  <button type="button" class="btn btn"><a href="add-product.php" class="text-decoration-none text-black ">ADD</a></button>
                  <button type="submit" id="delete-product-btn" name="delete" class="btn btn">MASS DELETE</button>
                </div>
            </header>
            <div class="row row-cols-1 row-cols-md-3 g-4">
              <?php foreach($products as $product) : ?>
                <div class="col">
                  <div class="card h-100 text-center">
                    <input class="delete-checkbox" type="checkbox" name="chk_id[]" value="<?php echo $product['sku']?>">
                    <div class="card-body">
                      <h5 class="card-title"><?php echo $product['sku'] ?></h5>
                      <p class="card-text"><?php echo $product['name'] ?></p>
                      <p class="card-text"><?php echo $product['price'] ?> $</p>
                      <p class="card-text">
                        <?php 
                        if(!empty($product['size'])){
                          echo 'Size:'. $product['size'] . ' MB';
                        } else if(!empty($product['height']) && !empty($product['width']) && !empty($product['length'])){
                          echo 'Dimensions:' . $product['height'] . ' x ' . $product['width'] . ' x ' . $product['length'];
                        } else if(!empty($product['weight'])){
                          echo 'Weight:'. $product['weight'] . ' KG';
                        }
                        ?>
                      </p>
                    </div>
                  </div>
                </div>
              <?php endforeach; ?>
          
              <div class="mb-3">
                
              </div>
          </form>

        </main>
<?php include'inc/footer.php'; ?>
