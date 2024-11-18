function test(){
    document.getElementById("test").append('Js Scripting works well');
}
function calculatePrice(startTime, endTime) {
    // Ensure price per hour is correctly set
    const pph = parseFloat(<?=$book[0]['price_per_hour']?>);
    console.log({
        "startTime": startTime,
        "endTime": endTime,
        "pph": pph
    });

    // Convert to Date objects (use a fixed date like '1970-01-01' for comparison)
    const start = new Date(`1970-01-01T${startTime}:00`);
    const end = new Date(`1970-01-01T${endTime}:00`);

    // If the end time is earlier than the start time, it's probably on the next day
    if (end < start) {
        end.setDate(end.getDate() + 1);
    }

    // Calculate the difference in hours
    const diffMs = end - start; // Difference in milliseconds
    const diffHours = diffMs / (1000 * 60 * 60); // Convert milliseconds to hours

    // Calculate the price
    const totalPrice = diffHours * pph;
    console.log(`Total Price: $${totalPrice.toFixed(2)}`);
}

function check() {
    const startTime = $('#timepicker').val();  // Get timepicker value
    const endTime = $('#timepicker2').val();   // Get timepicker value

    if (startTime && endTime) {
        calculatePrice(startTime, endTime);
    } else {
        console.log("Please select both start and end times.");
    }
    console.log();
}

// Trigger check when time is changed
$('#timepicker, #timepicker2').on('change', check);
