<?php
class Body{
    
    public function landing_page(){
        ?>
        <main>
            <h1>BEST TURF BOOKING PLATFORM IN YOUR AREA</h1>
            <p>
                Unlock Your Perfect play. Book the Best Turf in a Few Clicks. 
                Say the Time and Place and your Playtime will be Worth
            </p>

            <div class="search">
                <form action=" " method=" ">
                
                <label for="type">Type</label>
                <select name="type" id="type">
                    <option value="football">Football</option>
                    <option value="cricket">Cricket</option>
                    <option value="basketball">Basketball</option>
                    <option value="volleyball">Volleyball</option>
                </select>

                <label for="location">Location</label>
                <select name="location" id="location">
                    <option value="Langata">Langata</option>
                    <option value="SouthC">South C</option>
                    <option value="Karen">Karen</option>
                    <option value="Kileleshwa">Kileleshwa</option>
                </select>

                <label for="date">Date</label>
                <input type="date" name="date" id="date">

                <label for="time">Time</label>
                <input type="time" name="time" id="time">

                <button type="button" id="search">Search</button>

                </form>
            </div>
            <br>
            <br>
            <div>
                <button type="button" id="btn3">Explore</button>
            </div>
        </main>
    </div>

    <div class="explore">
        <h3>Explore turfs near you</h3>
    </div>

    <div class="register-turf">
        <p>Register your Turf with us</p>
        <button type="button" id="btn4">Register</button>
    </div>
    <br>


        <?php
    }
    public function about_us(){
        ?>
        <div class="container">
            <h1>About Playtime</h1>
            <div class="about-content">
                <section class="about-section">
                    <h2>Our Mission</h2>
                    <p>At Playtime, we're passionate about connecting sports enthusiasts with the perfect playing fields. Our mission is to make booking sports facilities as easy as possible, allowing more people to enjoy their favorite games without the hassle of finding and reserving a space.</p>
                </section>

                <section class="about-section">
                    <h2>What We Do</h2>
                    <p>Playtime is a comprehensive platform that bridges the gap between sports facility owners and players. We provide a user-friendly interface for arena owners to list their turfs or other sports facilities, and for players to easily find and book their ideal sport.</p>
                </section>

                <section class="about-section">
                    <h2>Our Vision</h2>
                    <p>We envision a world where every sports enthusiast has easy access to quality playing fields. By streamlining the booking process, we aim to encourage more people to engage in sports, fostering healthier communities and bringing people together through the joy of play.</p>
                </section>

                <section class="about-section">
                    <h2>Join Us</h2>
                    <p>Whether you're a facility owner looking to reach more players or a sports lover searching for the perfect turf, Playtime is here to serve you. Join our growing community and be part of the revolution in sports facility booking!</p>
                </section>
            </div>
        </div>

        <?php
    }
    public function contact_us(){
        ?>
        <div class="container">
            <h1>Contact Us</h1>
            <p>Have questions or feedback? We'd love to hear from you!</p>

            <div class="contact-form">
                <form action="#" method="post">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" id="name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="subject">Subject</label>
                        <input type="text" id="subject" name="subject" required>
                    </div>
                    <div class="form-group">
                        <label for="message">Message</label>
                        <textarea id="message" name="message" required></textarea>
                    </div>
                    <button type="submit" id="btn4contact">Send Message</button>
                </form>
            </div>
        </div>
        <?php
    }
}