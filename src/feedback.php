<?php
require 'load.php';

$ObjLayout->head_ownerdash('Feedback');
$ObjLayout->navbar_ownerdash();

// Fetch feedback from the database
try {
    // Select all rows from tbl_feedback

    $feedbackData = $conn->select('tbl_feedback', '*');
} catch (Exception $e) {
    $feedbackData = [];
    $errorMessage = "Error retrieving feedback: " . $e->getMessage();
}
?>

<head>
    <link rel="stylesheet" href="owner.css">
</head>

<div class="container" id="main-content">
    <div class="form-section">
        <h2>Customer Feedback</h2>
        <?php if (isset($errorMessage)) : ?>
            <p class="error-message"><?php echo htmlspecialchars($errorMessage); ?></p>
        <?php endif; ?>

        <?php if (!empty($feedbackData)) : ?>
            <?php foreach ($feedbackData as $feedback) : ?>
                <div class="feedback-item">
                    <p><strong>Customer:</strong> <?php echo htmlspecialchars($feedback['customer_name']); ?></p>
                    <p><strong>Feedback:</strong> <?php echo htmlspecialchars($feedback['feedback']); ?></p>
                    <hr>
                </div>
            <?php endforeach; ?>
        <?php else : ?>
            <p>No feedback available at the moment.</p>
        <?php endif; ?>
    </div>
</div>
