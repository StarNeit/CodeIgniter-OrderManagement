<table border="0" cellpadding="0" cellspacing="0" width="600" style="background-color: #fff; margin: 0 auto;border: 2px solid #ccc; font-family: Arial, Helvetica, sans-serif;">
<tr>
     <td style="padding: 30px 40px;">
         <?php /*<img src="<?=site_url("assets/images/logo.png")?>" style="width:100%;">*/?>
         <h1>Hello <?php echo $user->first_name.' '.$user->last_name?>,<br/></h1>
         <p> We received a request to reset your password.
         	<br/>
         	<br/>
            Email Address : <?php echo $user->email?><br>
            New password: <?php echo $user->password?><br><br/>
Click <a href="<?=base_url()?>">here</a> to login to Homage Portal<br>
        </p>
        <br/>
		Best Regards,
		<br/>
		<i style="color: #666; font-size: 14px;"><b>Homage Team</b></i><br/>
 </td>
 </tr>
</table>
