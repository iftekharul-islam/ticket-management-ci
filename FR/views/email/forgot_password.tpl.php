<html>
<body>
    <table align="center" border="0" cellpadding="0" cellspacing="0">
        <tbody>
            <tr><td style="color:#999999" width="600"><a href="<?=base_url()?>"><img src="<?=base_url()?>/assets/logo/<?=$site->email_template_logo?>" alt="<?=$site->app_title?>"></a></td></tr>
            <tr><td bgcolor="whitesmoke" height="200" style="background:whitesmoke; border:1px solid #e0e0e0; font-family:Helvetica,Arial,sans-serif" valign="top" width="600">
                    <table align="center" border="0" cellpadding="0" cellspacing="0">
                        <tbody>
                            <tr>
                                <td height="10" width="560"></td>
                            </tr>
                            <tr>
                                <td width="560">
                                    <h2 style="margin: 10px 15px;">Password Reset</h2>
                                    <p style="margin: 10px 15px;font-size:12px; font-family:Helvetica,Arial,sans-serif">Hello,</p>
                                    <p style="margin: 10px 15px;font-size:12px; line-height:20px; font-family:Helvetica,Arial,sans-serif">
                                        <?php echo sprintf(lang('email_forgot_password_subheading'), anchor('user/reset_password/'. $forgotten_password_code, lang('email_forgot_password_link')));?><br><br><br>Best Regards,<br><?=$site->app_title?> Support
                                    </p>
                                </td>
                            </tr>
                            <tr>
                                <td height="10" width="560"></td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
            <tr>
                <td align="right">
                    <span style="font-size:10px; color:#999999; font-family:Helvetica,Arial,sans-serif"><?=$site->company?></span>
                </td>
            </tr>
        </tbody>
    </table>
</body>
</html>