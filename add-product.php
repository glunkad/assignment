<?php include'inc/header.php'; ?>

<?php
$skuErr = $nameErr = $priceErr = '';
$sku = $name = $price = $size = $weight = $height = $width = $length = '0';
if(isset($_POST['submit'])){
    // Validate SKU
    if(empty($_POST['sku'])){
        $skuErr = 'SKU is required';
    } else {
        $sku = filter_input(INPUT_POST, 'sku', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    }

    // Validate name
    if(empty($_POST['name'])){
      $nameErr = 'Name is required';
    } else {
      $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    }

    // Validate price
    if(empty($_POST['price'])){
      $priceErr = 'Price is required';
    } else {
      $price = filter_input(INPUT_POST, 'price', FILTER_SANITIZE_NUMBER_INT);
    }
    
    if(!empty($_POST['size'])){
      $size = filter_input(INPUT_POST, 'size', FILTER_SANITIZE_NUMBER_INT);
      $height = $weight = $width = $length = '0';
    }
    elseif(!empty($_POST['weight'])){
      $weight = filter_input(INPUT_POST, 'weight', FILTER_SANITIZE_NUMBER_INT);
        $height = $size = $width = $length = '0';
    }
    else{
        $height = filter_input(INPUT_POST, 'height', FILTER_SANITIZE_NUMBER_INT);
        $width = filter_input(INPUT_POST, 'width', FILTER_SANITIZE_NUMBER_INT);
        $length = filter_input(INPUT_POST, 'length', FILTER_SANITIZE_NUMBER_INT);
        $size = $weight = '0';
    }
    
    if(empty($skuErr) && empty($nameErr) && empty($priceErr)){
        $result = $db->insert_data($sku, $name, $price, $size, $height, $width, $length, $weight);
        if($result){
            // header('Location: index.php');
            echo '<script>location.replace("index.php");</script>';
        } else {
          echo '<script>alert("Error!!!")</script>';
        }
    }
    
}
?>
        
        <header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-1 mb-3 border-bottom">
            <h2>Product Add</h2>
        </header>
     
        <main>
            <div class="row justify-content-start my-5">
                <div class="col-lg-6"> 
                    <form action="<?php htmlspecialchars($_SERVER['PHP_SELF']);?>" id="product_form" method="POST">
                        <div class="mb-3">
                            <label for="sku" class="form-label" >SKU</label>
                            <input type="text" class="form-control <?php echo $skuErr ? 'is-invalid' : null ?>" id="sku" name="sku">
                            <div class="invalid-feedback"><?php echo $skuErr; ?></div>
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control <?php echo $nameErr ? 'is-invalid' : null ?>" id="name" name="name">
                            <div class="invalid-feedback"><?php echo $nameErr; ?></div>
                        </div>
                        <div class="mb-3">                            
                            <label for="price" class="form-label" >Price ($)</label>
                            <input type="number" class="form-control <?php echo $priceErr ? 'is-invalid' : null ?>" id="price" name="price">
                            <div class="invalid-feedback"><?php echo $priceErr; ?></div>
                        </div>
                        <div class="mb-3">
                            <label for="type switcher" class="form-label" >Type Switcher</label>
                            <select id="productType" class="form-control" onchange="onChange(event)">
                                <option value="" disabled selected>Type Switcher</option>
                                <option value="dvd">DVD</option>
                                <option value="furniture">Furniture</option>
                                <option value="book">Book</option>
                            </select>
                        </div>
                        <div class="mb-3" id="SIZE">
                            <label for="size" class="form-label" >Size (MB)</label>
                            <input type="number" class="form-control" id="size" name="size">
                        </div>
                        <div class="mb-3" id="WEIGHT">
                            <label for="weight" class="form-label" >Weight (KG)</label>
                            <input type="number" class="form-control" id="weight" name="weight">
                        </div>
                        <div id="DIM">
                            <div class="mb-3">
                                    <label for="height" class="form-label" >Height (CM)</label>
                                    <input type="number" class="form-control" id="height" name="height">
                                
                                <div class="mb-3">
                                    <label for="width" class="form-label" >Width (CM)</label>
                                    <input type="number" class="form-control" id="width" name="width">
                                </div>
                                <div class="mb-3">
                                    <label for="length" class="form-label" >Length (CM)</label>
                                    <input type="number" class="form-control" id="length" name="length">
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <button type="submit" name="submit" value="Save" class="btn">Save</button>
                            <button type="button" class="btn "><a href="index.php" class="text-decoration-none text-black ">Cancel</a></button>
                        </div>
                    </form>
                </div>
            </div>
        </main>
        <script>
        function onChange(e){
            let ele = document.getElementById("productType");
            let value = ele.options[ele.selectedIndex].value;
            if(value == 'dvd'){
                document.getElementById("SIZE").style.display = "block";
                document.getElementById("WEIGHT").style.display = "none";
                document.getElementById("DIM").style.display = "none";
            }else if(value == 'furniture'){
                document.getElementById("DIM").style.display = "block";
                document.getElementById("WEIGHT").style.display = "none";
                document.getElementById("SIZE").style.display = "none";
            }else if(value == 'book'){
                document.getElementById("WEIGHT").style.display = "block";
                document.getElementById("DIM").style.display = "none";
                document.getElementById("SIZE").style.display = "none";
            }
        }
    </script>

<?php include'inc/footer.php'; ?>

