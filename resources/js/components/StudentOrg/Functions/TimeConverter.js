/**
 * 
 * @param {*} time = comes from a parameter pass to this function 
 * @returns 
 */
export function converTime(time)
{
        // Split the time string into hours, minutes, and seconds
        var timeParts = time.split(":");
        var hours = parseInt(timeParts[0]);
        var minutes = timeParts[1];
        var seconds = timeParts[2];

        // Determine whether it's AM or PM
        var period = hours >= 12 ? "PM" : "AM";

        // Convert to 12-hour format
        if (hours > 12) {
        hours -= 12;
        } else if (hours === 0) {
        hours = 12; // Midnight
        }

        // Format the time in 12-hour format with AM/PM
        var time12 = hours + ":" + minutes + ":" + seconds + " " + period;
        
        return time12;
}
