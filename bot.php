<?php

// Get the user's message from the POST request
$userMessage = $_POST['user_message'];

// Initialize the response variable
$response = "";

// Check if the message contains basic arithmetic operators (+, -, *, /)
if (strpbrk($userMessage, '+-*/') !== false) {
    // Handle math equations
    $response = handleMathEquation($userMessage);
} else {
    // Handle regular chat responses
    $response = handleRegularChat($userMessage);
}

// Echo the final response
echo $response;

// Function to handle math equations
function handleMathEquation($equation)
{
    // Remove any "=" sign if present
    $equation = str_replace('=', '', $equation);

    // Check if the expression is complete
    if (!preg_match('/[\d]+[+\-*\/]+[\d]+$/', $equation)) {
        return "It looks like your math equation is not complete. Can you please correct it?";
    }

    try {
        // Use eval to evaluate the math expression
        $result = eval("return $equation;");

        // Check if the result is a valid number
        if (is_numeric($result)) {
            if ($result === INF) {
                return "The result is infinite.";
            } elseif (is_nan($result)) {
                return "The result is undefined.";
            } else {
                return "The answer is $result";
            }
        } else {
            return "The result is undefined or infinite.";
        }
    } catch (DivisionByZeroError $e) {
        return "The result is undefined or infinite.";
    } catch (Exception $e) {
        return "Sorry, there was an error processing the math equation.";
    }
}

// Function to handle regular chat responses
function handleRegularChat($message)
{
    // Load chat responses from knowledge.json
    $knowledgeBase = json_decode(@file_get_contents('knowledge.json'), true);

    // Check if the knowledgeBase is an array
    if (is_array($knowledgeBase) && json_last_error() === JSON_ERROR_NONE) {
        // Check if the user's message is in the knowledge base
        if (array_key_exists(strtolower($message), $knowledgeBase)) {
            return $knowledgeBase[strtolower($message)];
        } else {
            // Handle unknown chat messages here
            return "I'm not sure how to respond to that. Feel free to ask me something else!";
        }
    } else {
        // Handle cases where knowledge.json is not properly loaded
        return "Sorry, there was an issue loading the knowledge base. Please try again later.";
    }
}
?>
