<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Contact Us Inquiry</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f4f4f4; padding: 20px;">
    <table align="center" width="600" cellpadding="0" cellspacing="0" style="background: #ffffff; border: 1px solid #ddd;">
        <tr>
            <td style="text-align: center; padding: 20px;">
                <img src="<?= $logo ?>" alt="Logo" style="max-width: 150px;">
            </td>
        </tr>
        <tr>
            <td style="padding: 20px;">
                <h2 style="color: #333;">New Contact Us Message</h2>
                <p><strong>Subject:</strong> <?= $subject ?></p>
                <p><strong>Message:</strong><br><?= nl2br($description) ?></p>
                <hr>
                <h3 style="color: #555;">Sender Details</h3>
                <p><strong>Name:</strong> <?= $full_name ?></p>
                <p><strong>Email:</strong> <?= $email ?></p>
                <p><strong>Phone:</strong> <?= $phone ?></p>
            </td>
        </tr>
        <tr>
            <td style="text-align: center; background-color: #f0f0f0; padding: 10px; font-size: 12px; color: #999;">
                &copy; <?= $current_year ?> Your Company. All rights reserved.
            </td>
        </tr>
    </table>
</body>
</html>
