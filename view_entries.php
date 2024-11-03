<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Diary Entries</title>
    <link rel="stylesheet" href="css/diary.css">
    <style>
        body {
            background-image: url('img/views.png'); /* Replace with your image path */
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            color: white;
            font-family: Arial, sans-serif;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            min-height: 100vh;
            background-color: #EDC967; /* Fallback color */
        }

        /* Button styling */
        .button {
            background-color: lightblue;
            color: black;
            border: none;
            border-radius: 10px;
            padding: 10px 20px;
            cursor: pointer;
            font-size: 16px;
            margin: 10px 0;
            width: 100%;
        }

        .button:hover {
            background-color: deepskyblue;
        }

        /* Diary Entries Container */
        .entries-container {
            background-color: rgba(0, 0, 0, 0.7);
            width: 90%;
            max-width: 600px;
            max-height: 80vh;
            overflow-y: auto;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.5);
        }

        /* Basic styling for diary entries */
        .entry h3 {
            cursor: pointer;
            color: lightblue;
            text-decoration: underline;
            word-wrap: break-word;
        }

        /* Delete button styling */
        .delete-button {
            background-color: tomato;
            color: white;
            border: none;
            border-radius: 5px;
            padding: 5px 10px;
            cursor: pointer;
            margin-top: 5px;
            width: 100%;
        }

        .delete-button:hover {
            background-color: firebrick;
        }

        /* Modal styling */
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.4);
            padding-top: 60px;
        }

        .modal-content {
            background-color: #fefefe;
            margin: 5% auto;
            padding: 20px;
            width: 90%;
            max-height: 80vh;
            overflow-y: auto;
            border-radius: 10px;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover, .close:focus {
            color: black;
            cursor: pointer;
        }

        /* Image styling */
        #modalImage {
            max-width: 100%;
            height: auto;
            margin-top: 10px;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .entries-container {
                width: 95%;
                padding: 10px;
            }
        }

        @media (max-width: 480px) {
            .modal-content {
                width: 95%;
            }
        }
    </style>
</head>
<body>
    <button class="button" onclick="window.location.href='personal_diary.php'">Back to Diary</button>
    
    <div class="entries-container">
    <?php
    include 'db.php';

    // Fetch diary entries from the database
    $result = $conn->query("SELECT * FROM diary_entries ORDER BY id DESC");

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            // Display each entry as a clickable title
            echo '<div class="entry">';
            echo '<h3><a href="#" onclick="showModal(' . $row['id'] . ', \'' . addslashes($row['title']) . '\', \'' . addslashes($row['content']) . '\', \'' . addslashes($row['password']) . '\', \'' . addslashes($row['mood']) . '\', \'' . addslashes($row['image']) . '\');">' . htmlspecialchars($row['title']) . '</a></h3>';
            
            // Add a delete form with a hidden entry_id field
            echo '<form action="delete_entry.php" method="POST" style="display:inline;">';
            echo '<input type="hidden" name="entry_id" value="' . $row['id'] . '">';
            echo '<button type="submit" class="delete-button">Delete Entry</button>';
            echo '</form>';
            
            echo '</div>';
        }
    } else {
        echo '<p>No entries found.</p>';
    }

    $conn->close();
    ?>
</div>


    <!-- The Modal -->
    <div id="myModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <h3 id="modalTitle"></h3>
            <div id="passwordContainer" style="display:none;">
                <input type="password" id="passwordInput" placeholder="Enter Password" style="width: 100%; padding: 10px; margin: 10px 0;">
                <button id="submitPassword" class="button">Submit</button>
                <p id="passwordError" style="color:red; display:none;">Incorrect password. Please try again.</p>
            </div>
            <div id="modalBody" style="display:none;">
                <p id="moodText"></p>
                <p id="contentText"></p>
                <img id="modalImage" src="" alt="Diary Entry Image" style="display:none;">
            </div>
            <button class="button" onclick="closeModal()">Close</button>
        </div>
    </div>

    <script>
       let currentEntry = {};

function showModal(entryId, title, content, password, mood, image) {
    // Set current entry data
    currentEntry = { entryId, title, content, password, mood, image };
    
    document.getElementById('modalTitle').innerText = title;

    // Reset modal display settings
    document.getElementById('passwordContainer').style.display = password ? 'block' : 'none';
    document.getElementById('modalBody').style.display = password ? 'none' : 'block';
    document.getElementById('modalImage').style.display = image ? 'block' : 'none';

    // Set mood and content if no password is required
    if (!password) {
        document.getElementById('moodText').innerText = mood ? 'Mood: ' + mood : '';
        document.getElementById('contentText').innerText = content;
        if (image) {
            document.getElementById('modalImage').src = image;
        }
    }

    // Display the modal
    document.getElementById("myModal").style.display = "block";
}

document.getElementById('submitPassword').onclick = function () {
    const inputPassword = document.getElementById('passwordInput').value;

    // Check password match
    if (inputPassword === currentEntry.password) {
        document.getElementById('passwordContainer').style.display = 'none';
        document.getElementById('modalBody').style.display = 'block';
        
        // Set mood and content once the correct password is entered
        document.getElementById('moodText').innerText = currentEntry.mood ? 'Mood: ' + currentEntry.mood : '';
        document.getElementById('contentText').innerText = currentEntry.content;
        
        // Set image if it exists
        if (currentEntry.image) {
            document.getElementById('modalImage').src = currentEntry.image;
            document.getElementById('modalImage').style.display = 'block';
        } else {
            document.getElementById('modalImage').style.display = 'none';
        }
        
        document.getElementById('passwordError').style.display = 'none';
    } else {
        // Show error message if password is incorrect
        document.getElementById('passwordError').style.display = 'block';
    }
};

function closeModal() {
    document.getElementById("myModal").style.display = "none";
    document.getElementById('passwordInput').value = '';
    document.getElementById('passwordError').style.display = 'none';
    document.getElementById('modalImage').style.display = 'none';
}

    </script>
</body>
</html>
