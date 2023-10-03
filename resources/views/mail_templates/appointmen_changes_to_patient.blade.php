<!DOCTYPE html>
<html>
<head>
    <title>Appointment Status</title>
</head>
<body>
    <p>Your appointment has been updated with the following details:</p>
    <p>Date: {{ date('d/m/Y', strtotime($appointment->appointment->date)) }}</p>
    <p>Time: {{ date('g:i a', strtotime($appointment->appointment->time)) }}</p>
    <p>Status: {{ $appointment->status }}</p>
    <p>Thank you for choosing our services!</p>
</body>
</html>
