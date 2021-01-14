<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Examination Tic tac toe Game</title>
</head>

<body>
    <div style="-moz-user-select: none; -webkit-user-select:none; -ms-user-select:none; user-select:none; -moz-user-drag:none; -webkit-user-drag:none; -ms-user-drag:none; user-drag: none;" unselectable="on">
        <p>Welcome Examination Tic tac toe Game.</p>
        <select id="changesize" onchange="myFunction()">
            <option value="2">2*2</option>
            <option value="3">3*3</option>
        </select>
        </br>
        <?php
        new Game();
        ?>
    </div>
</body>

</html>
<?php

class Game
{
    var $position;                       // The Game Board Array
    var $board        = '---------';     // The Game Board from URL.  Default is an Empty Board.
    var $debug        = false;           // Secret debug mode :)
    var $grid_size    = '';               // The game board grid size.


    /**
     * Class Constructor.
     * 
     * Gets and sets the Board size and board pieces
     */

    function __construct()
    {
        // Checks if the game size variable 'size' exists.
        if (isset($_GET['size'])) {
            // Take it from URL.  Trim whitespaces.
            $this->grid_size = trim($_GET['size']);
            $this->board     = str_repeat('-', pow($this->grid_size, 2));
        }

        // Checks if the game board variable 'board' exists.
        if (isset($_GET['board'])) {
            // The Game Board variable exists.
            // Check its length
            if (strlen(trim($_GET['board'])) == 0) {
                // Board variable exists, but contains no value.
                // Treat as new game.
                // This is redundant but just in case.
                $this->board = str_repeat('-', pow($this->grid_size, 2));
            } else {
                // Board variable exists, and contains some characters.
                // Take it from the URL.  Trim whitespaces and convert to lowercase.
                // Additional checks later on.
                $this->board = trim(strtolower($_GET['board']));
            }
        }

        $this->position = str_split($this->board); // From the board variable, convert into the board array.
        // DEBUG MODE
        if (isset($_GET['debug'])) {
            $this->debug = true; // Debug variable declared.  Enable Setting.
            echo 'Game is running in DEBUGGING Mode.  All Possible Winning Lines are displayed below, while the grid displays additional information.<br />';
        }

        $this->game_play();
    }


    function game_play()
    {
        if (!empty($_POST['id'])) {
            echo '<br />'; // Insert blank line.
            // Change font and size for the HTML table
            echo '<font face = "courier" size = "5">';
            // starts the HTML table
            echo '<table cols  " = "' . $this->grid_size = $_POST['id'] . ($this->debug ? $this->grid_size + 2 : $this->grid_size) . '" border = "1" style = "font-weight:bold; border-collapse: collapse">';
            // For Testing / Debugging, display column number headings.
            if ($this->debug) {
                echo '<thead><tr><th></th>';
                for ($col = 1; $col <= $this->grid_size; $col++) {
                    echo '<th style="padding: 5px;"> Column ' . $col . '</th>';
                }
                echo '<th></th></tr></thead>';
                echo '<tfoot><tr><th></th>';
                for ($col = 1; $col <= $this->grid_size; $col++) {
                    echo '<th> Column ' . $col . '</th>';
                }
                echo '<th></th></tr></tfoot>';
            }
            // opens the first row
            echo '<tbody><tr>';
            $row = 1;   // Debugging use only.
            // For Testing / Debugging, display row number heading.
            if ($this->debug) {
                echo '<th style="padding: 5px;">Row ' . $row . '</th>';
            }
            // Iterates through each of the game board cell
            for ($pos = 0; $pos < pow($this->grid_size, 2); $pos++) {
                // Whether or not to generate links

                // display final result with no links
                echo '<td style="text-align:center;' . '"><div style="padding: 1em;">' . $this->position[$pos] . ($this->debug ? ('<br /><span style="font-size:66%;">' . $pos . ':(' . $row . ',' . (($pos % $this->grid_size) + 1) . ')</span>') : '') . '</div></td>';
                if (($pos + 1) % $this->grid_size == 0) {
                    // For Testing / Debugging, display row number heading.
                    if ($this->debug) {
                        echo '<th style="padding: 5px;">Row ' . $row++ . '</th>';
                    }
                    if (($pos + 1) != pow($this->grid_size, 3)) {
                        // Start new row
                        echo '</tr><tr>';
                        // For Testing / Debugging, display row number heading.
                        if ($this->debug) {
                            echo '<th style="padding: 5px;">Row ' . $row . '</th>';
                        }
                    }
                }
            }
            // Closes the last row
            echo '</tr></tbody>';
            // Closes the HTML table
            echo '</table>';
            // Ends the font type and size change
            echo '</font>';
            // Separates the game board from the game status
            echo '<br /><hr />';
        }
    }
}


?>


<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>


<script>
    function myFunction() {
        var x = document.getElementById("changesize").value;

        $.ajax({
            url: "../Test-tictactoe/index.php",
            method: "POST",
            data: 'id=' + x,
            success: function(data) {

            }
        })
    }
</script>