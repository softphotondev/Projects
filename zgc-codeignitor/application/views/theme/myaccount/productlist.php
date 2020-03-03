<div class="page-body vertical-menu-mt">
         <!-- <div class="container-fluid">
            <div class="page-header">
              <div class="row">
                <div class="col-lg-6">
                  <h3><?php //echo $title;?></h3>
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item">Product</li>
                    <li class="breadcrumb-item active"><?php //echo $title;?></li>
                  </ol>
                </div>
                <div class="col-lg-6">
                
                </div>
              </div>
            </div>
     </div>-->

      <?php if ($this->session->flashdata('msg')) { ?><?php echo $this->session->flashdata('msg'); ?><?php } ?> 
          <!-- Container-fluid starts-->
          <div class="container-fluid">
            <div class="row">
              <!-- Individual column searching (text inputs) Starts-->
              <div class="col-sm-12">
                <div class="card">
                  <div class="card-header">
                    <h5><?php echo $title;?></h5>

                  </div>
                  <div class="card-body">
                    <div class="table-responsive product-table">
                   <div id="basic-1_wrapper" class="dataTables_wrapper no-footer">

                      <table class="display dataTable no-footer" id="basic-1" role="grid" aria-describedby="basic-1_info">
                        <thead>
                              <tr>
                              <th>S.No</th>
                              <th>Product Name</th>
                              <th>Category</th>
                              <th>Selling Price</th>
                              <th>Product Cost</th>
                              <th>Quantity</th>
                              <th>Status</th>
                              <th class="text-center">Actions</th>
                              </tr>
                        </thead>
                        <tbody>

                          <?php
             if($products)
                   {
                       foreach($products as $key=>$data)
                       {
						   echo $data->product_id;
                ?>

                <tr>
                <td  class="odd"><?php echo $key+1; ?></td>
                <td><a href="<?php echo site_url('product/view/'.$data->product_id);?>"><?php echo ucfirst($data->product_name); ?></a></td>
                <td><?php echo $category[$data->category_id]; ?></td>
                <td>$<?php echo $data->selling_price; ?></td>
                <td>$<?php echo $data->product_cost; ?></td>
                
                <td><?php echo $data->qty; ?></td>
                
        <td><span class="badge badge-success"><?php echo ($data->status==1)?'Active':'Inactive'; ?></span></td>

        <td>
			<a class="btn btn-success btn-xs" href="<?php echo base_url('checkout/'.$data->product_id); ?>" data-original-title="btn btn-danger btn-xs" title="">Buy Now</a>
			<a class="btn btn-success btn-xs" href="<?php echo base_url('product/view/'.$data->product_id); ?>" data-original-title="btn btn-danger btn-xs" title="">View</a>
            
            <a class="btn btn-warning btn-xs" href="<?php echo base_url('product/copyproduct/'.$data->product_id); ?>" data-original-title="btn btn-warning btn-xs" title="">Copy</a>
            
			<a class="btn btn-success btn-xs" href="<?php echo base_url('product/addproduct/'.$data->product_id); ?>" data-original-title="btn btn-danger btn-xs" title="">Edit</a>
			 <a class="btn btn-danger btn-xs"  href="<?php echo base_url('product/deleteproduct/'.$data->product_id) ?>" onClick="return doconfirm();"  data-original-title="btn btn-danger btn-xs" title="">Delete</a>
                          </td>
                          </tr>
    <?php } } ?>
                        </tbody>
                      </table>

              </div>

           </div>
                  </div>
                </div>
              </div>
              <!-- Individual column searching (text inputs) Ends-->
            </div>
          </div>
          <!-- Container-fluid Ends-->
        </div>
