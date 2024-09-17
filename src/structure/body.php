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
}