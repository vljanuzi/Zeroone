<?php

    require_once('initialize.php');
    require_once('header.php');

    global $db;

    if(is_post()){

      $customer=[];
      $customer['first_name'] = $_POST['name'] ?? '';
      $customer['last_name']  = $_POST['surname']  ?? '';
      $customer['email'] = $_POST['email'] ?? '';
      $customer['address'] = $_POST['address'] ?? '';
      $customer['need'] = $_POST['need'] ?? '';
      $customer['message'] = $_POST['message'] ?? '';      


      $email = $customer['email'];


      $to = 'zeroone.thessaloniki@gmail.com';
      $subject = $customer['need'];
      $message_body = $customer['message'] . " from " . $email;

      mail($to,$subject,$message_body); 
      /*work on it*/
      redirect_to("contact_confirm.php");
}
?>

<div class="jumbotron jumbotron-fluid" style="background-color: #ffc107">
  <div class="container" >
    <h1 class="display-4">Contact us!</h1>
    <p class="lead">Want to get in touch? Fill out the form below to send us a message and we will get back to you as soon as possible!
</p>
  </div>
</div>
<form id="contact-form" method="post" action="contact.php" role="form">

    <div class="messages"></div>

    <div class="controls col-md-8 center">

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="form_name">First name</label>
                    <input id="form_name" type="text" name="name" class="form-control" placeholder="Please enter your first name" required="required" data-error="Firstname is required.">
                    <div class="help-block with-errors"></div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="form_lastname">Last name</label>
                    <input id="form_lastname" type="text" name="surname" class="form-control" placeholder="Please enter your last name" required="required" data-error="Lastname is required.">
                    <div class="help-block with-errors"></div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="form_email">Email</label>
                    <input id="form_email" type="email" name="email" class="form-control" placeholder="Please enter your email" required="required" data-error="Valid email is required.">
                    <div class="help-block with-errors"></div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="form_need">Please specify your need</label>
                    <select id="form_need" name="need" class="form-control" required="required" data-error="Please specify your need.">
                        <option value=""></option>
                        <option value="Request quotation">Request quotation</option>
                        <option value="Request order status">Request order status</option>
                        <option value="Request copy of an invoice">Request copy of an invoice</option>
                        <option value="Other">Other</option>
                    </select>
                    <div class="help-block with-errors"></div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="form_message">Message</label>
                    <textarea id="form_message" name="message" class="form-control" placeholder="Message for us" rows="4" required="required" data-error="Please, leave us a message."></textarea>
                    <div class="help-block with-errors"></div>
                </div>
            </div>
            <div class="col-md-12">
                <input type="submit" class="btn btn-warning btn-send" value="Send message">
            </div>
        </div>
        <div class="row">
            <br>
        </div>
    </div>

</form>
<?php 

include("footer.php");

?>