<?php $this->load->view('emails/email_head'); ?>
Greetings!<br>
<br>
We hope you're doing well. As already announced, RoughSheet is now an invite-only platform and hence we are providing you with your unique Invitation Code.<br>
<br>
Share your Invitation Code with those who you think will benefit from RoughSheet.<br>
<p>Invitation Code: <?= $ic ?></p>
<br>
All the best!<br>
Regards,<br>
<br>
Ankur<br>
On behalf of Team RoughSheet
<?php $this->load->view('emails/email_footer'); ?>