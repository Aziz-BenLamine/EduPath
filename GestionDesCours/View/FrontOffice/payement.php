<?php
require_once '../../Controller/courscontroller.php';

if (isset($_GET['id'])) {
    $courseId = $_GET['id'];
    $controller = new CoursController();
    $course = $controller->getCourseById($courseId);

    if ($course) {

    } else {
        echo "<p>Course not found.</p>";
    }
} else {
    echo "<p>No course ID provided.</p>";
}
?>
<h1>Payment Details</h1>
<h2>Course: <?php echo htmlspecialchars($course['titre']); ?></h2>
<h2>Price: <?php echo htmlspecialchars($course['prix']); ?> TND</h2>
<form id="paymentForm" action="process_payment.php" method="POST">
    <input type="hidden" name="course_id" value="<?php echo htmlspecialchars($course['id']); ?>">
    <div>
        <label for="cardNumber">Card Number:</label>
        <input type="text" id="cardNumber" name="card_number" maxlength="16" required>
        <span id="cardType"></span>
    </div>
    <div>
        <label for="cardExpiry">Expiry Date:</label>
        <input type="text" id="cardExpiry" name="card_expiry" placeholder="MM/YY" required>
    </div>
    <div>
        <label for="cardCVC">CVC:</label>
        <input type="text" id="cardCVC" name="card_cvc" required>
    </div>
    <button type="submit">Pay Now</button>
</form>

<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f0f8ff;
        color: #333;
    }
    form {
        background-color: #e6f7ff;
        padding: 20px;
        border-radius: 8px;
        max-width: 400px;
        margin: auto;
    }
    div {
        margin-bottom: 15px;
    }
    label {
        display: block;
        margin-bottom: 5px;
    }
    input[type="text"] {
        width: 100%;
        padding: 8px;
        box-sizing: border-box;
        border: 1px solid #ccc;
        border-radius: 4px;
    }
    button {
        background-color: #007bff;
        color: white;
        padding: 10px 15px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }
    button:hover {
        background-color: #0056b3;
    }
</style>

<script>
    document.getElementById('paymentForm').addEventListener('submit', function(event) {
        var cardNumber = document.getElementById('cardNumber').value;
        var cardExpiry = document.getElementById('cardExpiry').value;
        var cardCVC = document.getElementById('cardCVC').value;

        var cardNumberPattern = /^\d{16}$/;
        var cardExpiryPattern = /^(0[1-9]|1[0-2])\/\d{2}$/;
        var cardCVCPattern = /^\d{3}$/;

        if (!cardNumberPattern.test(cardNumber)) {
            alert('Please enter a valid 16-digit card number.');
            event.preventDefault();
        } else if (!cardExpiryPattern.test(cardExpiry)) {
            alert('Please enter a valid expiry date in MM/YY format.');
            event.preventDefault();
        } else if (!cardCVCPattern.test(cardCVC)) {
            alert('Please enter a valid 3-digit CVC.');
            event.preventDefault();
        }
    });

    document.getElementById('cardNumber').addEventListener('input', function() {
        var cardNumber = this.value;
        var cardType = '';

        if (/^4/.test(cardNumber)) {
            cardType = 'Visa';
        } else if (/^5[1-5]/.test(cardNumber)) {
            cardType = 'MasterCard';
        } else if (/^3[47]/.test(cardNumber)) {
            cardType = 'American Express';
        } else if (/^6/.test(cardNumber)) {
            cardType = 'D17';
        }

        document.getElementById('cardType').textContent = cardType;
    });
</script>