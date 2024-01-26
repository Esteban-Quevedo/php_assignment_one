<?php include_once 'header.php'; ?>

<?php

$servername = "localhost";
$username = "root";
$password = "root";
$database = "subscriber_portal";
$table = "subscriber_portal";


// Create a debug variable to control the printing of debug messages.
$debug = false;

// Flag to check if the database already exist
$use_active = false;


// Create Connection
$conn = new mysqli($servername, $username, $password);

// Checking Connection
if ($conn->connect_error) {
    die("Connection Failed: " . $conn->connect_error);
} else {
    if ($debug) {
        echo "<br>Connected Successfully<br>";
    }

// Check if the database exists
    $query = "SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = '$database'";
    $result = $conn->query($query);

    if ($result->num_rows == 0) {
        // If the database doesn't exist, create it
        $createDatabaseQuery = "CREATE DATABASE $database";
        if ($conn->query($createDatabaseQuery) === TRUE) {
            if ($debug) {
                echo "<br>Database '$database' created successfully<br>";
            }

            // Query to use the database
            $query = "USE $database";
            if ($conn->query($query) === TRUE) {
                if ($debug) {
                    echo "<br>Using '$database'<br>";
                }
                // Marking use flag as true
                $use_active = true;

                // Check if the subscriber_portal table exist
                $query = "SHOW TABLES LIKE 'subscriber_portal'";
                if ($conn->query($query) === TRUE) {
                    if ($debug) {
                        echo "<br>The 'subscriber_portal' Table Already Exist<br>";
                    }
                } else {
                    if ($debug) {
                        echo "<br>The 'subscriber_portal' table does not exist<br>";
                    }

                    // Create the subscriber_portal table
                    $query = "CREATE TABLE subscriber_portal
                                        (
                                            id              INT AUTO_INCREMENT PRIMARY KEY,
                                avatarURL       VARCHAR(255)                     NOT NULL,
                                name            VARCHAR(30)                      NOT NULL,
                                gender          ENUM ('Male', 'Female', 'Other') NOT NULL,
                                age             INT                              NOT NULL,
                                email           VARCHAR(30)                      NOT NULL,
                                html            BOOLEAN,
                                css             BOOLEAN,
                                javascript      BOOLEAN,
                                about           TEXT                             NOT NULL
                            )";
                    if ($conn->query($query) === TRUE) {
                        if ($debug) {
                            echo "<br>The 'subscriber_portal' Table created successfully<br>";
                        }

                        // Creating default records
                        $query = "INSERT INTO subscriber_portal (avatarURL, name, gender, age, email, html, css, javascript, about)  VALUES 
                                ('https://drive.google.com/thumbnail?id=1w0NR8FMqmjEedcnMdj9CeUiUBWwQ09WG', 'Emily Johnson', 'Female', 28, 'emily.johnson@example.com', 1, 1, 0, 'Exploring the world of coding and creating amazing web experiences.'), 
                                ('https://drive.google.com/thumbnail?id=1Vooh66VvVqaPBB8ICrUC5Ddnj26T28RJ', 'Sophia Williams', 'Female', 30, 'sophia.williams@example.com', 0, 1, 0, 'Passionate about technology and making a positive impact through programming.'),
                                ('https://drive.google.com/thumbnail?id=153_WwCRYNkQFkFgiRtY20Aom6LVXqixL', 'Daniel Miller', 'Male', 32, 'daniel.miller@example.com', 1, 1, 0, 'Software engineer with a love for problem-solving and building efficient solutions.'),
                                ('https://drive.google.com/thumbnail?id=14hIYqyiKndAfMQf7zJfDoWo9cfqLc4kd', 'Christopher Davis', 'Male', 27, 'chris.davis@example.com', 0, 1, 0, 'Tech enthusiast exploring the endless possibilities of software development.'),
                                ('https://drive.google.com/thumbnail?id=19fMtzUAjzfnDolAQ_R1CehwqXwf9_F7y', 'Leila Wilson', 'Other', 26, 'leila.wilson@example.com', 1, 1, 0, 'Web developer with a passion for creating seamless user experiences.')";
                        if ($conn->query($query) === TRUE) {
                            if ($debug) {
                                echo "<br>Default Records Created Successfully<br>";
                            }
                        } else {
                            if ($debug) {
                                echo "<br>Error Creating default records<br>";
                            }
                        }
                    } else {
                        if ($debug) {
                            echo "<br>Error Creating 'subscriber_portal' table<br>";
                        }

                    }


                }
            } else {
                if ($debug) {
                    echo "<br>Error trying to use '$database'<br>";
                }
            }


        } else {
            if ($debug) {
                echo "<br>Error creating database: " . $conn->error . "<br>";
            }
        }
    } else {
        if ($debug) {
            echo "<br>Database '$database' already exists" . "<br>";
        }
    }
}

// check if the use flag is active
if ($use_active) {
    if ($debug) {
        echo "<br>Already Using '$database'<br>";
    }
} else {
    // Query to use the database
    $query = "USE $database";
    if ($conn->query($query) === TRUE) {
        if ($debug) {
            echo "<br>Using '$database'<br>";
        }
        // Marking use flag as true
        $use_active = true;
    } else {
        if ($debug) {
            echo "<br>Error trying to use '$database'<br>";
        }
    }
}

// initialize the form data var
$formData = array();

if ($use_active) {
    // Check if it comes from the form submit action
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Getting the form data
        $avatarURL = $_POST['avatarURL'];
        $name = $_POST['name'];
        $gender = $_POST['gender'];
        $age = $_POST['age'];
        $email = $_POST['email'];
        if ($_POST['html']){
            $html = 1;
        }
        else {
            $html = 0;
        }
        if ($_POST['css']){
            $css = 1;
        }
        else {
            $css = 0;
        }
        if ($_POST['javascript']){
            $javascript = 1;
        }
        else {
            $javascript = 0;
        }
        $languages = $_POST['languages'];
        $about = $_POST['about'];

        // Printed the received values
        if ($debug) {
            echo "<br>Received Values ('$avatarURL', '$name', '$gender', $age, '$email', $html, $css, $javascript, '$about')<br>";
        }
        // Creating the new record
        $query = "INSERT INTO subscriber_portal (avatarURL, name, gender, age, email, html, css, javascript, about) 
                      VALUES ('$avatarURL', '$name', '$gender', $age, '$email', $html, $css, $javascript, '$about') ";
        if ($conn->query($query) === TRUE) {
            if ($debug) {
                echo "<br>New Record Created Successfully<br>";
            }
        } else {
            if ($debug) {
                echo "<br>Error Creating new records: '$conn->error'<br>";
            }
        }
    }
    // Selecting all the records
    if ($debug) {
        echo "<br>Selecting Records<br>";
    }
    // Query to retrieve records from the subscriber_portal table
    $query = "SELECT * FROM subscriber_portal";
    $result = $conn->query($query);
    // Fetch all rows into an associative array

    while ($row = $result->fetch_assoc()) {
        $formData[] = $row;
    }
} else {
    if ($debug) {
        echo "<br> Error, Use query was not executed before the Select query<br>";
    }
}

// Close the connection
$conn->close();

?>

<br/>
<section class="greetings-section">
    <h1>Interest Repository</h1>
    <br/>
    <p class="justified-text">
        Welcome to our Subscribers Info Repository – your gateway to discovering the diverse interests of our community!
        This page serves as a centralized hub, providing a comprehensive collection of information about our valued
        users. Dive into the vibrant tapestry of interests, hobbies, and preferences that shape the unique identities
        within our community. Explore the Subscribers Info table below to gain insights into our users' diverse tastes
        and discover the rich variety that defines our ever-growing network.
    </p>
</section>

<section class="table-section">
    <h2>Our User Interests</h2>
    <br/>
    <div class="container">
        <table class="data-table">
            <thead>
            <tr>
                <th>Avatar Image</th>
                <th>Name</th>
                <th>Gender</th>
                <th>Age</th>
                <th>Email</th>
                <th>Favorite Languages</th>
                <th>Bio</th>
            </tr>
            </thead>
            <tbody>
            <!-- Loop through each form entry and display it in a table row -->
            <?php foreach ($formData as $entry) : ?>
                <tr>
                    <td><img src="<?php echo $entry['avatarURL']; ?>" alt="Avatar"></td>
                    <td><?php echo $entry['name']; ?></td>
                    <td><?php echo $entry['gender']; ?></td>
                    <td><?php echo $entry['age']; ?></td>
                    <td><?php echo $entry['email']; ?></td>
                    <td>
                        <?php
                        $favoriteLan = array();
                        $counter = 0;
                        if ($entry['html']) {
                            $favoriteLan[$counter] = "HTML";
                            $counter += 1;
                        }
                        if ($entry['css']) {
                            $favoriteLan[$counter] = "CSS";
                            $counter += 1;
                        }
                        if ($entry['javascript']) {
                            $favoriteLan[$counter] = "JavaScript";
                            $counter += 1;
                        }
                        // Accessing elements
                        echo implode(', ', $favoriteLan);
                        ?>
                    </td>
                    <td><?php echo $entry['about']; ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
        <br/><br/><br/>
        <p style="color: #f5f5f5; font-size: small; font-style: italic; text-align: center"> All the Predefined Images
            Avatars where taken
            from unsplash.com The specific link of each picture is register on each image caption.
        </p>
    </div>

</section>

<?php include_once 'footer.php'; ?>
