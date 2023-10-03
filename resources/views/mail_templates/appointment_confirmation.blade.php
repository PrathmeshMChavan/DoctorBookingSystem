<!DOCTYPE html>
<html>
<head>
    <title>Appointment Confirmation</title>
</head>
<body>
    <p>Your appointment has been confirmed for the following details:</p>
    <p>Date: {{ date('d/m/Y', strtotime($appointmentDate)) }}</p>
<p>Time: {{ date('g:i a', strtotime($appointmentTime)) }}</p>
    <p>Thank you for choosing our services!</p>
</body>
</html>
