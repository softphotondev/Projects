<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/datatables.css">
 <style>
.projects-status {
	margin-bottom: 30px;
}
.custom-support-data { margin-top:25px; margin-bottom:25px; background-color:#fff; padding:10px;}

.label {
    border-radius: 3px;
    color: 
    #fff;
    font-size: 12px;
    line-height: 1;
    margin-bottom: 0;
    text-transform: capitalize;
    padding: 3px 5px;
}
.custom-support-data .fa-reply { margin:0px 10px; color:#158df7; cursor:pointer;}
.custom-support-data .fa-times { color:#d33;}
.supportpopup .modal-header { background: #2b449c; color: #fff;}
.modal-title { text-transform: uppercase; font-weight: 600; font-size: 20px;}
.modal-title span { color: #ffef06;
text-transform: capitalize;
font-size: 15px;
font-weight: 600;
display: inline-block;
padding-left: 15px;}

.modal-header .close { color: #fff; opacity: 1;}
.ticketview-box .ticket-main-info { margin-left: 45px; }
.otherInfo div { display:flex;}
.otherInfo div strong { padding-right:10px;}
.otherInfo div strong span { padding-left:10px;}
.ticket-info-subject {
    font-weight: 600;
    padding: 5px 0px;
    color: 
    #2b449c;
    font-size: 16px;
}
.supportpopup .fa-ticket { color:#319d00;}
.ticketview-box { box-shadow: 0 2px 5px 0 rgba(0,0,0,0.16),0 2px 10px 0 rgba(0,0,0,0.12); border-left: 4px solid #4CAF50; padding: 15px; background:#fff; margin-bottom:25px;} 
.supportpopup .modal-body { background-color:
#f1f1f1;
padding: 25px 25px 75px 25px;
max-height: 350px;
overflow-y: scroll;}
.supportpopup .modal-dialog { top: 0px; }

.ticket-message-box { 
 border-left: 4px solid #FFCB00; 
 padding: 15px; 
 background:#fffeeb; 
 margin-bottom:25px;} 
 
.ticket-message-subject {
    font-weight: 600;
    padding: 5px 0px;
    color: 
    #2b449c;
    font-size: 16px;
}
.ticket-message-box .ticket-message-info { margin-left: 55px; }
.messageTitle { display: flex;
align-content: center;
justify-content: center;
width: 40px;
background:
#ffcb00;
font-size: 18px;
border-radius: 50px;
padding: 5px;
}
.ticket-message-customer-name { color:#2b449c; font-size: 20px; font-weight: 600;}
.ticket-message-message-time { font-size:12px;}
.support-data .modal-footer { position: fixed;
bottom: 0;
width: 100%;
background: #fff;}

.projects-status {
    margin-bottom: 0;
}
button.close { background:none !important;}
table.dataTable > tbody > tr.child ul.dtr-details {
    display: inline-block;
    list-style-type: none;
    margin: 0;
    width: 100%;
    background: #f6f6f6;
    padding: 15px;
}
.addNewTicket .modal-content { padding:15px;}

@media(min-width:768px){
	.supportList {
    display: flex;
    justify-content: center;
    align-items: center; padding:0px;
}
.list-staus h2 { padding:0px 5px;}
}

.ticket-form { padding:15px;}
.page-wrapper .page-body-wrapper .page-body {    
    margin-top: 0px; 
    padding: 15px 15px;    
    
}
.myaccount-profile {
     padding-top: 0px;    
}
</style>
 <div class="page-body vertical-menu-mt">
          <div class="container-fluid">
		  
            <div class="page-header">
              <div class="row">
                <div class="col-lg-6">
                  <h3> DASHBOARD </h3>
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="<?php echo base_url('myaccount');?>">Home</a></li>
                    <li class="breadcrumb-item">Dashboard</li>
                    <li class="breadcrumb-item active">default</li>
                  </ol>
                </div>
              </div>
            </div>
		 </div>
		 
          <!-- Container-fluid starts-->
          <div class="container-fluid">
            <div class="row">
              <div class="col-lg-12 xl-100">
                <!-- <div class="row">
                  <div class="col-xl-3 xl-50 col-md-6 box-col-6">
                    <div class="card">
                      <div class="card-body tag-card">
                        <div class="progressbar-widgets">
                          <div class="media media-widgets">
                            <div class="media-body">
                              <p class="mb-0">Total Sale</p>
                              <h3 class="mt-0 mb-0 f-w-600">
                              <i data-feather="dollar-sign"></i><span class="counter">841,162</span></h3>
                            </div><span class="badge flat-badge-secondary">3.56%<i class="fa fa-caret-up"></i></span>
                          </div>
                          <div class="progress sm-progress-bar progress-animate">
                            <div class="progress-gradient-secondary" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"><span class="font-secondary">75%</span><span class="animate-circle"></span></div>
                          </div><span class="tag-content-secondary tag-hover-effect"><i data-feather="trending-up"></i></span>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-xl-3 xl-50 col-md-6 box-col-6">
                    <div class="card">
                      <div class="card-body tag-card">
                        <div class="progressbar-widgets">
                          <div class="media media-widgets">
                            <div class="media-body">
                              <p class="mb-0">Total Purchase</p>
                              <h3 class="mt-0 mb-0 f-w-600"><i data-feather="dollar-sign"></i><span class="counter">123,461</span><span><i class="font-success" data-feather="trending-up"></i></span></h3>
                            </div><span class="badge flat-badge-success">3.56%<i class="fa fa-caret-up"></i></span>
                          </div>
                          <div class="progress sm-progress-bar progress-animate">
                            <div class="progress-gradient-success" role="progressbar" style="width: 80%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"><span class="font-success">80%</span><span class="animate-circle"></span></div>
                          </div><span class="tag-content-success tag-hover-effect"><i data-feather="trending-up">     </i></span>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-xl-3 xl-50 col-md-6 box-col-6">
                    <div class="card bg-primary">
                      <div class="card-body tag-card">
                        <div class="progressbar-widgets">
                          <div class="media media-widgets">
                            <div class="media-body">
                              <p class="mb-0 font-light">Active Customers</p>
                              <h3 class="mt-0 mb-0 f-w-600"><span class="counter">10,14,125</span><span><i class="font-light" data-feather="trending-up"></i></span></h3>
                            </div><span class="badge flat-badge-light font-primary">01.36<i class="fa fa-caret-up"></i></span>
                          </div>
                          <div class="progress sm-progress-bar progress-animate">
                            <div class="progress-gradient-light" role="progressbar" style="width: 65%" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"><span class="animate-circle"></span></div>
                          </div><span class="tag-content-light tag-light tag-hover-effect"><i data-feather="trending-up">    </i></span>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-xl-3 xl-50 col-md-6 box-col-6">
                    <div class="card">
                      <div class="card-body tag-card">
                        <div class="progressbar-widgets">
                          <div class="media media-widgets">
                            <div class="media-body">
                              <p class="mb-0">New Customers</p>
                              <h3 class="mt-0 mb-0 f-w-600"><span class="counter">9,00,563</span><span><i class="font-primary" data-feather="trending-up"></i></span></h3>
                            </div><span class="badge flat-badge-primary">6.23%<i class="fa fa-caret-up"></i></span>
                          </div>
                          <div class="progress sm-progress-bar progress-animate">
                            <div class="progress-gradient-primary" role="progressbar" style="width: 95%" aria-valuenow="95" aria-valuemin="0" aria-valuemax="100"><span class="animate-circle"></span></div>
                          </div><span class="tag-content-primary tag-hover-effect"><i data-feather="trending-up">     </i></span>
                        </div>
                      </div>
                    </div>
                  </div>
                </div> -->
                <div class="row">
                  <div class="col-xl-3 col-md-3 box-col-6">
                    <div class="card">
                      <div class="card-body tag-card">
                        <div class="progressbar-widgets">
                          <div class="media media-widgets">
                            <div class="media-body">
                              <p class="mb-2">Total Sale</p>
                              <h3 class="mt-0 mb-0 f-w-600">
                                <i data-feather="dollar-sign"></i><?php echo $totalsale; ?>
                              </h3>
                            </div>
                            <!-- <span class="badge flat-badge-secondary">3.56%<i class="fa fa-caret-up"></i></span> -->
                          </div>
                          <!-- <div class="progress sm-progress-bar progress-animate">
                            <div class="progress-gradient-secondary" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"><span class="font-secondary">75%</span><span class="animate-circle"></span></div>
                          </div> -->
                          <!-- <span class="tag-content-secondary tag-hover-effect"><i data-feather="trending-up"></i></span> -->
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-xl-3 col-md-3 box-col-6">
                    <div class="card">
                      <div class="card-body tag-card">
                        <div class="progressbar-widgets">
                          <div class="media media-widgets">
                            <div class="media-body">
                              <p class="mb-2">Total Orders</p>
                              <h3 class="mt-0 mb-0 f-w-600">
                                <?php
                                echo $totalorders;
                                ?>
                              </h3>
                            </div>
                            <!-- <span class="badge flat-badge-success">3.56%<i class="fa fa-caret-up"></i></span> -->
                          </div>
                          <!-- <div class="progress sm-progress-bar progress-animate">
                            <div class="progress-gradient-success" role="progressbar" style="width: 80%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"><span class="font-success">80%</span><span class="animate-circle"></span></div>
                          </div> -->
                          <!-- <span class="tag-content-success tag-hover-effect"><i data-feather="trending-up">     </i></span> -->
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-xl-3 col-md-3 box-col-6">
                    <div class="card">
                      <div class="card-body tag-card">
                        <div class="progressbar-widgets">
                          <div class="media media-widgets">
                            <div class="media-body">
                              <p class="mb-2">Total Clients</p>
                              <h3 class="mt-0 mb-0 f-w-600">
                                <?php
                                echo $activeclients;
                                ?>
                              </h3>
                            </div>
                            <!-- <span class="badge flat-badge-light font-primary">01.36<i class="fa fa-caret-up"></i></span> -->
                          </div>
                          <!-- <div class="progress sm-progress-bar progress-animate">
                            <div class="progress-gradient-light" role="progressbar" style="width: 65%" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"><span class="animate-circle"></span></div>
                          </div> -->
                          <!-- <span class="tag-content-light tag-light tag-hover-effect"><i data-feather="trending-up"></i></span> -->
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-xl-3 col-md-3 box-col-6">
                    <div class="card">
                      <div class="card-body tag-card">
                        <div class="progressbar-widgets">
                          <div class="media media-widgets">
                            <div class="media-body">
                              <p class="mb-2">Total Brokers</p>
                              <h3 class="mt-0 mb-0 f-w-600">
                                <?php
                                echo $totalbrokers;
                                ?>
                              </h3>
                            </div>
                            <!-- <span class="badge flat-badge-primary">6.23%<i class="fa fa-caret-up"></i></span> -->
                          </div>
                          <!-- <div class="progress sm-progress-bar progress-animate">
                            <div class="progress-gradient-primary" role="progressbar" style="width: 95%" aria-valuenow="95" aria-valuemin="0" aria-valuemax="100"><span class="animate-circle"></span></div>
                          </div> -->
                          <!-- <span class="tag-content-primary tag-hover-effect"><i data-feather="trending-up">     </i></span> -->
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-xl-8 xl-100 box-col-12">
                <div class="card sales-overview">
                  <div class="card-header">
                    <h5>Sales Overview</h5>
                    <div class="card-header-right">
                      <ul class="list-unstyled card-option">
                        <li><i class="icofont icofont-double-left"></i></li>
                        <li><i class="view-html fa fa-code"></i></li>
                        <li><i class="icofont icofont-maximize full-card"></i></li>
                        <li><i class="icofont icofont-minus minimize-card"></i></li>
                        <li><i class="icofont icofont-refresh reload-card"></i></li>
                        <li><i class="icofont icofont-error close-card"></i></li>
                      </ul>
                    </div>
                  </div>
                  <div class="card-body p-0">
                    <div class="row m-0 dashboard-btn-groups">
                      <div class="col-lg-6">
                        <div class="btn-group" role="group" aria-label="Basic example">
                          <button class="btn btn-outline-light btn-js" type="button">Hours</button>
                          <button class="btn btn-outline-light btn-js" type="button">Day</button>
                          <button class="btn btn-outline-light btn-js" type="button">Week</button>
                          <button class="btn btn-outline-light btn-js active" type="button">Month</button>
                        </div>
                      </div>
                      <div class="col-lg-6">
                        <div class="btn-group pull-right" role="group" aria-label="Basic example">
                          <button class="btn btn-outline-light btn-js1" type="button">From Date</button>
                          <button class="btn btn-outline-light btn-js1" type="button">To Date</button>
                          <button class="btn btn-outline-light btn-js1 active" type="button"><i data-feather="calendar"></i></button>
                        </div>
                      </div>
                    </div>
                    <div class="card-body">
                      <div class="chart-value-box pull-right">
                        <div class="value-square-box-primary"></div><span>Profit</span>
                      </div>
                      <div class="dashboard-rounded-chart flot-chart-container"></div>
                    </div>
                    <div class="code-box-copy">
                      <button class="code-box-copy__btn btn-clipboard" data-clipboard-target="#example-head" title="Copy"><i class="icofont icofont-copy-alt"></i></button>
                      <pre><code class="language-html" id="example-head">&lt;!-- Cod Box Copy begin --&gt;
&lt;div class="row m-0 dashboard-btn-groups"&gt;
 &lt;div class="col-lg-6"&gt;
 &lt;div class="btn-group" role="group" aria-label="Basic example"&gt;
 &lt;button class="btn btn-outline-light" type="button"&gt;Hours&lt;/button&gt;
 &lt;button class="btn btn-outline-light" type="button"&gt;Day&lt;/button&gt;
 &lt;button class="btn btn-outline-light" type="button"&gt;Week&lt;/button&gt;
 &lt;button class="btn btn-primary" type="button"&gt;Month&lt;/button&gt;
 &lt;/div&gt;
 &lt;/div&gt;
 &lt;div class="col-lg-6"&gt;
 &lt;div class="btn-group pull-right" role="group" aria-label="Basic example"&gt;
 &lt;button class="btn btn-outline-light" type="button"&gt;From Date&gt;/button&gt;
 &lt;button class="btn btn-outline-light" type="button"&gt;To Date&lt;/button&gt;
 &lt;button class="btn btn-primary" type="button"&gt;&lt;i data-feather="calendar"&lt;&gt;/i&lt;/button&gt;
 &lt;/div&gt;
 &lt;/div&gt;
 &lt;/div&gt;
 &lt;div class="card-body dashboard-rounded-chart flot-chart-container"&gt;&lt;/div&gt;
 &lt;!-- Cod Box Copy end --&gt;</code></pre>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-xl-4 xl-100 box-col-12">
                <div class="card">
                  <div class="card-header">
                    <h5>Sales By Category</h5>
                    <div class="card-header-right">
                      <ul class="list-unstyled card-option">
                        <li><i class="icofont icofont-double-left"></i></li>
                        <li><i class="view-html fa fa-code"></i></li>
                        <li><i class="icofont icofont-maximize full-card"></i></li>
                        <li><i class="icofont icofont-minus minimize-card"></i></li>
                        <li><i class="icofont icofont-refresh reload-card"></i></li>
                        <li><i class="icofont icofont-error close-card"></i></li>
                      </ul>
                    </div>
                  </div>
                  <div class="card-body p-0">
                    <div class="sales-product-table table-responsive">
                      <table class="table table-bordernone">
                        <tbody>
                          <tr>
                            <td><img class="img-fluid" src="assets/images/dashboard/sale-product-1.png" alt=""></td>
                            <td><span>Latest </span><span class="d-block">Niky Black shoes</span></td>
                            <td><span class="badge badge-pill pill-badge-secondary">21,562</span></td>
                            <td><span>28.21%</span></td>
                          </tr>
                          <tr>
                            <td><img class="img-fluid" src="assets/images/dashboard/sale-product-2.png" alt=""></td>
                            <td><span>Latest Men </span><span class="d-block">Shirt</span></td>
                            <td><span>15,102</span></td>
                            <td><span>18.00%</span></td>
                          </tr>
                          <tr>
                            <td><img class="img-fluid" src="assets/images/dashboard/sale-product-3.png" alt=""></td>
                            <td><span>Latest Women </span><span class="d-block">Purse</span></td>
                            <td><span>9562</span></td>
                            <td><span>08.54%</span></td>
                          </tr>
                          <tr>
                            <td><img class="img-fluid" src="assets/images/dashboard/sale-product-4.png" alt=""></td>
                            <td><span>Latest </span><span class="d-block">Women Sandals</span></td>
                            <td><span>1002</span></td>
                            <td><span>01.33%</span></td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                    <div class="code-box-copy">
                      <button class="code-box-copy__btn btn-clipboard" data-clipboard-target="#example-head2" title="Copy"><i class="icofont icofont-copy-alt"></i></button>
                      <pre><code class="language-html" id="example-head2">&lt;!-- Cod Box Copy begin --&gt;
&lt;div class="sales-product-table table-responsive"&gt;
&lt;table class="table table-bordernone"&gt;
&lt;tbody&gt;
&lt;tr&gt;
&lt;td&gt;&lt;img class="img-fluid" src="assets/images/dashboard/sale-product-1.png" alt=""&gt;&lt;/td&gt;
&lt;td&gt;&lt;span&gt;Latest &lt;/span&gt;&lt;span class="d-block"&gt;Niky Black shoes&lt;/span&gt;&lt;/td&gt;
&lt;td&gt;&lt;span class="badge badge-pill badge-secondary"&gt;21,562&lt;/span&gt;&lt;/td&gt;
&lt;td&gt;&lt;span&gt;28.21%&lt;/span&gt;&lt;/td&gt;
&lt;/tr&gt;
&lt;tr&gt;
&lt;td&gt;&lt;img class="img-fluid" src="assets/images/dashboard/sale-product-2.png" alt=""&gt;&lt;/td&gt;
&lt;td&gt;&lt;span&gt;Latest Men &lt;/span&gt;&lt;span class="d-block"&gt;Shirt&lt;/span&gt;&lt;/td&gt;
&lt;td&gt;&lt;span&gt;15,102&lt;/span&gt;&lt;/td&gt;
&lt;td&gt;&lt;span&gt;18.00%&lt;/span&gt;&lt;/td&gt;
&lt;/tr&gt;
&lt;tr&gt;
&lt;td&gt;&lt;img class="img-fluid" src="assets/images/dashboard/sale-product-3.png" alt=""&gt;&lt;/td&gt;
&lt;td&gt;&lt;span&gt;Latest Women &lt;/span&gt;&lt;span class="d-block"&gt;Purse&lt;/span&gt;&lt;/td&gt;
&lt;td&gt;&lt;span&gt;9562&lt;/span&gt;&lt;/td&gt;
&lt;td&gt;&lt;span&gt;08.54%&lt;/span&gt;&lt;/td&gt;
&lt;/tr&gt;
&lt;tr&gt;
&lt;td&gt;&lt;img class="img-fluid" src="assets/images/dashboard/sale-product-4.png" alt=""&gt;&lt;/td&gt;
&lt;td&gt;&lt;span&gt;Latest &lt;/span&gt;&lt;span class="d-block"&gt;Women Sandals&lt;/span&gt;&lt;/td&gt;
&lt;td&gt;&lt;span&gt;1002&lt;/span&gt;&lt;/td&gt;
&lt;td&gt;&lt;span&gt;01.33%&lt;/span&gt;&lt;/td&gt;
&lt;/tr&gt;
&lt;/tbody&gt;
&lt;/table&gt;
&lt;/div&gt;
&lt;div class="card-footer sales-product-table-footer"&gt;
&lt;div class="media"&gt;
&lt;button class="btn btn-outline-light"&gt;Last Week&lt;i class="fa fa-angle-double-right ml-2"&gt;&lt;/i&gt;&lt;/button&gt;
&lt;div class="media-body"&gt;&lt;a class="pull-right"&gt;View More Reports&lt;/a&gt;&lt;/div&gt;
&lt;/div&gt;
&lt;/div&gt;
&lt;!-- Cod Box Copy end --&gt;</code></pre>
                    </div>
                  </div>
                  <div class="card-footer sales-product-table-footer">
                    <div class="media"><a class="btn btn-outline-light">Last Week<i class="fa fa-angle-double-right ml-2"></i></a>
                      <div class="media-body"><a class="pull-right" href="#">View More Reports               </a></div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- <div class="col-xl-5 xl-100 box-col-12">
                <div class="knob-widgets card">
                  <div class="row card-body">
                    <div class="col-md-6">
                      <div class="knob-block text-center">
                        <input class="knob" data-width="230" data-height="230" data-thickness=".060" data-angleoffset="90" data-displayinput="false" data-fgcolor="#fb2e63" data-bgcolor="#f2f4ff" data-linecap="round" value="75">
                        <div class="knob-content-center">
                          <h6 class="f-w-600">March. 2019</h6><span class="f-w-600">Total Invest</span>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="knob-live-content text-center">
                        <div class="setting-dot">
                          <div class="setting-bg pull-right"><i class="fa fa-spin fa-cog"></i></div>
                        </div>
                        <div class="small-bar">
                          <div class="ct-small-left flot-chart-container"></div>
                        </div>
                        <div class="span badge badge-pill pill-badge-secondary"> <i class="fa fa-circle"></i>Live</div>
                      </div>
                      <div class="knob-bottom-widgets text-center">
                        <h6 class="f-w-600">This Invest Cycle</h6>
                        <h5 class="f-w-600"><i data-feather="dollar-sign"></i>785,000</h5>
                        <h6 class="f-w-600 mb-0">Current Balance This Invest Cycle</h6>
                      </div>
                    </div>
                  </div>
                </div>
              </div> -->

              <div class="col-xl-8 xl-100 box-col-12">
                <!-- Suppport list section added by sanjeev on 12-02-2020 -->
                <div class="card">
                  <div class="card-header">
                    <h5>Support Ticket List</h5><span>List of ticket opend by customers</span>
                    <div class="card-header-right">
                      <ul class="list-unstyled card-option">
                        <li><i class="icofont icofont-double-left"></i></li>
                        <li><i class="view-html fa fa-code"></i></li>
                        <li><i class="icofont icofont-maximize full-card"></i></li>
                        <li><i class="icofont icofont-minus minimize-card"></i></li>
                        <li><i class="icofont icofont-refresh reload-card"></i></li>
                        <li><i class="icofont icofont-error close-card"></i></li>
                      </ul>
                    </div>
					
					 <div class="page-body-wrapper">
  <div class="page-body">
    <div class="container-fluid">
      <div class="myaccount-profile my-upload">
        <div class="row">
		
          <?php if(!isMobile()){?>
           <?php //$this->load->view(MYACCOUNT_PATH.'front/sidebar_account',['page' => $page]);?>
          <?php } ?>
          <?php if(isMobile()){?>
           <div class="col-lg-3"> <a class="btn mobile-backbtn" href="<?php echo site_url('order/myaccount');?>"> <i class="fa fa-chevron-left" aria-hidden="true"></i> Back </a></div> 
          <?php } ?>
		  
          <div class="col-lg-12">
            <div class="row">
              <div class="col-lg-10"> <ul class="projects-status">
                <?php
             if($support_status_output)
             {
                 foreach($support_status_output as $supp_key=>$suppo)
                 {
            ?>
                <li class="list-staus supportList">
                  <h2> <?php echo $support_count[$supp_key]; ?> </h2>
                  <span class="list-status-title"> <?php echo $suppo; ?> </span> </li>
                <?php }  } ?>
              </ul> 		  
			  </div>	  
			  
			  
            </div>
             <div class="support-data">
             <?php if ($this->session->flashdata('msg')) { ?><?php echo $this->session->flashdata('msg'); ?><?php } ?>  
			 <div class="custom-support-data">
                <table class="table table-bordered table-hover mytable " >
                  <thead>
                  <tr>
                    <th>ID</th>
                    <th>Subject</th>
                    <th>Priority</th>
                    <th>Status</th>
                    <th>Department</th>
                    <th>Created</th>
                    <th>Updated</th>
                    <th>Condition</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                <tbody>
                 <?php
                  if($ticket){ 
                  foreach($ticket as $key=>$supp){
                      $replyData = $supp->reply_support_list;
                      ?>
                  <tr>
                      <td> <?php echo $supp->support_ticket_number ?? $key+1; ?></td>
                      <td> <?php echo $supp->subject; ?></td>
                      <td> <label class="label label-warning"><?php echo $supp->priority_name; ?></label> </td>
                      <td> <label class="label label-info"><?php echo $supp->status_name; ?></label> </td>
                      <td>  <?php echo $supp->department_name; ?> </td>
                      <td>  <?php echo date('m/d/Y',strtotime($supp->datetime)); ?>  </td>
                      <td>  <?php if(!empty($supp->updated_date)){ echo date('m/d/Y',strtotime($supp->updated_date)); }else { echo date('m/d/Y',strtotime($supp->datetime));} ?>  </td>
                      <td> <label class="label label-success"><?php echo $supp->status_name; ?></label> </td>
                      <td> 
                        <?php 
                        $created = date('m/d/Y h:i:s A',strtotime($supp->datetime)); 

                        ?>
                        <!--  Data added for support by Sanjeev on Date 12-2-20 / -->
                      <a href= "<?php echo base_url('support'); ?>"> <i id="<?php echo $supp->support_ticket_number ?? $key+1; ?>" class="fa fa-reply" aria-hidden="true" data-subject="<?php echo $supp->subject; ?>" data-priority="<?php echo $supp->priority_name; ?>"data-status="<?php echo $supp->status_name; ?>" data-department="<?php echo $supp->department_name; ?>" data-fullname="<?php echo $supp->first_name.' '.$supp->last_name ?>" data-created="<?php echo $created ?>"></i> </a>
                      <!-- p tag for support by Sanjeev on Date 12-2-20 / -->
                      <p data-description="<?php echo $supp->description ?>"></p>
                      <!-- <a href="#"> <i class="fa fa-times" aria-hidden="true"></i> </a> -->
                      </td>
                  </tr>
                  <?php }} ?>
                </tbody>
              </table>		
          </div>
       </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
					
                  </div>
                 
                </div>
              </div>
              
			  <?php
        /*
        ?>
        <div class="col-xl-8 xl-100 box-col-12">
          <!-- Suppport list section added by sanjeev on 11-02-2020 -->
                <div class="card">
				
				
    
                  <div class="card-header">
                    <h5>Support Ticket List</h5><span>List of ticket opend by customers</span>
                  </div>
                  <div class="card-body">
                    <div class="row">
                      <div class="col-xs-12">
                        <div class="table-responsive">
                          <table class="display" id="ajax_table_1">
                            <thead>
                              <!-- <tr>
                                <th rowspan="2">Name</th>
                                <th colspan="2">HR Information</th>
                                <th colspan="4">Contact</th>
                              </tr> -->
                              <tr>
                                <th>Client Name</th>
                                <th>Subject</th>
                                <th>Latest Message</th>
                                <th>Date & Time</th>
                                <th>Priority</th>
                                <th>Status</th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php
                              if($ticket)
                              {
                                foreach($ticket as $supp)
                                {
                                  $last_reply = getlastreply($supp->ticket_id);
                                  $date = ($supp->datetime!=NULL)?date("m/d/Y H:i:s", strtotime($supp->datetime)):'';
                                  ?>
                                  <tr>
                                    <td>
                                      <?php echo orderusersname($supp->user_id); ?> 
                                    </td>
                                    <td>
                                      <?php echo $supp->support_ticket_number.'-'.$supp->subject; ?> 
                                    </td>
                                    <td>
                                      <?php echo $last_reply; ?> 
                                    </td>
                                    <td>
                                      <?php echo $date; ?> 
                                    </td>
                                    <td>
                                      <?php echo $supp->priority_name ?>
                                    </td>
                                    <td>
                                      <?php echo $supp->status_name ?>
                                    </td>
                                    <!-- <td>
                                      <a class="btn btn-success btn-xs" href="<?php echo base_url('tickets/reply/'.$supp->ticket_id)  ?>" data-original-title="btn btn-danger btn-xs" title="">Reply</a>
                                      <a onclick="loadsupport('<?php echo $supp->ticket_id;  ?>','<?php echo base_url('tickets/save'); ?>');" class="btn btn-success btn-xs" href="javascript:void(0);" data-original-title="btn btn-danger btn-xs" title="">Edit</a>
                                      <a class="btn btn-danger btn-xs"  href="<?php echo base_url('tickets/deleteticket/'.$supp->ticket_id)  ?>" onClick="return doconfirm();"  data-original-title="btn btn-danger btn-xs" title="">Delete</a>
                                    </td> -->
                                  </tr>
                                  <?php
                                }
                              }
                              ?>
                            </tbody>
                            <tfoot>
                              <tr>
                                <th>Client Name</th>
                                <th>Subject</th>
                                <th>Latest Message</th>
                                <th>Date & Time</th>
                                <th>Priority</th>
                                <th>Status</th>
                              </tr>
                            </tfoot>
                          </table>
                        </div>
                      </div>
                    </div>
                    <br/>
                    
                  </div>
               
				
				</div>
				</div>
        <?php
        */
        ?>
			  
			  
			  
              <!-- <div class="col-xl-8 xl-100 box-col-12">
                <div class="card">
                  <div class="card-header">
                    <h5>Our Best Seller</h5>
                    <div class="card-header-right">
                      <ul class="list-unstyled card-option">
                        <li><i class="icofont icofont-double-left"></i></li>
                        <li><i class="view-html fa fa-code"></i></li>
                        <li><i class="icofont icofont-maximize full-card"></i></li>
                        <li><i class="icofont icofont-minus minimize-card"></i></li>
                        <li><i class="icofont icofont-refresh reload-card"></i></li>
                        <li><i class="icofont icofont-error close-card"></i></li>
                      </ul>
                    </div>
                  </div>
                  <div class="card-body p-0">
                    <div class="sales-product-table table-responsive">
                      <table class="table table-bordernone">
                        <thead>
                          <tr>
                            <th scope="col">Number</th>
                            <th scope="col">Name</th>
                            <th scope="col">Account</th>
                            <th scope="col">Sealing</th>
                            <th scope="col">Percentage</th>
                            <th scope="col">Custmoize</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td>01</td>
                            <td>
                              <div class="d-inline-block align-middle"><img class="img-radius img-30 align-top m-r-15 rounded-circle" src="assets/images/user/2.png" alt="">
                                <div class="d-inline-block">
                                  <h6 class="f-w-600">Nick Stone</h6>
                                </div>
                              </div>
                            </td>
                            <td><span>NikyBlack87@gmail.com</span></td>
                            <td><span>21,562</span></td>
                            <td><span>28.21%</span></td>
                            <td><span class="badge badge-pill pill-badge-secondary">Edit</span></td>
                          </tr>
                          <tr>
                            <td>02</td>
                            <td>
                              <div class="d-inline-block align-middle"><img class="img-radius img-30 align-top m-r-15 rounded-circle" src="assets/images/user/5.jpg" alt="">
                                <div class="d-inline-block">
                                  <h6 class="f-w-600">Milano Esco</h6>
                                </div>
                              </div>
                            </td>
                            <td><span>Milanoesco56@gmal.com</span></td>
                            <td><span>15,102</span></td>
                            <td><span>18.00%</span></td>
                            <td><span class="badge badge-pill pill-badge-success">Edit</span></td>
                          </tr>
                          <tr>
                            <td>03</td>
                            <td>
                              <div class="d-inline-block align-middle"><img class="img-radius img-30 align-top m-r-15 rounded-circle" src="assets/images/user/3.jpg" alt="">
                                <div class="d-inline-block">
                                  <h6 class="f-w-600">Wiltor Noice</h6>
                                </div>
                              </div>
                            </td>
                            <td><span>Wiltornoice34@gmail.com</span></td>
                            <td><span>9562</span></td>
                            <td><span>08.54%</span></td>
                            <td><span class="badge badge-pill pill-badge-warning">Edit</span></td>
                          </tr>
                          <tr>
                            <td>04</td>
                            <td>
                              <div class="d-inline-block align-middle"><img class="img-radius img-30 align-top m-r-15 rounded-circle" src="assets/images/user/4.jpg" alt="">
                                <div class="d-inline-block">
                                  <h6 class="f-w-600">Anna Strong</h6>
                                </div>
                              </div>
                            </td>
                            <td><span>Annastrong67@gmail.com</span></td>
                            <td><span>1002</span></td>
                            <td><span>01.33%</span></td>
                            <td><span class="badge badge-pill pill-badge-primary">Edit</span></td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                    <div class="code-box-copy">
                      <button class="code-box-copy__btn btn-clipboard" data-clipboard-target="#example-head4" title="Copy"><i class="icofont icofont-copy-alt"></i></button>
                      <pre><code class="language-html" id="example-head4">&lt;!-- Cod Box Copy begin --&gt;
&lt;div class="sales-product-table table-responsive"&gt;
&lt;table class="table table-bordernone"&gt;
&lt;thead&gt;
&lt;tr&gt;
&lt;th scope="col"&gt;Number&lt;/th&gt;
&lt;th scope="col"&gt;Name&lt;/th&gt;
&lt;th scope="col"&gt;Account&lt;/th&gt;
&lt;th scope="col"&gt;Sealing&lt;/th&gt;
&lt;th scope="col"&gt;Percentage&lt;/th&gt;
&lt;th scope="col"&gt;Custmoize&lt;/th&gt;
&lt;/tr&gt;
&lt;/thead&gt;
&lt;tbody&gt;
&lt;tr&gt;
&lt;td&gt;01&lt;/td&gt;
&lt;td&gt;
&lt;div class="d-inline-block align-middle"&gt;&lt;img class="img-radius img-30 align-top m-r-15 rounded-circle" src="assets/images/user/2.png" alt=""&gt;
&lt;div class="d-inline-block"&gt;
&lt;h6 class="f-w-600"&gt;Nick Stone&lt;/h6&gt;
&lt;/div&gt;
&lt;/div&gt;
&lt;/td&gt;
&lt;td&gt;&lt;span&gt;NikyBlack87@gmail.com&lt;/span&gt;&lt;/td&gt;
&lt;td&gt;&lt;span&gt;21,562&lt;/span&gt;&lt;/td&gt;
&lt;td&gt;&lt;span&gt;28.21%&lt;/span&gt;&lt;/td&gt;
&lt;td&gt;&lt;span class="badge badge-pill pill-badge-secondary"&gt;Edit&lt;/span&gt;&lt;/td&gt;
&lt;/tr&gt;
&lt;tr&gt;
&lt;td&gt;02&lt;/td&gt;
&lt;td&gt;
&lt;div class="d-inline-block align-middle"&gt;&lt;img class="img-radius img-30 align-top m-r-15 rounded-circle" src="assets/images/user/5.jpg" alt=""&gt;
&lt;div class="d-inline-block"&gt;
&lt;h6 class="f-w-600"&gt;Milano Esco&lt;/h6&gt;
&lt;/div&gt;
&lt;/div&gt;
&lt;/td&gt;
&lt;td&gt;&lt;span&gt;Milanoesco56@gmal.com&lt;/span&gt;&lt;/td&gt;
&lt;td&gt;&lt;span&gt;15,102&lt;/span&gt;&lt;/td&gt;
&lt;td&gt;&lt;span&gt;18.00%&lt;/span&gt;&lt;/td&gt;
&lt;td&gt;&lt;span class="badge badge-pill pill-badge-success"&gt;Edit&lt;/span&gt;&lt;/td&gt;
&lt;/tr&gt;
&lt;tr&gt;
&lt;td&gt;03&lt;/td&gt;
&lt;td&gt;
&lt;div class="d-inline-block align-middle"&gt;&lt;img class="img-radius img-30 align-top m-r-15 rounded-circle" src="assets/images/user/3.jpg" alt=""&gt;
&lt;div class="d-inline-block"&gt;
&lt;h6 class="f-w-600"&gt;Wiltor Noice&lt;/h6&gt;
&lt;/div&gt;
&lt;/div&gt;
&lt;/td&gt;
&lt;td&gt;&lt;span&gt;Wiltornoice34@gmail.com&lt;/span&gt;&lt;/td&gt;
&lt;td&gt;&lt;span&gt;9562&lt;/span&gt;&lt;/td&gt;| &lt;td&gt;&lt;span&gt;08.54%&lt;/span&gt;&lt;/td&gt;
&lt;td&gt;&lt;span class="badge badge-pill pill-badge-warning"&gt;Edit&lt;/span&gt;&lt;/td&gt;
&lt;/tr&gt;
&lt;tr&gt;
&lt;td&gt;04&lt;/td&gt;
&lt;td&gt;
&lt;div class="d-inline-block align-middle"&gt;&lt;img class="img-radius img-30 align-top m-r-15 rounded-circle" src="assets/images/user/4.jpg" alt=""&gt;
&lt;div class="d-inline-block"&gt;
&lt;h6 class="f-w-600"&gt;Anna Strong&lt;/h6&gt;
&lt;/div&gt;
&lt;/div&gt;
&lt;/td&gt;
&lt;td&gt;&lt;span&gt;Annastrong67@gmail.com&lt;/span&gt;&lt;/td&gt;
&lt;td&gt;&lt;span&gt;1002&lt;/span&gt;&lt;/td&gt;| &lt;td&gt;&lt;span&gt;01.33%&lt;/span&gt;&lt;/td&gt;
&lt;td&gt;&lt;span class="badge badge-pill pill-badge-primary"&gt;Edit&lt;/span&gt;&lt;/td&gt;
&lt;/tr&gt;
&lt;/tbody&gt;
&lt;/table&gt;
&lt;/div&gt;
&lt;!-- Cod Box Copy end --&gt;</code></pre>
                    </div>
                  </div>
                </div>
              </div> -->
              
			</div>
          </div>
		</div>    
		
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap4.min.css">
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script  src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
<script  src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>

<script type="text/javascript">
$('.mytable').dataTable( {

"responsive" : true
} );

</script>
