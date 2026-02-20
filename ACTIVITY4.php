<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gold Conversion Calculator UI</title>
    <style>
        /* --- Base Setup & Smooth Fluidity --- */
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            background-color: #48cae4; 
            font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            color: #1a1f36;
            padding: 20px;
        }

        .calculator-card {
            width: 100%;
            max-width: 420px;
            display: flex;
            flex-direction: column;
            gap: 20px;

            /* --- Added Border --- */
            border: 4px solid #1a1f36;
            border-radius: 12px;
            padding: 20px;
        }

        /* --- Header Section --- */
        .header {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
            color: #ffffff;
        }

        .header-icon {
            margin-right: 18px;
            flex-shrink: 0;
        }

        .header-icon svg {
            width: 75px;
            height: 75px;
            fill: none;
            stroke: #ffffff;
            stroke-width: 3;
            stroke-linecap: round;
            stroke-linejoin: round;
        }

        .header-text h1 {
            font-size: 26px;
            font-weight: 800;
            line-height: 1.15;
            letter-spacing: 0.5px;
        }

        .header-text p {
            margin-top: 6px;
            font-size: 15px;
            font-weight: 500;
            opacity: 0.9;
        }

        /* --- Interactive 3D Inputs --- */
        .input-wrapper {
            position: relative;
            width: 90%;
            margin-bottom: 12px; /* Added spacing between input bars */
        }

        .custom-input {
            width: 100%;
            background-color: #9eaef0;
            border: 2px solid transparent;
            border-bottom: 7px solid #5a669e; 
            border-radius: 16px;
            padding: 16px 20px;
            font-size: 16px;
            font-weight: 500;
            color: #ffffff;
            outline: none;
            position: relative;
            z-index: 1;
            transition: all 0.2s cubic-bezier(0.25, 0.8, 0.25, 1);
        }

        .custom-input::placeholder {
            color: #ffffff;
            font-weight: 400;
            opacity: 0.8;
        }

        .custom-input:focus {
            background-color: #b3c0f5;
            border-color: #ffffff;
            transform: translateY(-2px);
            box-shadow: 0 8px 15px rgba(0,0,0,0.1);
        }

        /* --- Interactive Calculate Button --- */
        .btn-wrapper {
            position: relative;
            width: 65%;
            margin: 10px auto;
        }

        .calc-btn {
            width: 100%;
            background-color: #9eaef0;
            border: none;
            border-bottom: 7px solid #5a669e;
            border-radius: 12px;
            padding: 14px 20px;
            font-size: 15px;
            font-weight: 700;
            color: #1a1f36;
            cursor: pointer;
            outline: none;
            position: relative;
            z-index: 1;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: all 0.1s ease-in-out;
        }

        .calc-btn:hover {
            background-color: #b3c0f5;
            color: #1a1f36;
        }

        .calc-btn:active {
            transform: translateY(4px);
            border-bottom-width: 3px; 
            margin-bottom: 4px;
        }

        /* --- Neo-Brutalist Output Box --- */
        .output-container {
            position: relative;
            margin-top: 30px;
        }

        .output-box {
            position: relative;
            background-color: #ffffff;
            border: 4px solid #1a1f36;
            border-radius: 14px;
            padding: 25px 20px;
            z-index: 2;
            min-height: 140px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .result-row {
            font-size: 16px;
            font-weight: 600;
            margin-bottom: 10px;
            color: #333;
        }

        .total-row {
            text-align: center;
            font-size: 17px;
            font-weight: 700;
            margin-top: 25px;
            color: #1a1f36;
        }
    </style>
</head>
<body>

<div class="calculator-card">
    
    <div class="header">
        <div class="header-icon">
            <svg viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg">
                <rect x="22" y="20" width="56" height="40" rx="6" fill="#48cae4"/>
                <path d="M15 65 L85 65 L95 85 L5 85 Z" fill="#48cae4" stroke-linejoin="round"/>
                <rect x="30" y="28" width="40" height="24" rx="3" fill="#ffffff" stroke="none"/>
                <circle cx="35" cy="72" r="3.5" fill="#ffffff" stroke="none"/>
                <circle cx="50" cy="72" r="3.5" fill="#ffffff" stroke="none"/>
                <circle cx="65" cy="72" r="3.5" fill="#ffffff" stroke="none"/>
                <rect x="42" y="79" width="16" height="3" rx="1.5" fill="#ffffff" stroke="none"/>
            </svg>
        </div>
        <div class="header-text">
            <h1>Gold Conversion<br>Calculator</h1>
            <p>Activity 4</p>
        </div>
    </div>

    <!-- Form so PHP can receive POST values -->
    <form method="post">
        <div class="input-wrapper">
            <input type="number" name="gold_weight" id="gold_weight" class="custom-input" placeholder="Enter Gold Weight (Grams)" step="any" required value="<?php echo isset($_POST['gold_weight']) ? htmlspecialchars($_POST['gold_weight']) : ''; ?>">
        </div>
        
        <div class="input-wrapper">
            <input type="number" name="gold_value" id="gold_value" class="custom-input" placeholder="Enter Gold Value" step="any" required value="<?php echo isset($_POST['gold_value']) ? htmlspecialchars($_POST['gold_value']) : ''; ?>">
        </div>

        <div class="btn-wrapper">
            <button type="submit" class="calc-btn">Calculate</button>
        </div>
    </form>

    <div class="output-container">
        <div class="output-box">
            <div>
                <div class="result-row">
                    Equivalent to Ounces:  
                    <?php 
                        if ($_SERVER["REQUEST_METHOD"] == "POST") {
                            // Get values from form
                            $grams = $_POST['gold_weight'] ?? 0;          // Gold weight in grams
                            $price_per_gram = $_POST['gold_value'] ?? 0;  // Price per gram

                            // --- Formula Computations ---
                            // Convert grams to ounces (1 ounce = 28.3495 grams)
                            $ounces = $grams / 28.3495;

                            // Convert grams to kilograms (1 kilogram = 1000 grams)
                            $kilograms = $grams / 1000;

                            // Calculate total gold value (grams * price per gram)
                            $total_value = $grams * $price_per_gram;

                            // Display ounces with 4 decimal places
                            echo number_format($ounces, 4);
                        }
                    ?>
                </div>
                <div class="result-row">
                    Equivalent to Kilograms:  
                    <?php 
                        if ($_SERVER["REQUEST_METHOD"] == "POST") {
                            // Display kilograms with 4 decimal places
                            echo number_format($kilograms, 4);
                        }
                    ?>
                </div>
            </div>
            <div class="total-row">
                Total Gold Value:  
                <?php 
                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                        // Display total gold value with 2 decimal places
                        echo number_format($total_value, 2);
                    }
                ?>
            </div>
        </div>
    </div>

</div>

</body>
</html>