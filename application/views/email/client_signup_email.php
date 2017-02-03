<table border="0" cellpadding="0" cellspacing="0" width="600" style="background-color: #fff; margin: 0 auto;border: 2px solid #ccc; font-family: Arial, Helvetica, sans-serif;">
<tr>
     <td align="center"><br/> 
         <img src="<?=site_url("assets/images/footer_logo.png")?>"><br/><br/>
     </td>
</tr>
<tr><td style="padding: 30px 40px;">
Hi <?=$user['name']?>,<br/><br/>

Thank you. Our team is currently reviewing your request and we’ll be in touch shortly.<br/><br/>

In the meantime, you can visit Homage.sgto find out more about our services. You’ll also be able to view the status of your request by using the information below:<br/><br/>

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
