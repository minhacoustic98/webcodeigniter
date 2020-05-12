<html>
   <!-- the head -->
   <head>
      <meta http-equiv="Content-Type" content="text/html ;charset=utf-8" />
   </head>
   <body>
       <h1 style="margin-top: 100px">Upload file</h1>
       <form method="post" action="<?php echo  admin_url('upload/upload_files') ?>" enctype="multipart/form-data">
                <label>Ảnh minh họa:</label>
                <input type="file"  id="image" name="image">
                <br />
                <label>Ảnh kèm theo:</label><input type="file"  id="image_list" name="image_list[]" multiple>
                <br />
                <input type="submit" class="button" value="Upload" name='submit' />
        </form>
   </body>
</html>