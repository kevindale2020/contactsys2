<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 * @var \App\View\AppView $this
 */

$cakeDescription = 'CakePHP: the rapid development php framework';

?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        <?= $cakeDescription ?>:
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>
    <?= $this->Html->meta("myToken", $this->request->getAttribute("csrfToken")) ?>

    <link href="https://fonts.googleapis.com/css?family=Raleway:400,700" rel="stylesheet">

    <?= $this->Html->css('https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css') ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<body>
    <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
  <!-- Brand -->
  <a class="navbar-brand" href="#">Contact Sys</a>

  <!-- Links -->
  <ul class="navbar-nav">
    <?php if($loggedIn): ?>
   <li class="nav-item">
       <?= $this->Html->link('Home', '/user', ['class' => 'nav-link']); ?>
    </li>
    <li class="nav-item">
      <?= $this->Html->link('Contacts', '/user/contacts', ['class' => 'nav-link']); ?>
    </li>
    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
        <?=$user['email'];?>
      </a>
      <div class="dropdown-menu">
        <?= $this->Html->link('My Profile', '/user/profile', ['class' => 'dropdown-item']); ?>
       <?= $this->Html->link('Logout', '/logout', ['class' => 'dropdown-item']); ?>
      </div>
    </li>
<?php else: ?>
    <li class="nav-item">
       <?= $this->Html->link('Home', '/', ['class' => 'nav-link']); ?>
    </li>
    <li class="nav-item">
      <?= $this->Html->link('Register', '/register', ['class' => 'nav-link']); ?>
    </li>
    <li class="nav-item">
      <?= $this->Html->link('Login', '/login', ['class' => 'nav-link']); ?>
    </li>
<?php endif; ?>
    <!-- Dropdown -->
    <!-- <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
        Dropdown link
      </a>
      <div class="dropdown-menu">
        <a class="dropdown-item" href="#">Link 1</a>
        <a class="dropdown-item" href="#">Link 2</a>
        <a class="dropdown-item" href="#">Link 3</a>
      </div>
    </li> -->
  </ul>
</nav>
<br>
<div class="container">
  <?= $this->fetch('content') ?>
</div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<!--     <?= $this->Html->script('https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js') ?> -->
    <?= $this->Html->script('https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js') ?>
    <?= $this->Html->script('https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js') ?>
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="myToken"]').attr('content')
            }
        });
    </script>
    <script type="text/javascript">
      
      $(document).ready(function(){

        getProfile();

        getContacts();

        $('#regForm').submit(function(e){

            e.preventDefault();

            var name = $('#name').val();
            var email = $('#email').val();
            var pass1 = $('#pass1').val();
            var pass2 = $('#pass2').val();

            var message = "";

            if(name==''||email==''||pass1=='') {

                if(name=='') {

                    message += "Name is required\n";
                }

                if(email=='') {

                    message += "Email is required\n";
                }

                if(pass1=='') {

                    message += "Password is required\n";
                }

                alert(message);

                return false;
            }

            if(pass1 != pass2) {

                message += "Password does not match";

                alert(message);

                return false;
            }

            if(pass1.length < 8) {

                message += "Password should at least be 8 characters";

                alert(message);

                return false;
            }

            $.ajax({

                url: '<?=$this->Url->build('/register');?>',
                method: 'POST',
                data: new FormData(this),
                contentType: false,
                processData: false,
                success: function(data) {
                    
                    if(data.success==1) {

                        window.location.href='<?=$this->Url->build('/thankyou');?>';
                    }
                },
                error: function(jqXHR, status, error) {
                  console.log(status);
                  console.log(error);
                }
            });
        });

        $('#loginForm').submit(function(e){

            e.preventDefault();

            var email = $('#email').val();
            var password = $('#pass1').val();

            var message = "";

            if(email==''||password=='') {

                if(email=='') {

                    message += "Email is required";
                }

                if(password=='') {

                    message += "Password is required";
                }

                alert(message);

                return false;
            }

            $.ajax({

                url: '<?=$this->Url->build('/login');?>',
                method: 'POST',
                data: new FormData(this),
                contentType: false,
                processData: false,
                success: function(data) {

                    if(data.success==1) {
                        window.location.href='<?=$this->Url->build('/user');?>';
                    } else {

                        alert('Invalid credentials');
                    }
                },
                error: function(jqXHR, status, error) {
                  console.log(status);
                  console.log(error);
                }
            });
        });

        $('#profileForm').submit(function(e){

            e.preventDefault();

            var name = $('#name').val();
            var email = $('#email').val();

            var message = "";

            if(name==''||email=='') {

                if(email=='') {

                    message += "Email is required";
                }

                if(name=='') {

                    message += "Name is required";
                }

                alert(message);

                return false;
            }

            $.ajax({

                url: '<?=$this->Url->build('/user/profile');?>',
                method: 'POST',
                data: new FormData(this),
                contentType: false,
                processData: false,
                success: function(data) {

                   if(data.success==1) {
                    alert(data.message);
                    getProfile();
                   }
                },
                error: function(jqXHR, status, error) {
                  console.log(status);
                  console.log(error);
                }
            });
        });

        $('#contactForm').submit(function(e){

            e.preventDefault();

            var image = $('#image').val();
            var name = $('#name2').val();
            var company = $('#company').val();
            var email = $('#email2').val();
            var phone = $('#phone').val();


            var message = "";

            if(name==''||company==''||email==''||phone=='') {

                if(name=='') {

                    message += 'Name is required\n';
                }

                if(company=='') {

                    message += 'Company is required\n';
                }

                if(email=='') {

                    message += 'Email is required\n';
                }

                if(phone=='') {

                    message += 'Phone is required\n';
                }

                alert(message);

                return false;
            }

            $.ajax({

                url: '<?=$this->Url->build('/user/contacts');?>',
                method: 'POST',
                data: new FormData(this),
                contentType: false,
                processData: false,
                success: function(data) {

                    if(data.success==1) {

                        alert(data.message);
                        $('#contactForm')[0].reset();
                        $('#contactModal').modal('hide');
                        getContacts();
                    }
                },
                error: function(jqXHR, status, error) {
                    console.log(status);
                    console.log(error);
                }

            });
        });

        $('#editContactForm').submit(function(e){

            e.preventDefault();

            var image = $('#image2').val();
            var name = $('#c-name').val();
            var company = $('#c-company').val();
            var email = $('#c-email').val();
            var phone = $('#c-phone').val();


            var message = "";

            if(name==''||company==''||email==''||phone=='') {

                if(name=='') {

                    message += 'Name is required\n';
                }

                if(company=='') {

                    message += 'Company is required\n';
                }

                if(email=='') {

                    message += 'Email is required\n';
                }

                if(phone=='') {

                    message += 'Phone is required\n';
                }

                alert(message);

                return false;
            }

            $.ajax({

                url: '<?=$this->Url->build('/user/edit');?>',
                method: 'POST',
                data: new FormData(this),
                contentType: false,
                processData: false,
                success: function(data) {

                    if(data.success==1) {

                        alert(data.message);
                        $('#editContactForm')[0].reset();
                        $('#contactModal2').modal('hide');
                        getContacts();
                    }
                },
                error: function(jqXHR, status, error) {
                    console.log(status);
                    console.log(error);
                }

            });
        });

        $(document).on('click', '.edit_contact', function(){

            var id = $(this).attr('data-id');
            var image = $(this).attr('data-image');
            var name = $(this).attr('data-name');
            var company = $(this).attr('data-company');
            var phone = $(this).attr('data-phone');
            var email = $(this).attr('data-email');

            // alert(name);

            $('#contact_id').val(id);
            $('#imgContact').attr('src', '../img/'+image);
            $('#c-name').val(name);
            $('#c-company').val(company);
            $('#c-phone').val(phone);
            $('#c-email').val(email);

            $('#contactModal2').modal('show');
        });

        $(document).on('click', '.delete_contact', function(){

            var id = $(this).attr('data-id');

            if(confirm('Are you sure you want to delete this contact?')) {

                $.ajax({
                  url: '<?=$this->Url->build('/user/delete');?>',
                  method: 'POST',
                  async: false,
                  data: {
                    delete_id: id
                  },
                  success: function(data) {

                      
                      if(data.success==1) {
                         alert(data.message);
                        getContacts();
                      }
                 }
                });
            } else {
              return false;
            }
        });
      });


        function getProfile() {

            $.ajax({
                url: '<?=$this->Url->build('/user/profile');?>',
                method: 'POST',
                async: false,
                data: {
                    profile: 1
                },
                success: function(data) {
                    // console.log(data.user['email']);
                    $('#imgProfile').attr('src', '../img/'+data.user['image']);
                    $('#name').val(data.user['name']);
                    $('#email').val(data.user['email']);
                }
            });
        }

         function getContacts() {

            $.ajax({
                url: '<?=$this->Url->build('/user/contacts');?>',
                method: 'POST',
                async: false,
                data: {
                    get_contacts: 1
                },
                success: function(data) {
                    // console.log(data.user['email']);
                   $('#contacts').html(data.results);
                }
            });
        }
    </script>
</body>
</html>
