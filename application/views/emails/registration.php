<?php $this->load->view('emails/email_head');    ?>
Welcome to RoughSheet!<br/>
We are humbled by your trust in us. We hope that together we achieve your target.<br/>
<br/>
Hit reply to this email and tell us which company is your dream company where you wish to get placed and why. Let us know and we will further assist you.<br/>
Allow us 48 hours to get back to you.<br/>
<br/>
<br/>
We are very happy to see you join us.<br/>
Click on the link below to verify your email address:<br/>
<a href='<?= site_url() ?>registerme/<?= urlencode($enc_random) ?>/<?= urlencode($to) ?>'> Click Here!</a><br/>
<br/>
Now, let’s get started.<br/>
All the best!<br/>
<br/>
Regards,<br/>
<br/>
Ankur<br/>
On behalf of Team RoughSheet
<?php
 $this->load->view('emails/email_footer'); ?>