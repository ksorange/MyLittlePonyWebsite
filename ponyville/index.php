<?php
// Start session to save guestbook entries while browsing
session_start();

// Setup initial guestbook entries if empty
if (!isset($_SESSION['messages'])) {
    $_SESSION['messages'] = array(
        array('name' => 'Pinkie Pie', 'message' => 'Welcome to Ponyville! Make a wish!')
    );
}

// Check if user submitted a new message
if (isset($_POST['submit_message'])) {
    $name = trim($_POST['name']);
    $msg = trim($_POST['message']);

    if (!empty($name) && !empty($msg)) {
        // Put the new message at the top of the array
        array_unshift($_SESSION['messages'], array('name' => $name, 'message' => $msg));
    }
}

// Array of Mane 6 Ponies
$ponies = array(
    array('name' => 'Twilight Sparkle', 'element' => 'Magic', 'color' => '#e1bee7', 'quote' => 'Friendship is pure magic!'),
    array('name' => 'Pinkie Pie', 'element' => 'Laughter', 'color' => '#ffcdd2', 'quote' => 'Laughter is the best cure for sadness!'),
    array('name' => 'Rainbow Dash', 'element' => 'Loyalty', 'color' => '#b3e5fc', 'quote' => 'Always stay 20% cooler!'),
    array('name' => 'Fluttershy', 'element' => 'Kindness', 'color' => '#f0f4c3', 'quote' => 'Kindness conquers everything.'),
    array('name' => 'Rarity', 'element' => 'Generosity', 'color' => '#f8bbd0', 'quote' => 'Generosity never goes out of style!'),
    array('name' => 'Applejack', 'element' => 'Honesty', 'color' => '#ffe082', 'quote' => 'Honesty is the foundation of trust.')
);

// Pick a random pony when button is clicked
$my_pony = null;
if (isset($_POST['find_pony'])) {
    $random_index = rand(0, count($ponies) - 1);
    $my_pony = $ponies[$random_index];
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Ponyville - Welcome!</title>
    <style>
        body {
            background-color: #fff0f5;
            font-family: Arial, sans-serif;
            color: #333333;
            text-align: center;
            margin: 0;
            padding: 20px;
        }

        .container {
            width: 80%;
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border: 3px solid #ffb6c1;
            border-radius: 12px;
            padding: 20px;
        }

        h1 {
            color: #ff69b4;
            margin-bottom: 5px;
        }

        .box {
            background-color: #fffde7;
            border: 2px dashed #ffd54f;
            padding: 15px;
            margin: 20px 0;
            border-radius: 10px;
        }

        button, input[type="submit"] {
            background-color: #ff69b4;
            color: white;
            border: none;
            padding: 10px 15px;
            font-weight: bold;
            border-radius: 6px;
            cursor: pointer;
        }

        button:hover, input[type="submit"]:hover {
            background-color: #ff1493;
        }

        input[type="text"], textarea {
            width: 90%;
            padding: 8px;
            margin: 6px 0;
            border: 1px solid #ffb6c1;
            border-radius: 5px;
        }

        .guestbook-item {
            background-color: #f1f8e9;
            border-left: 4px solid #81c784;
            margin: 8px 0;
            padding: 8px;
            text-align: left;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Welcome to Ponyville!</h1>
    <p>Today is: <?php echo date("F j, Y"); ?></p>

    <!-- Part 1: Random Pony Picker -->
    <div class="box">
        <h2>Which Pony Are You Today?</h2>
        <form method="POST">
            <button type="submit" name="find_pony">Click to Reveal!</button>
        </form>

        <?php if ($my_pony != null): ?>
            <div style="margin-top: 15px; padding: 12px; background-color: <?php echo $my_pony['color']; ?>; border-radius: 8px;">
                <h3>You are: <?php echo $my_pony['name']; ?>!</h3>
                <p><strong>Element of Harmony:</strong> <?php echo $my_pony['element']; ?></p>
                <p><em>"<?php echo $my_pony['quote']; ?>"</em></p>
            </div>
        <?php endif; ?>
    </div>

    <!-- Part 2: Simple Guestbook -->
    <div class="box" style="background-color: #f3e5f5; border-color: #ce93d8;">
        <h2>Ponyville Guestbook</h2>
        <form method="POST">
            <input type="text" name="name" placeholder="Your Name..." required><br>
            <textarea name="message" rows="3" placeholder="Write a nice message..." required></textarea><br>
            <input type="submit" name="submit_message" value="Post Message">
        </form>

        <h3 style="text-align: left; margin-left: 5%;">Messages:</h3>
        <?php foreach ($_SESSION['messages'] as $msg): ?>
            <div class="guestbook-item">
                <strong><?php echo htmlspecialchars($msg['name']); ?>:</strong>
                <span><?php echo htmlspecialchars($msg['message']); ?></span>
            </div>
        <?php endforeach; ?>
    </div>

    <p style="font-size: 11px; color: #999;">Project Path: C:\xampp\htdocs\ponyville\index.php</p>
</div>

</body>
</html>