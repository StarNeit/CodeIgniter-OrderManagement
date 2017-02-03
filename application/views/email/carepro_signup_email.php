<table border="0" cellpadding="0" cellspacing="0" width="600" style="background-color: #fff; margin: 0 auto;border: 2px solid #ccc; font-family: Arial, Helvetica, sans-serif;">
<tr>
     <td align="center"><br/> 
         <img src="<?=site_url("assets/images/footer_logo.png")?>"><br/><br/>
     </td>
</tr>
<tr><td style="padding: 30px 40px;">
Hi <?=$user['name']?>,<br/><br/>

Thank you for your application to join Homage.sg as a self-employed care professional. Our team is currently reviewing your application and we’ll be in touch shortly.<br/><br/>

In the meantime you can log in to Homage.sg at anytime to find out more about working with us. You’ll also be able to view the status of your application.<br/><br/>

<table>
    <tr><th colspan="2" align="left">Login Details</th></tr>
    <tr><td>Email</td><td>: <?=$user['email']?></td></tr>
    <tr><td>Password</td><td>: <?=$user['password']?></td></tr>
</table><br/><br/>

<p align="center"><a href="http://homage.appreneurs.co" target="_blank"><button style="background-color:#158fa6;width: 200px;height:30px;color:white">Login to Homage Portal</button></a></p>
<br/><br/>
		Best Regards,
		<br/>
		<i style="color: #666; font-size: 14px;"><b>Homage Team</b></i><br/>
 </td>
 </tr>
</table>
