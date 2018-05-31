<table id="example1" class="table dataTable table-bordered table-striped">
         <thead>
            <tr>
                <th>#</th>
                <th>Category Name</th> 
                <th>Item type</th> 
                <th>Unit of Measure</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
              <?php
                  $i = 0;
                   foreach ($search_list as $search){ 
//            echo '<pre>';            print_r($search); die;
                    switch ($search['item_type_id']){
                        case 1: $item_type = 'Purchased'; break;   
                        case 2: $item_type = 'Service'; break;   
                        case 3: $item_type = 'Manufactured'; break;   
                        default: $item_type='Purchased'; break;
                    }
                       echo '
                           <tr>
                               <td>'.($i+1).'</td>
                               <td>'.$search['category_name'].'</td>
                               <td>'.$item_type.'</td>
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