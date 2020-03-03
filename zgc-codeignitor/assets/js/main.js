$("#usersadduser").validate({
rules: {
	username: "required",
	first_name: "required",
	last_name: "required",
    email: {
            required: true,
            email: true
            },
	phone: "required",
	password: "required",
	user_type:'required'
  },
  messages: {
				username: "Please enter your username",
				first_name: "Please enter your first name",
				last_name: "Please enter your last name",
				email: "Please enter your email",
				phone: "Please enter your phone",
				password: "Please enter your password",
				user_type: "select user type",
			}
});


$("#usersaddcategory").validate({
rules: {
	category_name: "required",
	status: "required",
  },
  messages: {
				category_name: "Please enter category name",
				status: "Please select status",
			}
});




$("#usersaddusertype").validate({
rules: {
	user_type_name: "required",
	status: "required",
  },
  messages: {
				user_type_name: "Please enter user type",
				status: "Please select status",
			}
});


$("#addproduct").validate({
rules: {
  product_name: "required",
  category_id: "required",
  selling_price:{
            required: true,
            number: true
              },
  product_cost:{
            required: true,
            number: true
            }, 
   qty:{
            required: true,
            number: true
            },
  description:"required",
  refund_policy:"required",
  },
  messages: {
        product_name: "Please enter product name",
        category_id: "Please select category",
        selling_price: "Please select selling price",
        product_cost: "Please select product cost",
        qty: "Please select quantity",
        description: "Please select description",
        refund_policy: "Please select refund policy",

      }
});



$("#loginform").validate({
rules: {
	username: "required",
	password: "required",
  },
  messages: {
				username: "Please enter your username",
				password: "Please enter your password",
			}
});


$("#forgetpassword").validate({
rules: {
	username: "required",
  },
  messages: {
				username: "Please enter your username",
			}
});


$("#registerform").validate({
rules: {
	username: "required",
	first_name: "required",
	last_name: "required",
    email: {
            required: true,
            email: true
            },
	phone: "required",
	password: "required",
	confirm_password:{required:true,equalTo: "#password"},
  },
  messages: {
				username: "Please enter your username",
				first_name: "Please enter your first name",
				last_name: "Please enter your last name",
				email: "Please enter your email",
				phone: "Please enter your phone",
				password: "Please enter your password",
				confirm_password: {
					required: "Please enter your confirm password",
					equalTo: "Please enter the same password as above"
				},
			}
});




 


function doconfirm()
{
  job=confirm("Are you sure to delete permanently?");
  if(job!=true)
  {
    return false;
  }
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