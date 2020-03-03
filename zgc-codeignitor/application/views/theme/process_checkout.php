<style>
.checkout .checkout-details {
	background-color: #f9f9f9;
	border: 1px solid #dddddd;
	padding: 40px;
}
.order-box .title-box {
	padding-bottom: 20px;
	color: #444444;
	font-size: 22px;
	border-bottom: 1px solid #ededed;
	margin-bottom: 20px;
}
.order-box .title-box span {
	width: 35%;
	float: right;
	font-weight: 600;
}
.order-box .title-box h4 {
	font-weight: 600;
}
.order-box .title-box .checkbox-title {
	display: -webkit-box;
	display: -ms-flexbox;
	display: flex;
	-webkit-box-pack: justify;
	-ms-flex-pack: justify;
	justify-content: space-between;
}
.order-box .sub-total li {
	position: relative;
	display: inline-block;
	font-size: 16px;
	font-weight: 600;
	color: #333333;
	line-height: 20px;
	margin-bottom: 20px;
	width: 100%;
}
.order-box .sub-total li .count {
	position: relative;
	font-size: 18px;
	line-height: 20px;
	color: #158df7;
	font-weight: 400;
	width: 35%;
	float: right;
}
.order-box .sub-total .shipping-class {
	margin-bottom: 12px;
}
.order-box .sub-total .shipping-class .shopping-checkout-option {
	margin-top: -4px;
	position: relative;
	font-size: 18px;
	line-height: 20px;
	color: #158df7;
	font-weight: 400;
	width: 35%;
	float: right;
}
.order-box .total {
	position: relative;
	margin-bottom: 30px;
}
.order-box .total li {
	position: relative;
	display: block;
	font-weight: 400;
	color: #333333;
	line-height: 20px;
	font-size: 18px;
}
.order-box .qty {
	position: relative;
	border-bottom: 1px solid #ededed;
	margin-bottom: 30px;
}
.order-box .qty li {
	position: relative;
	display: block;
	font-size: 15px;
	color: #444444;
	line-height: 20px;
	margin-bottom: 20px;
}
.order-box .qty li span {
	float: right;
	font-size: 18px;
	line-height: 20px;
	color: #232323;
	font-weight: 400;
	width: 35%;
}
.radio-option {
	position: relative;
}
.img-paypal {
	width: 50%;
	margin-left: 15px;
}

.wizard-4 { display:content;}
.wizard-4 ul.anchor {
    position: relative;
    display: block;
    float: left;
    list-style: none;
    margin: 0;
    padding: 0;
    border: 0 solid #e8ebf2;
    background: transparent;
    width: 30%;
    -webkit-box-sizing: border-box;
    box-sizing: border-box;
    padding-right: 30px;
}

.wizard-4 ul.anchor li a.completed {
    color: #fff;
    background: #14750a;
    cursor: text;
    border-radius: 5px;
    text-transform: uppercase;
    font-weight: 600;
}
.steeperBtn {
	position: relative;
    display: block;
    list-style: none;
    margin: 0;
    padding: 0;
    border: 0 solid #e8ebf2;
    background: transparent;
	}
	
.steeperBtn.completed { color: #fff;
    background: #14750a;
    cursor: text;
    border-radius: 5px;
    text-transform: uppercase;
    font-weight: 600; }
	
.steeperBtn li a {
    display: block;
    position: relative;
    margin: 0;
    padding: 10px 20px;
    width: 100%;
    -webkit-box-sizing: border-box;
    box-sizing: border-box;
    text-decoration: none;
    outline-style: none;
    z-index: 1;
    font-size: 15px; line-height:22px; margin-bottom:10px; }
	
.steeperBtn li a.completed { color: #fff;
    background: #14750a;
    cursor: text;
    border-radius: 5px;
    text-transform: uppercase;
    font-weight: 600; }
	
.steeperBtn li a.selected { color: #fff;
    background: #ed3a25;
    cursor: text;
    border-radius: 5px;
    text-transform: uppercase;
    font-weight: 600; }
	
.steeperBtn li a.deselected { color: #fff;
    background: #363d8e;
    cursor: text;
    border-radius: 5px;
    text-transform: uppercase;
    font-weight: 600; }	
	
.steeperBtn li a.disable {     
	color: #898989;
    background: #e8f4fe;
    cursor: text;
    border-radius: 5px; }	

.billing-details { position:relative;}
.disable-billingform { background: rgba(255,255,255,0.7);
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    width: 100%;
    z-index: 1;}
	
	

.disputeItem-row { display:inline-block; width:100%; padding:30px 0px;}

@media (max-width:767px){
	.personal-profile-desktop { display:none;}
}

@media (min-width:768px){
	
.personal-profile-desktop { border: #ccc solid 1px;
    padding: 5px; background:#fff;}
	
.personal-profile-desktop h2 { font-weight: 600;
    font-size: 16px;
    background: #363d8e;
    color: #fff;
    padding: 10px 15px;
    margin: 0;}
	
.personal-profile-desktop .table thead th {
    text-transform: uppercase;
    font-weight: bold;
    background: #f2f2f2; }
	
.personal-profile-desktop .pfaddress { background: #fff7d4;
    border: #f9edb5 solid 1px;
    padding: 10px;
    border-radius: 5px;
    font-size: 14px;
    font-weight: 600;
    margin: 0 0 5px 0;}	

}

@media (min-width:768px){
	.personal-profile-mobile { display:none;}
}

@media (max-width:767px){
	
.personal-profile-mobile { border: #ccc solid 1px; padding: 5px; background:#fff;}
.personal-profile-mobile h2 { font-weight: 600;
    font-size: 16px;
    background: #363d8e;
    color: #fff;
    padding: 10px 15px;
    margin: 0;}

.pp-row { padding: 10px;
    background: #f5f5f5;
    border-bottom: #fff solid 2px;}
	
.pp-row h3 {     
	font-weight: 600;
    font-size: 16px;
    background: #dd3333;
    color: #fff;
    padding: 5px 15px;
    margin: 10px 0px 0px 0px;
    border-radius: 5px; text-transform:uppercase; }
	
.pp-row .d-flex { padding: 5px;
    border-bottom: #ececec solid 1px;
    line-height: 27px;
    font-weight: 600; }
	
.pp-row .pp-content { line-height: 20px; }
.creditEnquiry .pp-content { margin:0; padding:0;}
}
.account-history-row {     
	border: #ccc solid 1px;
    padding: 5px;
    background: #fff; }
.account-history-row h2 { 
	font-weight: 600;
    font-size: 16px;
    background: #363d8e;
    color: #fff;
    padding: 10px 15px;
    margin: 0;}
	
.account-history-row h3 {
	background: #f2f2f2;
    border-bottom: 2px solid #dee2e6;
    padding: 0.75rem;
    color: #1b3155;
    font-size: 16px;
    font-weight: 600;
	margin:5px 0px 0px 0px;
}	

.ah-data { background: #1e73be;
    color: #fff;
    padding: 10px; }
.ah-data h4 { font-weight: 600;
    font-size: 16px;
    padding-bottom: 10px; }	

@media(min-width:768px){
	.disputeButton-mobile { display:none;}
	.disputeButton-desktop { background: #a01f24;
    color: #fff;
    justify-content: center;
    align-items: center;
    display: flex;
    font-size: 13px;
    text-transform: uppercase;
    font-weight: bold; }
.disputeButton-desktop input { margin-right:5px;}
}

@media(max-width:767px){
	.disputeButton-desktop { display:none;}
	.disputeButton-mobile { background: #a01f24;
    color: #fff;
    justify-content: center;
    align-items: center;
    display: flex;
    font-size: 16px;
    text-transform: uppercase;
    font-weight: bold; }
}

</style>
<style>
  .file-upload {
    display: -webkit-box;
    display: -webkit-flex;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-pack: center;
    -webkit-justify-content: center;
    -ms-flex-pack: center;
    justify-content: center;
    -webkit-box-align: center;
    -webkit-align-items: center;
    -ms-flex-align: center;
    align-items: center;
    position: relative;
    cursor: pointer;
    overflow: hidden;
    width: 100%;
    max-width: 100%;
    height: 100px;
    padding: 5px 10px;
    font-size: 1rem;
    text-align: center;
    color: #ccc
  }

  .file-upload-wrapper .card.card-body.has-error .file-upload-message .file-upload-error,
  .file-upload-wrapper .card.card-body.has-preview .btn.btn-sm.btn-danger {
    display: block
  }

  .file-upload i {
    font-size: 3rem
  }

  .file-upload .mask.rgba-stylish-slight {
    opacity: 0;
    -webkit-transition: all .15s linear;
    -o-transition: all .15s linear;
    transition: all .15s linear
  }

  .file-upload:hover .mask.rgba-stylish-slight {
    opacity: .8
  }

 /* .file-upload-wrapper .card.card-body.has-error {
    border-color: #f34141
  }*/

  .file-upload-wrapper .card.card-body.has-error:hover .file-upload-errors-container {
    visibility: visible;
    opacity: 1;
    -webkit-transition-delay: 0s;
    -o-transition-delay: 0s;
    transition-delay: 0s
  }

  .file-upload-wrapper .card.card-body.disabled input {
    cursor: not-allowed
  }

  .file-upload-wrapper .card.card-body.disabled:hover {
    background-image: none;
    -webkit-animation: none;
    animation: none
  }

  .file-upload-wrapper .card.card-body.disabled .file-upload-message {
    opacity: .5;
    text-decoration: line-through
  }

  .file-upload-wrapper .card.card-body.disabled .file-upload-infos-message {
    display: none
  }

  .file-upload-wrapper .card.card-body input {
    position: absolute;
    top: 0;
    right: 0;
    bottom: 0;
    left: 0;
    height: 100%;
    width: 100%;
    opacity: 0;
    cursor: pointer;
    z-index: 5
  }

  .file-upload-wrapper .card.card-body .file-upload-message {
    position: relative;
    <!-- top: 50px;
    -webkit-transform: translateY(-50%);
    -ms-transform: translateY(-50%);
    transform: translateY(-50%) -->
  }

  .file-upload-wrapper .card.card-body .file-upload-message span.file-icon {
    font-size: 50px;
    color: #ccc
  }

  .file-upload-wrapper .card.card-body .file-upload-message p {
    margin: 5px 0 0;
	font-size: 1.2rem;
    color: #797878;
  }

  .file-upload-wrapper .card.card-body .file-upload-message p.file-upload-error {
    color: #f34141;
    font-weight: 700;
    display: none
  }

  .file-upload-wrapper .card.card-body .btn.btn-sm.btn-danger {
    display: none;
    position: absolute;
    opacity: 0;
    z-index: 7;
    top: 10px;
    right: 10px;
    -webkit-transition: all .15s linear;
    -o-transition: all .15s linear;
    transition: all .15s linear
  }

  .file-upload-wrapper .card.card-body .file-upload-preview {
    display: none;
    position: absolute;
    z-index: 1;
    background-color: #fff;
    padding: 5px;
    width: 100%;
    height: 100%;
    top: 0;
    right: 0;
    bottom: 0;
    left: 0;
    overflow: hidden;
    text-align: center
  }

  .file-upload-wrapper .card.card-body .file-upload-preview .file-upload-render .file-upload-preview-img {
    width: 100%;
    height: 100%;
    background-color: #fff;
    -webkit-transition: border-color .15s linear;
    -o-transition: border-color .15s linear;
    transition: border-color .15s linear;
    -o-object-fit: cover;
    object-fit: cover
  }

  .file-upload-wrapper .card.card-body .file-upload-preview .file-upload-render i {
    font-size: 80px;
    top: 50%;
    left: 50%;
    -webkit-transform: translate(-50%, -50%);
    -ms-transform: translate(-50%, -50%);
    transform: translate(-50%, -50%);
    position: absolute;
    color: #777
  }

  .file-upload-wrapper .card.card-body .file-upload-preview .file-upload-render .file-upload-extension {
    position: absolute;
    top: 50%;
    left: 50%;
    -webkit-transform: translate(-50%, -50%);
    -ms-transform: translate(-50%, -50%);
    transform: translate(-50%, -50%);
    margin-top: 10px;
    text-transform: uppercase;
    font-weight: 900;
    letter-spacing: -.03em;
    font-size: 1rem;
    color: #fff;
    width: 42px;
    white-space: nowrap;
    overflow: hidden;
    -o-text-overflow: ellipsis;
    text-overflow: ellipsis
  }

  .file-upload-wrapper .card.card-body .file-upload-preview .file-upload-infos {
    position: absolute;
    left: 0;
    top: 0;
    right: 0;
    bottom: 0;
    z-index: 3;
    background: rgba(0, 0, 0, .7);
    opacity: 0;
    -webkit-transition: opacity .15s linear;
    -o-transition: opacity .15s linear;
    transition: opacity .15s linear
  }

  .file-upload-wrapper .card.card-body .file-upload-preview .file-upload-infos .file-upload-infos-inner {
    position: absolute;
    top: 50%;
    -webkit-transform: translate(0, -40%);
    -ms-transform: translate(0, -40%);
    transform: translate(0, -40%);
    -webkit-backface-visibility: hidden;
    backface-visibility: hidden;
    width: 100%;
    padding: 0 20px;
    -webkit-transition: all .2s ease;
    -o-transition: all .2s ease;
    transition: all .2s ease
  }

  .file-upload-wrapper .card.card-body .file-upload-preview .file-upload-infos .file-upload-infos-inner p {
    padding: 0;
    margin: 0;
    position: relative;
    width: 100%;
    white-space: nowrap;
    overflow: hidden;
    -o-text-overflow: ellipsis;
    text-overflow: ellipsis;
    color: #fff;
    text-align: center;
    line-height: 25px;
    font-weight: 700
  }

  .file-upload-wrapper .card.card-body .file-upload-preview .file-upload-infos .file-upload-infos-inner p.file-upload-infos-message {
    margin-top: 15px;
    padding-top: 15px;
    font-size: 12px;
    position: relative;
    opacity: .5
  }

  .file-upload-wrapper .card.card-body .file-upload-preview .file-upload-infos .file-upload-infos-inner p.file-upload-infos-message::before {
    content: "";
    position: absolute;
    top: 0;
    left: 50%;
    -webkit-transform: translate(-50%, 0);
    -ms-transform: translate(-50%, 0);
    transform: translate(-50%, 0);
    background: #fff;
    width: 30px;
    height: 2px
  }

  .file-upload-wrapper .card.card-body:hover .btn.btn-sm.btn-danger,
  .file-upload-wrapper .card.card-body:hover .file-upload-preview .file-upload-infos {
    opacity: 1
  }

  .file-upload-wrapper .card.card-body:hover .file-upload-preview .file-upload-infos .file-upload-infos-inner {
    margin-top: -5px
  }

  .file-upload-wrapper .card.card-body.touch-fallback {
    height: auto !important
  }

  .file-upload-wrapper .card.card-body.touch-fallback:hover {
    background-image: none;
    -webkit-animation: none;
    animation: none
  }

  .file-upload-wrapper .card.card-body.touch-fallback .file-upload-preview {
    position: relative;
    padding: 0
  }

  .file-upload-wrapper .card.card-body.touch-fallback .file-upload-preview .file-upload-render {
    display: block;
    position: relative
  }

  .file-upload-wrapper .card.card-body.touch-fallback .file-upload-preview .file-upload-infos .file-upload-infos-inner p.file-upload-infos-message::before,
  .file-upload-wrapper .card.card-body.touch-fallback.has-preview .file-upload-message {
    display: none
  }

  .file-upload-wrapper .card.card-body.touch-fallback .file-upload-preview .file-upload-render .file-upload-font-file {
    position: relative;
    -webkit-transform: translate(0, 0);
    -ms-transform: translate(0, 0);
    transform: translate(0, 0);
    top: 0;
    left: 0
  }

  .file-upload-wrapper .card.card-body.touch-fallback .file-upload-preview .file-upload-render .file-upload-font-file::before {
    margin-top: 30px;
    margin-bottom: 30px
  }

  .file-upload-wrapper .card.card-body.touch-fallback .file-upload-preview .file-upload-render img {
    position: relative;
    -webkit-transform: translate(0, 0);
    -ms-transform: translate(0, 0);
    transform: translate(0, 0)
  }

  .file-upload-wrapper .card.card-body.touch-fallback .file-upload-preview .file-upload-infos {
    position: relative;
    opacity: 1;
    background: 0 0
  }

  .file-upload-wrapper .card.card-body.touch-fallback .file-upload-preview .file-upload-infos .file-upload-infos-inner {
    position: relative;
    top: 0;
    -webkit-transform: translate(0, 0);
    -ms-transform: translate(0, 0);
    transform: translate(0, 0);
    padding: 5px 90px 5px 0
  }

  .file-upload-wrapper .card.card-body.touch-fallback .file-upload-preview .file-upload-infos .file-upload-infos-inner p {
    padding: 0;
    margin: 0;
    position: relative;
    width: 100%;
    white-space: nowrap;
    overflow: hidden;
    -o-text-overflow: ellipsis;
    text-overflow: ellipsis;
    color: #777;
    text-align: left;
    line-height: 25px
  }

  .file-upload-wrapper .card.card-body.touch-fallback .file-upload-preview .file-upload-infos .file-upload-infos-inner p.file-upload-infos-message {
    margin-top: 0;
    padding-top: 0;
    font-size: 18px;
    position: relative;
    opacity: 1
  }

  .file-upload-wrapper .card.card-body.touch-fallback .file-upload-message {
    -webkit-transform: translate(0, 0);
    -ms-transform: translate(0, 0);
    transform: translate(0, 0);
    padding: 40px 0
  }

  .file-upload-wrapper .card.card-body.touch-fallback .btn.btn-sm.btn-danger {
    top: auto;
    bottom: 23px;
    opacity: 1
  }

  .file-upload-wrapper .card.card-body.touch-fallback:hover .file-upload-preview .file-upload-infos .file-upload-infos-inner {
    margin-top: 5rem
  }

  .file-upload-wrapper .card.card-body .file-upload-loader {
    position: absolute;
    top: 15px;
    right: 15px;
    display: none;
    z-index: 9
  }

  .file-upload-wrapper .card.card-body .file-upload-loader::after {
    display: block;
    position: relative;
    width: 20px;
    height: 20px;
    -webkit-animation: rotate .6s linear infinite;
    animation: rotate .6s linear infinite;
    -webkit-border-radius: 100%;
    border-radius: 100%;
    border-top: 1px solid #ccc;
    border-bottom: 1px solid #777;
    border-left: 1px solid #ccc;
    border-right: 1px solid #777;
    content: ""
  }

  .file-upload-wrapper .card.card-body .file-upload-errors-container {
    position: absolute;
    left: 0;
    top: 0;
    right: 0;
    bottom: 0;
    z-index: 3;
    background: rgba(243, 65, 65, .8);
    text-align: left;
    visibility: hidden;
    opacity: 0;
    -webkit-transition: visibility 0s linear .15s, opacity .15s linear;
    -o-transition: visibility 0s linear .15s, opacity .15s linear;
    transition: visibility 0s linear .15s, opacity .15s linear
  }

  .file-upload-wrapper .card.card-body .file-upload-errors-container ul {
    padding: 10px 20px;
    margin: 0;
    position: absolute;
    left: 0;
    top: 50%;
    -webkit-transform: translateY(-50%);
    -ms-transform: translateY(-50%);
    transform: translateY(-50%)
  }

  .file-upload-wrapper .card.card-body .file-upload-errors-container ul li {
    margin-left: 20px;
    color: #fff;
    font-weight: 700
  }

  .file-upload-wrapper .card.card-body .file-upload-errors-container.visible {
    visibility: visible;
    opacity: 1;
    -webkit-transition-delay: 0s;
    -o-transition-delay: 0s;
    transition-delay: 0s
  }

  .file-upload-wrapper .card.card-body~.file-upload-errors-container ul {
    padding: 0;
    margin: 15px 0
  }

  .file-upload-wrapper .card.card-body~.file-upload-errors-container ul li {
    margin-left: 20px;
    color: #f34141;
    font-weight: 700
  }

  @-webkit-keyframes rotate {
    0% {
      -webkit-transform: rotateZ(-360deg);
      transform: rotateZ(-360deg)
    }

    100% {
      -webkit-transform: rotateZ(0);
      transform: rotateZ(0)
    }
  }

  @keyframes rotate {
    0% {
      -webkit-transform: rotateZ(-360deg);
      transform: rotateZ(-360deg)
    }

    100% {
      -webkit-transform: rotateZ(0);
      transform: rotateZ(0)
    }
  }
  
  #btnSaveSign { border:none !important; background:#dd3333 !important; padding:5px 15px !important; font-weight:600 !important; font-size: 16px !important;}
  #btnSaveSignreset { color: #fff;
    background: #101010 !important;
    padding: 5px 15px !important;
    border: none !important;
    font-size: 16px !important;
    margin-top: 10px; }
  
</style>

<style>
.myaccount-profile .tab-content {
	background: #fff;
	padding: 20px;
	min-height: 300px;
}

.myaccount-profile .tab-content h2 { 
	font-size: 18px;
    font-weight: 600;
    color: #a01f24; text-transform:uppercase; margin-bottom:20px; }

.myaccount-profile .form-control {
	border-radius: 0px;
	font-size: 14px;
}
.nav-pills .nav-link.active, .nav-pills .show > .nav-link {
	background: #072593;
	border-radius: 0px;
	font-size: 13px;
	padding: 8px 10px;
	font-weight: 600;
}
.nav-pills .nav-link {
 border-radius: 0px;
	background: #fff;
	color: #072593;
	text-transform: uppercase;
	font-weight: 600;
}
@media(max-width:767px) {
.card-body, .col-lg-10, .container-fluid {
	padding: 0px;
	margin: 0;
}
.nav-pills {
	display: flex;
}
.nav-pills li {
	width: auto;
}
.nav-pills .nav-link, .nav-pills .nav-link.active, .nav-pills .show > .nav-link {
	font-size: 11px !important;
	paddig: 5px 7px !important;
}

.myaccount-profile .tab-content {
    padding: 20px 5px;
}

.myaccount-profile .card-body { padding:0px;}

.tabs-menusection {
	overflow-x:scroll;
}

.scroll-touch {
-webkit-overflow-scrolling: touch; / Lets it scroll lazy /
}

.scroll-auto {
-webkit-overflow-scrolling: auto; / Stops scrolling immediately /
}

}
.tab-slider {
	margin: 0;
	padding: 0;
	position: relative;
}
.tab-slider .btn-icon {
	position: absolute;
	top: 5px;
}
#goPrev {
	left: 0;
}
#goNext {
	right: 0;
}
.tabs-menusection {
	position: relative;
	white-space: nowrap;
	width: 100%;
}
.nav-tabs>li.active>a, .nav-tabs>li.active>a:focus, .nav-tabs>li.active>a:hover {
	border: 1px solid transparent;
}
.tabs-menusection>.nav-tabs {
	display: inline-block;
	padding: 0;
	margin: 0;
	position: relative;
	top: 0;
	left: 0;
}
.tabs-menusection>.nav-tabs>li {
	display: inline-block;
	position: relative;
	white-space: normal;
	float: none;
	font-size: 14px;
}
.nav-tabs>li>a {
	margin-right: 0;
	border-radius: 0;
}
#goNext {
	right: 0px;
	padding: 4px;
	background: #d33;
	border-radius: 0px;
	top: 0;
}
#goPrev {
	left: 0px;
	padding: 4px;
	background: #d33;
	border-radius: 0px;
	top: 0;
}
#goPrev .fa, #goNext .fa {
	color: #fff;
}

@media(min-width:556px) {
#goPrev, #goNext {
	display: none;
}
}

.tableData { background:#f9f9f9; padding:15px;}
.tableData .col { height:25px; font-size:16px;}
.tableData .col-title {
	font-weight:700;
}
.tableData h3 { font-size: 16px;
    font-weight: 600;
    color: #000;
    text-transform: uppercase;
    margin-bottom: 20px; }

@media(max-width:767px){
.tableData .col {
    height: 23px;
    font-size: 12px;
    line-height: 16px;
    text-align: left;
}
}

.swiper-slide { width:50px;}
.swiper-container .nav {
    flex-wrap:inherit !important;
}

@media(min-width:768px){
}

.swiper-button-next, .swiper-container-rtl .swiper-button-prev { top:21px;
    background-image: none;
    right: 0;
    left: auto;
    display: flex;
    justify-content: center;
    align-items: center;
    background: #9d1c24;
}
.swiper-button-prev, .swiper-container-rtl .swiper-button-next { top:21px; background-image: none;
    display: flex;
    justify-content: center;
    align-items: center;
    background: #9d1c24; }
.swiper-button-next .fa, .swiper-button-prev .fa { color:#fff;}  
.swiper-button-next, .swiper-button-prev {     
    position: absolute;
    width: 27px;
    height: 38px;
    margin-top: -22px;
    z-index: 10;
    cursor: pointer;
    background-size: 27px 44px;
    background-position: center;
    background-repeat: no-repeat; }
	
.swiper-button-prev, .swiper-container-rtl .swiper-button-next { background-image:none; }

.swiper-button-prev { left:0 !important;}

.nav-tabs .nav-link { text-align: center;
    font-weight: 700;
    background: #fff;
    color: #000;
    font-size: 14px;
    text-transform: uppercase; }
	
.nav-tabs .nav-link.active { color: #fff !important; background-color: #1e73be !important; }

.nav-tabs .nav-link.active, .nav-tabs .nav-link.selected {
    color: #fff !important;
    background-color: #dd3333 !important;
}

.nav-tabs .nav-link, .nav-tabs .nav-link.deselected {
    text-align: center;
    font-weight: 700;
    background: #1e73be;
    color: #fff;
    font-size: 13px;
    text-transform: uppercase;
    border: #fff solid 2px;
}

.nav-tabs .nav-link.deselected { padding:.5rem 1rem;}
.nav-tabs .selected { display:block; text-align: center;
    font-weight: 700;
    background: #dd3333;
    color: #fff;
    font-size: 14px;
    text-transform: uppercase;
    border: #fff solid 2px; padding:.5rem 1rem;}
	

@media(min-width:767px){
	.tab-arrow-group { display:none;}
}	
	
@media(max-width:767px){
	.nav-tabs { width:100%; overflow-x:scroll;}
	.nav { flex-wrap:inherit !important;}
	.tab-arrow-group { display:block;}
	.tab-next-arrow { position: absolute; left: 0; top: 0px; cursor: pointer; background: #dd3333; padding: 8px 5px;}
.tab-next-prev { position:absolute; right:0; top: 2px; cursor: pointer; background: #dd3333; padding: 8px 5px;}
.tab-next-arrow .fa, .tab-next-prev .fa { color:#fff;}
}
	
@media only screen and (max-width: 1399px){
.nav {
    display: -webkit-box !important;
}
.nav-tabs { width:100%; overflow-x:scroll;}
.nav-tabs .nav-link.deselected {
    padding: .5rem 0.5rem;
}
.nav-tabs .nav-link, .nav-tabs .nav-link.deselected {}
}

@media (min-width: 576px){
#myModalcontract .modal-dialog {
    max-width: 355px !important;
	width:355px !important;
    margin: 0;
}
}



</style>

<?php 
if(isset($cartItems['array'][0])){
	$productName   = $cartItems['array'][0]['product_name'];
	//$selling_price = $cartItems['array'][0]->selling_price;
}else {
	$productName=$product_data->product_name;
}
$isdisputeflag=0;
if(!empty($dispute_items) && isset($dispute_items) && isset($_GET['identityIq'])==1){
	$isdisputeflag=1;
}
?>
<!-- Right sidebar Ends-->
<div class="page-body checkout">
<!-- Container-fluid starts-->
  <div class="container-fluid">
    <div class="card">
      <div class="card-header">
	  <div class="row">
	  <div class="col-lg-4"> <h4>PREORDER CHECKLIST</h4> </div>
	  <div class="col-lg-8">
		<div class="row">
			<?php if(isset($users_data->first_name)){?><div class="col-lg-3">Client Name  : <?php echo $users_data->first_name;?></div><?php } ?>
			<?php if(isset($productName)){?><div class="col-lg-4">Product Name : 
			<?php  echo $productName; ?></div> <?php } ?>
			<?php if(isset($orders->order_number)){?> <div class="col-lg-5">Order Number : <?php echo $orders->order_number;?></div> <?php } ?>
		</div>
	  </div>
	  </div>
      </div>
      <div class="card-body">
          <div class="row">
       <?php if(!empty($dynamic_block)){
				$currentStep = isset($_GET['step']) ? $_GET['step'] :1;
				$identityIqFlag  = isset($_GET['identityIq']) ? $_GET['identityIq'] :0;
				  $totalblock = count($dynamic_block);
				?>
            <div class="col-lg-12 col-sm-12"> 
			<ul class="nav nav-tabs" id="myTab" role="tablist">
			   <?php
				   $totalStepCount=0;
					$b=1;
					foreach($dynamic_block as $getRes){
						$class ='nav-link deselected';
						$block_name 		= $getRes->block_name;
						$block_field_name	= str_replace(' ', '-', strtolower($block_name));
						$product_block_id 	= $getRes->block_id;
						$getcustom_fields 	= $getRes->custom_fields;
						$active='';
						if($b==1 && $currentStep==$b){
							$class ='nav-link selected';
							$active='active';
						}else if($currentStep==$b){
							$class ='nav-link selected';
						}
						
						if($b>$currentStep){?>
							<li> <a class="nav-link <?php echo $class;?>" id="stepmenu_<?php echo $b ;?>" data-toggle="modal" data-target="#myModal"><?php echo $b; ?> - <?php echo $block_name ;?></a> </li>
						<?php }else{ ?>
						
						<li> <a class="nav-link <?php echo $class;?> <?php echo $active;?>" id="stepmenu_<?php echo $b ;?>" data-toggle="tab" href="#step-<?php echo $b ;?>" role="tab" onclick="stepno(<?php echo $b ;?>,'<?php echo $totalblock;?>')" aria-controls="profile" aria-selected="false"><?php echo $b; ?> - <?php echo $block_name ;?></a> </li>
					<?php }
					$totalStepCount+=1;
					$b++;} ?>
			</ul>
			
			<div class="tab-arrow-group">
			<div class="tab-next-arrow"> <i class="fa fa-chevron-left" aria-hidden="true"></i> </div>
			<div class="tab-next-prev"> <i class="fa fa-chevron-right" aria-hidden="true"></i>  </div> </div>

			<div class="tab-content" id="myTabContent">
				<?php
					$c=1;
					foreach($dynamic_block as $getRes){
						$displayblock 		='display:none;';
						$block_name 		= $getRes->block_name;
						$block_field_name	= str_replace(' ', '-', strtolower($block_name));
						$product_block_id 	= $getRes->block_id;
						$getcustom_fields 	= $getRes->custom_fields;
						$active='';
						if($c==1 && $currentStep==$c){
							$displayblock ='display:block;';
							$active='active show';
						}else if($currentStep==$c){
							$displayblock ='display:block;';
							$active='active show';
						}
						
						$module_selected 	= $getRes->module_selected;
						$submitBtn ='Proceed for Next';
						$btnType 	='submit';
						$btnTypeId  ='form_submit'.$c;
						$formId = $block_field_name;
						$onclickMethod='';
						$actionMethod='order/savestep';
						if($module_selected=='identityiq'){
							$submitBtn ='Import Your Credit Report Now';
							$btnType ='submit';
							$formId = 'indentityiqform';
						}
						else if($module_selected=='contract' && isMobile() && empty($contract_sign->sign))
						{
							$actionMethod='order/saveContract';
							$btnType = (isMobile()) ? 'button' : 'submit';
						}
						
						if($product_block_id==8){
							$actionMethod='order/saveDispute';
						}
					?>
					
					
					  <div class="tab-pane fade <?php echo $active;?>" id="step-<?php echo $c ;?>" role="tabpanel" aria-labelledby="profile-tab" style="<?php echo $displayblock;?>">
						<div class="col-lg-12 checklist-padd"> 
							<form id="<?php echo $formId;?>" name="checkout-step<?php echo $c;?>" method="post" enctype="multipart/form-data" action="<?php echo base_url($actionMethod);?>"> 
								 <input type="hidden" name="orderId" value="<?php echo $orderId ;?>" />
								 <input type="hidden" name="totalsteps" value="<?php echo $totalStepCount ;?>" />
								 <input type="hidden" name="step" value="<?php echo $c ;?>" />
								<?php if(!empty($getcustom_fields) || $product_block_id==8){?>
									<input type="hidden" name="block_id" value="<?php echo $product_block_id ;?>" />	
									<input type="hidden" name="block_name" value="<?php echo $block_name ;?>" />
									<input type="hidden" name="block_field_name" value="<?php echo $block_field_name ;?>" />
									<input type="hidden" name="module_selected" value="<?php echo $module_selected ;?>" />
								  <?php } ?>
								  
							  <div class="row">
							  <?php
							  if($this->session->userdata('user_type')==4 && $c==1)
							  {
							  ?>
								  <div class="form-group col-lg-6">
									<h2 for="selectclient" class="checklist-title">Select Client<span class="astrisk">*</span></h2>
									  <select name="user_id" id="user_id" class="form-control" required="required" >
										<option value="">Choose Client</option>
										<?php  if($clients) { 
												foreach($clients as $clien) { 
													$name = $clien->first_name.' '.$clien->last_name;
													if($name!=''){
													?>
													<option value="<?php echo $clien->user_id; ?>"><?php echo strtoupper($name); ?></option>
												<?php }  
												}
											} ?>
									  </select>
								  </div>
							  <?php } ?>

						<?php $disputeflag=0;
							if($product_block_id==8){
								if(!empty($dispute_items) && isset($dispute_items)){
								 echo $dispute_items;
								 $submitBtn ='Procced to Checkout';
								}else{
									$disputeflag=1;
								}
							}else {
								if($module_selected=='contract' && isMobile()){
									echo $contract_sign_letter;
								}else{
										
								   foreach($getcustom_fields as $getCustomField){
									$fieldtype 			= $getCustomField->field_type;
									$label_name 		= $getCustomField->label_name;
									$field_name			= str_replace(' ', '-', strtolower($label_name));
									$length 			= $getCustomField->length;
									$default_value 		= $getCustomField->default_value;
									$place_holder 		= $getCustomField->place_holder;
									$is_desktop_view 	= $getCustomField->is_desktop_view;
									$is_mobile_view 	= $getCustomField->is_mobile_view;
									$mandatory_field 	= $getCustomField->mandatory_field;
									$PBC_field_id 		= $getCustomField->custom_block_field_id;
									//$filedname 			= slugurl($label_name);
									
									$uniquelabel=$fieldtype.$PBC_field_id;
									$required='';
									$astrisk='';
									if($mandatory_field==1){
										$required='required';
										$astrisk='<span class="astrisk">*</span>';
									}
									$valuetext='';
									if(!empty($default_value)){
										$valuetext=$default_value;
									}
									$lengthtext='';
									if(!empty($length) && ($fieldtype=='text' || $fieldtype=='number')){
										$lengthtext='maxlength="'.$length.'"';
									}
									
									$predynamicBlock = isset($pre_dynamic_block[$product_block_id]) ? $pre_dynamic_block[$product_block_id] : 0;
									$valueExist=0;
									//print_r($predynamicBlock);exit;
									if(!empty($predynamicBlock)){
										$valuetext = isset($predynamicBlock['customfields'][$field_name]) ? $predynamicBlock['customfields'][$field_name] : $valuetext;
										$valueExist=1;
									}

									  if($place_holder=='XXX-XXX-XXXX')
									  {
										$onkey = " onkeypress='addDashesphone(this)'  minlength='12' maxlength='12' ";
									  }
									  else  if($place_holder=='00000')
									  {
										$onkey = " onkeypress='return isNumberKey(this)'  maxlength='5' minlength='5' ";
									  }
									  else if($place_holder=='00/00/0000')
									  {
										$onkey = " onkeypress='addDashesdob(this)' ";
									  }
									  else if($place_holder=='XXX-XX-XXXX')
									  {
										$onkey = " onkeypress='addDashesssn(this)'   maxlength='11' minlength='11' ";
									  }
									  else
									  {
										 $onkey ='';
									  }
									?>
									<input type="hidden" name="custom_block_field_id[]" value="<?php echo $PBC_field_id;?>" />
									<input type="hidden" name="fieldtype[]" value="<?php echo $fieldtype;?>" />
									<input type="hidden" name="fieldname[]" value="<?php echo $field_name;?>" />
									<?php $coloumn='col-lg-6'; if($fieldtype=='file'){$coloumn='col-lg-12';}?>
										<div class="form-group <?php echo $coloumn;?>">
										<h2 for="<?php echo $uniquelabel;?>" class="checklist-title"><?php echo $label_name;?><?php echo $astrisk;?></h2>
								  <?php if($fieldtype=='textarea'){?>
										<textarea class="form-control" id="<?php echo $uniquelabel;?>" name="block_<?php echo $product_block_id;?>[<?php echo $PBC_field_id;?>]" <?php echo $required;?> <?php echo $lengthtext;?> placeholder="<?php echo $place_holder;?>" ><?php echo $valuetext;?> </textarea>
								  <?php }
									else if($fieldtype=='checkbox' || $fieldtype=='select' || $fieldtype=='multiple'){
										$option_fields 		= explode(',',$getCustomField->option_fields);
										
										if($fieldtype=='checkbox'){
											foreach($option_fields as $getOptionValue){
											$valuetext=$getOptionValue;
										?>
											<input class="form-control" id="<?php echo $uniquelabel;?>" type="<?php echo $fieldtype;?>" name="block_<?php echo $product_block_id;?>[<?php echo $PBC_field_id;?>]" <?php echo $required;?> value="<?php echo $valuetext;?>" />
											<?php echo $getOptionValue;?>
										<?php 
										}
										}
											if ($fieldtype=='select'){ ?>
										  <select class="form-control" id="<?php echo $uniquelabel;?>" name="block_<?php echo $product_block_id;?>[<?php echo $PBC_field_id;?>]" <?php echo $required;?>>
											<option value="">Select</option>
											<?php foreach($option_fields as $restype){?>
											<option value="<?php echo $restype;?>"><?php echo $restype;?></option>
											<?php } ?>
										  </select>
								  <?php }
										  if ($fieldtype=='multiple'){ ?>
										  <select class="form-control" id="<?php echo $uniquelabel;?>" name="block_<?php echo $product_block_id;?>[<?php echo $PBC_field_id;?>]" <?php echo $required;?> multiple="multiple">
											<option value="">Select</option>
											<?php foreach($option_fields as $restype){?>
											<option value="<?php echo $restype;?>"><?php echo $restype;?></option>
											<?php } ?>
										  </select>
								  <?php }
									}else if($fieldtype=='file'){
											if(!empty($valuetext) && !empty($valueExist)){
												$required='';
											}
											  if($module_selected=='contract')
											  {
												?>
												<?php if(isset($downloadlink) && isset($iscontractUploaded)){?>
													<div class="download-section">										
														<p>Download contract and upload the sign contract. </p>
														<div class="btn-group">
														<a href="<?php echo $downloadlink; ?>" class="btn btn-primary downloadpdf" download=""  target="_blank" ><i class="fa fa-download" aria-hidden="true" ></i> Download</a>
														<a href="javascript:void(0);" class="btn btn-primary print"  onclick="printimage('<?php echo $downloadlink; ?>')"><i class="fa fa-print" aria-hidden="true"></i>Print</a>
														</div> 
														<?php if($iscontractUploaded==1){ $required=''; ?>
														<a href="<?php echo $downloadlink;?>" class="btn btn-primary" target="_blank">View Your Uploaded Document</a>
														<?php } ?>
													</div>
												<?php } ?>
											  <?php
											  }
											?>
										<div class="row">	
											<div class="col-lg-6">									
												<div class="file-upload-wrapper card" style="background-color:#f0f8ff;">
													<i class="fa fa-cloud-upload" aria-hidden="true"></i>
														<input class="file-upload" id="<?php echo $uniquelabel;?>" type="<?php echo $fieldtype;?>" name="<?php echo $PBC_field_id;?>_dynamic_file" <?php echo $required;?> <?php echo $lengthtext;?>  />
												</div>
											</div>
									
										<?php if(!empty($valuetext) && !empty($valueExist)){?>
											<input type="hidden" name="<?php echo $PBC_field_id;?>_dynamic_filevalue" value="<?php echo $valuetext;?>" />
												<div class="card col-lg-6">
													<div class="uploadImg">
											<?php
												$supported_image = array('gif','jpg','jpeg','png');
												$src_file_name = $valuetext;
												$ext = strtolower(pathinfo($src_file_name, PATHINFO_EXTENSION)); // Using strtolower to overcome case sensitive
	
													if (in_array($ext, $supported_image)) {?>

															<a href="<?php echo $valuetext;?>" target="_blank"><img class="card-img-top img-fluid" src="<?php echo $valuetext;?>"/></a>
															<?php } else { ?>
															<a href="<?php echo $valuetext;?>" class="btn btn-primary" target="_blank">View Your Uploaded Document</a>
													<?php }?> 
												</div>
												</div>
											<?php } ?>

										</div>
										
								
											
									<?php }else{ 
										?>
										<input class="form-control" <?php echo $onkey; ?> id="<?php echo $uniquelabel;?>" type="<?php echo $fieldtype;?>" name="block_<?php echo $product_block_id;?>[<?php echo $PBC_field_id;?>]" <?php echo $required;?> value="<?php echo $valuetext;?>" placeholder="<?php echo $place_holder;?>" <?php echo $lengthtext;?> />
								  <?php } ?>
								</div>
								<?php } 
								}?>
								
							<?php } ?>
									<div class="form-group col-lg-12">
									<?php if($product_block_id==6) { ?>		
											<!--onclick="return timerhere('<?php //echo $uniquelabel;?>')"-->
										<button class="btn btn-primary" id="<?php echo $btnTypeId; ?>"  type="<?php echo $btnType;?>"> <?php echo $submitBtn;?></button>
										
									<?php }else if($module_selected=='contract' && isMobile() && empty($contract_sign->sign)){ ?>
											<button class="btn btn-primary" id="<?php echo $btnTypeId; ?>" onclick="return submitsign('<?php echo $formId;?>')"  type="button"> <?php echo $submitBtn;?></button>
									<?php }else { 
											if($disputeflag!=1){										
											?>
												<button class="btn btn-primary" id="<?php echo $btnTypeId; ?>" type="<?php echo $btnType;?>"> <?php echo $submitBtn;?></button>
											<?php }
											} ?>
									</div>
							  </div>
							</form>
						
						</div>
					</div>
                <?php $c++; } ?>
					  
				</div>
            </div>
            <?php } ?>
          </div>
      </div>
    </div>
  </div>
  <!-- Container-fluid Ends--> 
</div>


<script src="<?php echo ASSETSPATH; ?>js/jquery-3.2.1.min.js"></script> 


<script>
$('#selectAll2').click(function(e) {
    if($(this).hasClass('checkedAll')) {
      $('.selectall').prop('checked', false);   
      $(this).removeClass('checkedAll');
    } else {
      $('.selectall').prop('checked', true);
      $(this).addClass('checkedAll');
    }
}); 


function stepno(stepId,totalsteps)
{
	for(var i=1;i<=totalsteps;i++){
		if(i==stepId){
			$('#step-'+stepId).show();
			$('#step-'+stepId).addClass('show');
			$('#stepmenu_'+stepId).removeClass();
			$('#stepmenu_'+stepId).addClass('selected');
		}else{
			$('#step-'+i).hide();
			$('#stepmenu_'+i).removeClass();
			$('#stepmenu_'+i).addClass('nav-link deselected');
		}
	}
}

function stepnocontact(stepId,totalsteps)
{
	stepno(stepId,totalsteps);
	$('#step-'+stepId).show();
	$('#stepmenu_'+stepId).removeClass();
	$('#stepmenu_'+stepId).addClass('selected');
	
	
}

function readURL(input,path) {
	if (input.files && input.files[0]) {
		var reader = new FileReader();

		reader.onload = function (e) {
			$('#'+path).attr('src', e.target.result);
		};

		reader.readAsDataURL(input.files[0]);
	}
}

/*function checkindentityiq(stepno)
{
    $.ajax({
		type: 'post',
		url: '<?php echo base_url('order/savestep'); ?>',
		data: $('#indentityiqform').serialize(),
		beforeSend: function () {
			var username = $('#username2').val();
			var password = $('#password2').val();
			var ssn = $('#roll_no2').val();
			if(username=='' || password=='' || ssn==''){
				alert('Field should not be empty!');
			}else {
				$('#progress-'+stepno).show();
			}
		},
		success: function (response) {
			setTimeout(function(){ window.location.reload(); }, 90000);
		}
    });
}*/

</script>

<script>
  $( function() {
	  
	$('.file-upload').file_upload();
	  
    var progressbar = $( "#progressbar" ),
      progressLabel = $( ".progress-label" );
 
    progressbar.progressbar({
      value: false,
      change: function() {
        progressLabel.text( progressbar.progressbar( "value" ) + "%" );
      },
      complete: function() {
        progressLabel.text( "Complete!" );
      }
    });
 
    function progress() {
      var val = progressbar.progressbar( "value" ) || 0;
 
      progressbar.progressbar( "value", val + 2 );
 
      if ( val < 99 ) {
        setTimeout( progress, 80 );
      }
    }
 
    setTimeout( progress, 2000 );
  } );
  </script>
 
<style type="text/css">
 #sign-pad
 {
  height: 175px !important;
  width: 400px !important;
 } 
</style>
  <!-- Small modal-->

<div id="divLoading" class="orderstatu-loading">
	<div class="loadingBox">
		<img src="<?php echo base_url('assets/images/loading.gif'); ?>" style="width:100px;">
		<span id="timer" class="timer"></span>
		<p class="loaderContent"> Please be patient as this process <br> can take you 2-4 minutes to complete.... </p>  
	</div>
</div>

<script>
var count=0;

<?php if(isset($_GET['identityIq'])==1 && $isdisputeflag==0){?>
showloading();
<?php } ?>
function timerhere(field)
{
    var field1 = $('#'+field).val();
    if(field1=='')
    {
      alert('Please fill all the fields');
      return false;
    }
    else
    {
     $('#divLoading').show();
      count= 1;
      var counter=setInterval(timer, 60000); 
      setTimeout(function(){ $('#indentityiqform').submit(); }, 60000);
    }
}
function showloading(){
	$('#divLoading').show();
	count= 2;
	var counter=setInterval(timer, 60000); 
	setTimeout(function(){ window.location.reload(true); }, 120000);
}
</script>
<script type="text/javascript">
/*function timer()
{
  count=count-1;
  if (count <= 0)
  {
     clearInterval(counter);
     //counter ended, do something here
     return;
  }
  //Do code for showing the number of seconds here
}*/

function timer()
{
  count=count-1;
  if (count <= 0)
  {
     clearInterval(counter);
     return;
  }

 document.getElementById("timer").innerHTML=count + " minutes"; // watch for spelling
}
</script>


<script>
function isNumberKey(evt)
  {
     var charCode = (evt.which) ? evt.which : event.keyCode
     if (charCode != 45  && charCode > 31 && (charCode < 48 || charCode > 57))
        return false;

     return true;
  }

function addDashesssn(f) {
  var r = /(\D+)/g,
  npa = '',
  nxx = '',
  last4 = '';
  f.value = f.value.replace(r, '');
  npa = f.value.substr(0, 3);
  nxx = f.value.substr(3, 2);
  last4 = f.value.substr(5, 4);
  f.value = npa + '-' + nxx + '-' + last4;
}

function addDashesphone(f) {
  var r = /(\D+)/g,
  npa = '',
  nxx = '',
  last4 = '';
  f.value = f.value.replace(r, '');
  npa = f.value.substr(0, 3);
  nxx = f.value.substr(3, 3);
  last4 = f.value.substr(6, 3);
  f.value = npa + '-' + nxx + '-' + last4;
}

function addDashesdob(f)
{
  var r = /(\D+)/g,
  npa = '',
  nxx = '',
  last4 = '';
  f.value = f.value.replace(r, '');
  npa = f.value.substr(0,2);
  nxx = f.value.substr(2,2);
  last4 = f.value.substr(4, 3);
  f.value = npa + '/' + nxx + '/' + last4;
}

function printimage(img)
{
    var W = window.open(img);

    W.window.print();
}

<?php if($this->session->flashdata('msg')) { ?> 
	$(document).ready(function(){
		//$('#myModal').modal({backdrop: 'static', keyboard: false})  
		$("#myModal_message").modal();
	});
<?php } ?>

</script>

<div class="modal orderstep-status" id="myModal">
  <div class="modal-dialog modal-md">
	<div class="modal-content">
	  <div class="modal-header">
			<h4 class="modal-title" id="mySmallModalLabel">Complete the Previous Step</h4>
		<button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
	  </div>
	</div>
  </div>
</div>

<div class="modal orderstep-status" id="myModal_message">
  <div class="modal-dialog modal-lg">
	<div class="modal-content">
	  <div class="modal-header"><?php if($this->session->flashdata('msg')) { ?> <?php echo $this->session->flashdata('msg');?><?php } ?><button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">X</span></button></div>
	  </div>
	</div>
</div>
  
</div>

		
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
