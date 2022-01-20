<style>
  .text-sm .dropdown-toggle::after{
   display:none !IMPORTANT;
}
button.btn-secondary-master {
       padding: 0;
}
i.nav-icon.fas.fa-hands-helping.main {
    font-size: 18px;
}
p.master-dro {
    font-size: 17px;
    font-family: ui-monospace;
    padding-left: 4px;
}
</style>
<aside class="main-sidebar sidebar-dark-primary elevation-4 sidebar-no-expand">
        <!-- Brand Logo -->
        <a href="<?php echo base_url();?>admin/dashboard" class="brand-link bg-primary text-sm" style="height: 60px;">
            <?php 
             if(empty($this->session->userdata('is_login'))){
                }
                $sess=$this->session->userdata('is_login');
                $data=$this->db->get_where('tbl_setting',['sess_id'=>$sess])->row_array();
            ?>
        <img src="<?php echo base_url().'uploads/company/'. $data['image'];?>" alt="Store Logo" class="brand-image" style="opacity: .8;width: 10rem;height: 2.5rem;max-height: unset">
        <!--<span class="brand-text font-weight-light"><?php echo $data['firstname'];?></span>-->
        </a>
        <!-- Sidebar -->
        <div class="sidebar os-host os-theme-light os-host-overflow os-host-overflow-y os-host-resize-disabled os-host-transition os-host-scrollbar-horizontal-hidden">
          <div class="os-resize-observer-host observed">
            <div class="os-resize-observer" style="left: 0px; right: auto;"></div>
          </div>
          <div class="os-size-auto-observer observed" style="height: calc(100% + 1px); float: left;">
            <div class="os-resize-observer"></div>
          </div>
          <div class="os-content-glue" style="margin: 0px -8px; width: 249px; height: 646px;"></div>
          <div class="os-padding">
            <div class="os-viewport os-viewport-native-scrollbars-invisible" style="overflow-y: scroll;">
              <div class="os-content" style="padding: 0px 8px; height: 100%; width: 100%;">
                <!-- Sidebar user panel (optional) -->
                <div class="clearfix"></div>
                <!-- Sidebar Menu -->
                <nav class="mt-4">
                   <ul class="nav nav-pills nav-sidebar flex-column text-sm nav-compact nav-flat nav-child-indent nav-collapse-hide-child" data-widget="treeview" role="menu" data-accordion="false">
                    <li class="nav-item dropdown">
                      <a href="<?php echo base_url('admin/dashboard'); ?>" class="nav-link nav-home active">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                          Dashboard
                        </p>
                      </a>
                    </li> 
                    
                  
                   <!--  <li class="nav-header">Master List</li> -->
                    <li class="nav-item dropdown">
                      <a href="<?php echo base_url('admin/items'); ?>" class="nav-link nav-category">
                        <i class="nav-icon fas fa-th-list"></i>
                        <p>
                          Items
                        </p>
                      </a>
                    </li>
                    <li class="nav-item dropdown">
                      <a href="<?php echo base_url('admin/customer'); ?>" class="nav-link nav-product">
                        <i class="nav-icon fas fa-box"></i>
                        <p>
                          Customer
                        </p>
                      </a>
                    </li>
                    <li class="nav-item dropdown">
                      <a href="<?php echo base_url('admin/invoice'); ?>" class="nav-link nav-service">
                        <i class="nav-icon fas fa-hands-helping"></i>
                        <p>
                          Invoice
                        </p>
                      </a>
                    </li>
                     <li class="nav-item dropdown">
                      <a href="<?php echo base_url('admin/account/');?>" class="nav-link nav-system_info">
                        <i class="nav-icon fas fa-hands-helping"></i>
                        <p>
                          Add Account
                        </p>
                      </a>
                    </li>
                    <li class="nav-item dropdown">
                      <a href="<?php echo base_url('admin/company/');?>" class="nav-link nav-system_info">
                        <i class="nav-icon fas fa-hands-helping"></i>
                        <p>
                          Add Company
                        </p>
                      </a>
                    </li>
                    
                   
                    <!--start-->
  <div class="dropdown">
  <button class="btn btn-secondary-master dropdown-toggle" type="button"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" id="dropdownMenuButton">
                  <li class="nav-item dropdown">
                      <a href="#" class="nav-link nav-system_info">
                        <i class="nav-icon fas fa-hands-helping main"></i>
                        <p class="master-dro">master <span><i class="fas fa-sort-down"></i></span></p>
                      </a>
                    </li>
  </button>
  <div class="dropdown-menu ml-5" aria-labelledby="dropdownMenuButton">
   <li class="nav-item dropdown">
                      <a href="<?php echo base_url('admin/master/');?>" class="nav-link nav-system_info">
                        <i class="nav-icon fas fa-hands-helping"></i>
                        <p>
                          Tax Type
                        </p>
                      </a>
                    </li>
                    <li class="nav-item dropdown">
                      <a href="<?php echo base_url('admin/master/invoice');?>" class="nav-link nav-system_info">
                        <i class="nav-icon fas fa-hands-helping"></i>
                        <p>
                          Invoice Number
                        </p>
                      </a>
                    </li>
                    <!--<li class="nav-item dropdown">-->
                    <!--  <a href="<?php echo base_url('admin/master/hsn');?>" class="nav-link nav-system_info">-->
                    <!--    <i class="nav-icon fas fa-hands-helping"></i>-->
                    <!--    <p>-->
                    <!--      HSN Code-->
                    <!--    </p>-->
                    <!--  </a>-->
                    <!--</li>-->
                    <li class="nav-item dropdown">
                      <a href="<?php echo base_url('admin/master/sac');?>" class="nav-link nav-system_info">
                        <i class="nav-icon fas fa-hands-helping"></i>
                        <p>
                          SAC Code
                        </p>
                      </a>
                    </li>
                    <li class="nav-item dropdown">
                      <a href="<?php echo base_url('admin/category/index');?>" class="nav-link nav-system_info">
                        <i class="nav-icon fas fa-hands-helping"></i>
                        <p>
                          Category
                        </p>
                      </a>
                    </li>
                  </div>
                </div>

                    <!---->
                    <!--end-->
                  </ul>
                </nav>
                <!-- /.sidebar-menu -->
              </div>
            </div>
          </div>
          <div class="os-scrollbar os-scrollbar-horizontal os-scrollbar-unusable os-scrollbar-auto-hidden">
            <div class="os-scrollbar-track">
              <div class="os-scrollbar-handle" style="width: 100%; transform: translate(0px, 0px);"></div>
            </div>
          </div>
          <div class="os-scrollbar os-scrollbar-vertical os-scrollbar-auto-hidden">
            <div class="os-scrollbar-track">
              <div class="os-scrollbar-handle" style="height: 55.017%; transform: translate(0px, 0px);"></div>
            </div>
          </div>
          <div class="os-scrollbar-corner"></div>
        </div>
      </aside>
       <script>
            $(document).ready(function(){
              var page = '<?php echo isset($_GET['page']) ? $_GET['page'] : 'home' ?>';
              var s = '<?php echo isset($_GET['s']) ? $_GET['s'] : '' ?>';
              page = page.split('/');
              page = page[0];
              if(s!='')
                page = page+'_'+s;
        
              if($('.nav-link.nav-'+page).length > 0){
                     $('.nav-link.nav-'+page).addClass('active')
                if($('.nav-link.nav-'+page).hasClass('tree-item') == true){
                    $('.nav-link.nav-'+page).closest('.nav-treeview').siblings('a').addClass('active')
                  $('.nav-link.nav-'+page).closest('.nav-treeview').parent().addClass('menu-open')
                }
                if($('.nav-link.nav-'+page).hasClass('nav-is-tree') == true){
                  $('.nav-link.nav-'+page).parent().addClass('menu-open')
                }
        
              }
             
            })
            

  </script>
  