
<?php include_once 'header.php'; ?>

<br/>
<section class="greetings-section">
    <h1>Welcome to the Database Security Future</h1>
    <br/>
    <p class="justified-text">
        Welcome to our subscriber portal! Our webpage hosts an exclusive Subscriber Portal,
        where you can securely store and manage your information and interests. This user-friendly platform allows you
        to fill out a form, providing us with valuable insights into your preferences and details. Once submitted, your
        profile will seamlessly integrate into our system, and you'll be able to access and share your personalized
        information on the Subscriber Info page.
        <br/>
        <br/>
        <strong>
            Take the next step to enhance your experience, fill out the form, and unlock the full potential of our
            services
            for a truly exceptional subscriber journey!
        </strong>
    </p>
</section>

<br/><br/>

<section class="form-section">

    <h2>Tell Us about You and Your Interests...</h2>
    <br/>
    <!-- Add div that contains the form to create reviews -->
    <div class="form-block" id="rate-form-block">
        <form action="info.php" method="post" id="rateForm">
            <div>
                <label class="form-label" for="avatarURL">Avatar Image URL:</label><br/>
                <input class="full-width" type="text" id="avatarURL" name="avatarURL" placeholder="Enter URL" required>
            </div>
            <div>
                <label class="form-label" for="name">Name:</label><br/>
                <input class="half-width" type="text" id="name" name="name" placeholder="John Peterson" required>
            </div>
            <div>
                <!-- Group of radio buttons for gender selection -->
                <p class="form-label">Gender:</p>
                <label>
                    <input type="radio" name="gender" value="male"> Male
                </label>
                <label>
                    <input type="radio" name="gender" value="female"> Female
                </label>
                <label>
                    <input type="radio" name="gender" value="other"> Other
                </label>
            </div>
            <div>
                <label class="form-label" for="age">Age:</label><br/>
                <input class="half-width" type="number" id="age" name="age" placeholder="29" required>
            </div>
            <div>
                <label class="form-label" for="email">Email:</label><br/>
                <input class="half-width" type="email" id="email" name="email" placeholder="John.peterson@testing.com"
                       required>
            </div>
            <div>
                <p class="form-label">Favorite Languages:</p>
                <input type="checkbox" id="html" name="html" value="html">
                <label for="html"> HTML</label>
                <input type="checkbox" id="css" name="css" value="css">
                <label for="css"> CSS</label>
                <input type="checkbox" id="javascript" name="javascript" value="js">
                <label for="javascript"> JavaScript</label>
            </div>
            <div>
                <label for="about" class="form-label">More about Yourself:</label><br>
                <textarea class="form-textarea half-width" id="about" name="about" rows="6" cols="82" required></textarea>
            </div>



            <br/><br/><br/>
            <div>
                <!-- Submit button for the form -->
                <input type="submit" value="Submit">
            </div>

        </form>
    </div>
</section>

<?php include_once 'footer.php'; ?>
