<?php include 'upload.php'; ?>
<!DOCTYPE html>
<html>
   <head>
      <title>Compress Image</title>
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
   </head>
   <body>
      <div class="container" style="margin-top:20px;">
         <div class="panel panel-primary">
            <div class="panel-heading text-center"><strong>Image Upload and Compress using PHP</strong></div>
            <div class="panel-body">
               <div class="row">
                  <div class="col-sm-8">
                     <form action="" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                           <label><b>Select Image File:</b></label>
                           <input type="file" class="form-control-file border" name="image">
                        </div>
                  </div>
                  <input type="submit" class="btn btn-primary" name="submit" value="Compress Image">
                  </form>
               </div>
               <div class="result">
                  <?php if(!empty($compressedImage)){ ?>
                  <p><b>Original Image Size:</b><?php echo $imageSize; ?> </p>
                  <p><b>Compressed Image Size:</b><?php echo $compressedImageSize; ?></p>
                  <img src="<?php echo $compressedImage; ?>">
                  <?php } ?>
               </div>
            </div>
         </div>
      </div>
   </body>
</html>