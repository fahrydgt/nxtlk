<table id="example1" class="table dataTable11 table-bordered table-striped">
         <thead>
            <tr>
                <th>#</th>
                <th>Image</th> 
                <th>Item code</th> 
                <th>Item name</th> 
                <th>Category</th>  
                <th>Unit of Measure</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
              <?php
                  $i = 0;
                   foreach ($search_list as $search){ 
//            echo '<pre>';            print_r($search); die; 
                       echo '
                           <tr>
                               <td>'.($i+1).'</td>
                               <td><img style="width:30px;height:30px;" src="'. base_url(ITEM_IMAGES.$search['id'].'/'.$search['image']).'"></td> 
                               <td>'.$search['item_code'].'</td> 
                               <td>'.$search['item_name'].'</td> 
                               <td>'.$search['category_name'].'</td> 
                               <td>'.$search['unit_abbreviation'].'</td>
                               <td>';
                                    echo ($this->user_default_model->check_authority($this->session->userdata(SYSTEM_CODE)['user_role_ID'], $this->router->class, 'view'))?'<a href="'.  base_url($this->router->fetch_class().'/view/'.$search['id']).'"><span class="fa fa-eye"></span></a> | ':' ';
                                    echo ($this->user_default_model->check_authority($this->session->userdata(SYSTEM_CODE)['user_role_ID'], $this->router->class, 'edit'))?'<a href="'.  base_url($this->router->fetch_class().'/edit/'.$search['id']).'"><span class="fa fa-pencil"></span></a> | ':' ';
                                    echo ($this->user_default_model->check_authority($this->session->userdata(SYSTEM_CODE)['user_role_ID'], $this->router->class, 'delete'))?'<a href="'.  base_url($this->router->fetch_class().'/delete/'.$search['id']).'"><span class="fa fa-trash"></span></a> ':' ';
                                   
                                echo '</td>  ';
                       $i++;
                   }
              ?>   
        </tbody>
           <tfoot>
           <tr>
               <th>#</th>
                <th>Category</th>
                <th>Item type</th> 
                <th>Unit of Measure</th>
               <th>Action</th>
           </tr>
           </tfoot>
         </table>
<script>
    $(document).ready(function() {
   
  $(".dataTable11").DataTable({"scrollX": true });
} );
</script>