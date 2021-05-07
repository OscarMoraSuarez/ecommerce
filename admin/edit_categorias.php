 <form action="" method="post">
    
        <div class="form-group">
            <label for="category-title">Editar Categoria</label>
            
             <?php
                 
                 $id_categoria=$_GET["editar"];
            
                 $categoria->get_categoria_por_id($id_categoria);
             ?>
            
        </div>

        <div class="form-group">
            
            <input type="submit" name="editar_categoria" class="btn btn-primary" value="Editar Categoria">
        </div>      


    </form>