<style>
<!-- Tabs css -->
.tabs { margin-top:25px;}
.tabhide { display:none;}
.tab-content { padding:25px 0px;}
.nav-tabs .nav-link { border-radius:0px !important;}
.projectsTabs { display: flex; justify-content: center; align-items: center; border:none;}
.projectsTabs li { border-radius:0px !important; position:relative; }
.projectsTabs li a { background:#fff; margin:0px 5px; color:#1400ae; text-transform:uppercase; font-weight:700; border:none; position:relative;}
.projectsTabs li a.active { border:none; background:#de0e0e !important; color:#fff !important; }
.projectsTabs li a.active:after {
	content: '';
	width: 0;
	height: 0;
	border-left: 20px solid transparent;
	border-right: 20px solid transparent;
	border-top: 20px solid #de0e0e;
	position: absolute;
	bottom: -13px;
	left: 0;
	right: 0;
	text-align: center;
	margin: 0 auto;
}
.menuProjectview { text-align:center; margin-top:15px;}
.menuProjectview li { display:inline-block; text-align:center; margin:0 auto;}
.menuProjectview li a { color:#03204f; text-transform:uppercase; font-size:13px; font-weight:700; padding: 5px 15px; margin-bottom:15px; display:block;}
.menuProjectview li a.active, .menuProjectview li a:hover { background:#081ea3; border-radius: 50px; padding: 5px 15px; color:#fff;}
.tab-content .tab-data { background:#fff; padding:15px;}
.tabTitle { font-size: 22px; text-transform: uppercase; font-weight: 700;
color:#081ea3; background:#f2f2f2; margin: 0; padding: 15px 15px;}

</style>

<div class="page-body-wrapper">
<div class="page-body vertical-menu-mt">
<div class="container-fluid">
            <div class="page-header">
              <div class="row">
                <div class="col-lg-6">
                  <h3> PROJECT OVERVIEW </h3>
                  <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item"> PROJECT OVERVIEW </li>
                  </ol>
                </div>
              </div>
            </div>
			

<div class="project-overviewtabs">
  <!-- Nav tabs -->
  <ul class="nav nav-tabs projectsTabs" role="tablist">
    <li class="nav-item">
    <a class="nav-link menu-tab active" href="javascript:void(0)" id="poverview">PROJECT OVERVIEW</a>
    </li>
    <li class="nav-item">
    <a class="nav-link menu-tab" href="javascript:void(0)" id="tasks"> TASKS </a>
    </li>
    <li class="nav-item">
    <a class="nav-link menu-tab" href="javascript:void(0)" id="tickets"> TICKETS </a>
    </li>
	<li class="nav-item">
    <a class="nav-link menu-tab" href="javascript:void(0)" id="notes"> NOTES </a>
    </li>
	<li class="nav-item">
    <a class="nav-link menu-tab" href="javascript:void(0)" id="invoices"> INVOICES </a>
    </li>
	<li class="nav-item">
    <a class="nav-link menu-tab" href="javascript:void(0)" id="activity"> ACTIVITY </a>
    </li>
  </ul>
  

  
  <!-- Tab panes -->
  <div class="tab-content">
    <div id="poverview" class="tab-data">
	
<ul class="menuProjectview">
<li><a href="#" class="active"> Overview </a> </li>
<li><a href="#"> Client Details </a> </li>
<li><a href="#"> Personal Info </a> </li>
<li><a href="#"> ID Documents </a> </li>
<li><a href="#"> Contract </a> </li>
<li><a href="#"> Dispute Items </a> </li>
<li><a href="#"> Credit Report </a> </li>
<li><a href="#"> Create Letter </a> </li>
<li><a href="#"> BOT TABLE </a> </li>
<li><a href="#"> INNOVIS </a> </li>
<li><a href="#"> USPS </a> </li>
<li><a href="#"> Lexis Nexis </a> </li>
<li><a href="#"> FTC </a> </li>
<li><a href="#"> Documents </a> </li>
<li><a href="#"> Tracking </a> </li>
</ul>	
	

<div class="tab-output"> 
<h2 class="tabTitle"> Overview </h2>
 <table class="table table-striped">
    <thead>
      <tr>
        <th> Product Name </th>
        <th>CREDIT SWEEP </th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td> Client name </td>
        <td> Mel Briggs </td>
      </tr>
      <tr>
        <td> Client Price </td>
        <td> $ 0.00 </td>
      </tr>
      <tr>
        <td>Broker Price</td>
        <td>$ 0.00</td>
      </tr>
	   <tr>
        <td> Payment Method </td>
        <td>  </td>
      </tr>
      <tr>
        <td> Order Status </td>
        <td> </td>
      </tr>
    </tbody>
  </table>

</div>
  
    </div>
    <div id="tasks" class="tab-data tabhide">
      <p> tasks Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
    </div>
    <div id="tickets" class="tab-data tabhide">
      <p> tickets Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam.</p>
    </div>
	<div id="notes" class="tab-data tabhide">
      <p> notes Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam.</p>
    </div>
	<div id="invoices" class="tab-data tabhide">
      <p> invoices Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam.</p>
    </div>
	<div id="activity" class="tab-data tabhide">
      <p> activity Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam.</p>
    </div>
  </div>
</div>




</div>
</div>
</div>

<script>

/** Tabs **/

var menulink=document.getElementsByClassName('menu-tab');
var menucontent=document.getElementsByClassName('tab-data');

for(let i=0;i<menulink.length;i++){
menulink[i].addEventListener('click',()=>{

for(let j=0;j<menucontent.length;j++){
menucontent[j].classList.add('tabhide');
menulink[j].classList.remove('active');
}
menucontent[i].classList.remove('tabhide');
menulink[i].classList.add('active');
});
}
</script>