<?php
$pageTitle = 'Donation';
$pageDescription = 'Support Christian University College through financial contributions and sponsorship.';

$donationData = [
    'full_name' => '',
    'email' => '',
    'phone' => '',
    'amount' => '',
    'purpose' => '',
    'message' => ''
];
$donationStatus = '';
$donationMessage = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $donationData['full_name'] = trim((string)($_POST['donor_full_name'] ?? ''));
    $donationData['email'] = trim((string)($_POST['donor_email'] ?? ''));
    $donationData['phone'] = trim((string)($_POST['donor_phone'] ?? ''));
    $donationData['amount'] = trim((string)($_POST['donation_amount'] ?? ''));
    $donationData['purpose'] = trim((string)($_POST['donation_purpose'] ?? ''));
    $donationData['message'] = trim((string)($_POST['donation_message'] ?? ''));

    $normalizedAmount = str_replace(',', '', $donationData['amount']);
    $amountValid = is_numeric($normalizedAmount) && (float)$normalizedAmount > 0;

    if (
        $donationData['full_name'] === '' ||
        $donationData['email'] === '' ||
        !filter_var($donationData['email'], FILTER_VALIDATE_EMAIL) ||
        !$amountValid
    ) {
        $donationStatus = 'error';
        $donationMessage = 'Please provide your name, valid email, and a donation amount greater than 0.';
    } else {
        $to = 'finance@cuc.edu.lr';
        $amount = number_format((float)$normalizedAmount, 2, '.', '');
        $subject = 'New Donation Submission - ' . $donationData['full_name'];
        $emailBody = "A new donation submission was received from the CUC website.\n\n";
        $emailBody .= "Full Name: {$donationData['full_name']}\n";
        $emailBody .= "Email: {$donationData['email']}\n";
        $emailBody .= "Phone: " . ($donationData['phone'] !== '' ? $donationData['phone'] : 'Not provided') . "\n";
        $emailBody .= "Donation Amount (USD): {$amount}\n";
        $emailBody .= "Donation Purpose: " . ($donationData['purpose'] !== '' ? $donationData['purpose'] : 'General Support') . "\n";
        $emailBody .= "Submitted: " . date('Y-m-d H:i:s') . "\n\n";
        $emailBody .= "Donor Message:\n" . ($donationData['message'] !== '' ? $donationData['message'] : 'No message provided.') . "\n";

        $headers = [
            'From: CUC Website <no-reply@cuc.edu.lr>',
            'Reply-To: ' . $donationData['email'],
            'Content-Type: text/plain; charset=UTF-8'
        ];

        $mailSent = mail($to, $subject, $emailBody, implode("\r\n", $headers));

        if ($mailSent) {
            $donationStatus = 'success';
            $donationMessage = 'Thank you for your generosity. Your donation details were sent successfully. Our finance team will contact you shortly.';
            $donationData = [
                'full_name' => '',
                'email' => '',
                'phone' => '',
                'amount' => '',
                'purpose' => '',
                'message' => ''
            ];
        } else {
            $donationStatus = 'error';
            $donationMessage = 'We could not send your donation details right now. Please try again or email finance@cuc.edu.lr directly.';
        }
    }
}

include 'includes/header.php';
?>

<section
    class="page-hero donation-hero"
    style="background: linear-gradient(120deg, rgba(20, 27, 45, 0.9), rgba(140, 21, 21, 0.82)), url('assets/images/slider2.jpeg') center/cover no-repeat;">
    <div class="container donation-hero-inner">
        <span class="eyebrow">Donate</span>
        <h1>Support the Next Generation at CUC</h1>
        <p>Your support helps expand scholarships, learning resources, campus development, and student success programs.</p>
        <div class="btn-row contact-hero-actions">
            <a href="#donation-form" class="btn btn-light">Fill Donation Form</a>
            <a href="mailto:finance@cuc.edu.lr" class="btn btn-primary">Email Finance Office</a>
        </div>
    </div>
</section>

<section class="section section-tinted donation-section" id="donation-form">
    <div class="container donation-layout">
        <article class="callout reveal-on-scroll">
            <h2>Why Your Donation Matters</h2>
            <ul class="clean-list">
                <li>Funds scholarships for deserving students</li>
                <li>Strengthens library and digital learning resources</li>
                <li>Supports campus and classroom improvements</li>
                <li>Expands student mentorship and outreach programs</li>
            </ul>
            <p><strong>Finance Office:</strong> finance@cuc.edu.lr</p>
            <p><strong>Phone:</strong> +231 88 1846 653</p>
            <a href="contact.php" class="btn btn-light">Need Help? Contact Us</a>
        </article>

        <article class="callout reveal-on-scroll donation-form-card">
            <h2>Donation Form</h2>
            <p>Share your contact information and the amount you want to contribute. Our finance office will follow up with payment instructions.</p>

            <?php if ($donationStatus !== ''): ?>
                <div class="form-alert <?= $donationStatus === 'success' ? 'form-alert-success' : 'form-alert-error' ?>">
                    <?= htmlspecialchars($donationMessage, ENT_QUOTES, 'UTF-8') ?>
                </div>
            <?php endif; ?>

            <form class="contact-form" action="" method="post">
                <label for="donor-full-name">Full Name</label>
                <input type="text" id="donor-full-name" name="donor_full_name" placeholder="Your full name" value="<?= htmlspecialchars($donationData['full_name'], ENT_QUOTES, 'UTF-8') ?>" required>

                <label for="donor-email">Email Address</label>
                <input type="email" id="donor-email" name="donor_email" placeholder="you@example.com" value="<?= htmlspecialchars($donationData['email'], ENT_QUOTES, 'UTF-8') ?>" required>

                <label for="donor-phone">Phone Number</label>
                <input type="text" id="donor-phone" name="donor_phone" placeholder="+231..." value="<?= htmlspecialchars($donationData['phone'], ENT_QUOTES, 'UTF-8') ?>">

                <label>Quick Amount</label>
                <div class="donation-amount-presets" aria-label="Donation amount presets">
                    <button type="button" class="donation-amount-chip" data-amount="25">$25</button>
                    <button type="button" class="donation-amount-chip" data-amount="50">$50</button>
                    <button type="button" class="donation-amount-chip" data-amount="100">$100</button>
                    <button type="button" class="donation-amount-chip" data-amount="250">$250</button>
                    <button type="button" class="donation-amount-chip" data-amount="500">$500</button>
                </div>

                <label for="donation-amount">Donation Amount (USD)</label>
                <input type="number" id="donation-amount" name="donation_amount" min="1" step="0.01" placeholder="100.00" value="<?= htmlspecialchars($donationData['amount'], ENT_QUOTES, 'UTF-8') ?>" required>

                <label for="donation-purpose">Donation Purpose</label>
                <select id="donation-purpose" name="donation_purpose">
                    <option value="" <?= $donationData['purpose'] === '' ? 'selected' : '' ?>>General Support</option>
                    <option value="Student Scholarships" <?= $donationData['purpose'] === 'Student Scholarships' ? 'selected' : '' ?>>Student Scholarships</option>
                    <option value="Library and Learning Resources" <?= $donationData['purpose'] === 'Library and Learning Resources' ? 'selected' : '' ?>>Library and Learning Resources</option>
                    <option value="Campus Development" <?= $donationData['purpose'] === 'Campus Development' ? 'selected' : '' ?>>Campus Development</option>
                    <option value="Technology and Innovation" <?= $donationData['purpose'] === 'Technology and Innovation' ? 'selected' : '' ?>>Technology and Innovation</option>
                </select>

                <label for="donation-message">Message (optional)</label>
                <textarea id="donation-message" name="donation_message" rows="5" placeholder="Any note for the finance office"><?= htmlspecialchars($donationData['message'], ENT_QUOTES, 'UTF-8') ?></textarea>

                <button type="submit" class="btn btn-primary">Submit Donation Details</button>
            </form>
        </article>
    </div>
</section>

<script>
(function () {
    var amountField = document.getElementById('donation-amount');
    var chips = document.querySelectorAll('.donation-amount-chip');

    if (!amountField || !chips.length) {
        return;
    }

    function setActiveChip(activeButton) {
        chips.forEach(function (button) {
            button.classList.toggle('is-active', button === activeButton);
        });
    }

    chips.forEach(function (button) {
        button.addEventListener('click', function () {
            var amount = button.getAttribute('data-amount');
            amountField.value = amount;
            amountField.focus();
            setActiveChip(button);
        });
    });

    amountField.addEventListener('input', function () {
        var currentValue = String(amountField.value || '').replace(/,/g, '');
        var matched = null;

        chips.forEach(function (button) {
            if (button.getAttribute('data-amount') === currentValue) {
                matched = button;
            }
        });

        setActiveChip(matched);
    });
})();
</script>

<?php include 'includes/footer.php'; ?>
