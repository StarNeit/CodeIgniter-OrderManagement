Hello <?php echo $user->first_name?>

We received a request to reset your password.

In order to reset your password please follow this link or copy and paste it on browser:
<?php echo admin_url("auth/new_password/$user->id/$user->reset_password_key")?>


Best Regards