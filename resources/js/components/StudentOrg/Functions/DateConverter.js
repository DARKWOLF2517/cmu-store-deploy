/**
 * Converts date from yyyy-mm-dd to selected format.
 * Options:
 *  1 (default) : Month Day, Year
 * @param {String} date
 * @param {Number} option
 *
 * @returns {String} Converted date.
 */
export function convertDate(date, option = 1) {
    let new_date = "";
    const options = {
        1: { // Option 1: Month Day, Year
            month: 'long',
            day: 'numeric',
            year: 'numeric'
        }
        // Add more options as needed
    };

    const selectedOption = options[option] || options[1]; // Default to Option 1 if invalid option is provided

    try {
        new_date = new Date(date).toLocaleDateString(undefined, selectedOption);
    } catch (error) {
        console.error("Error converting date:", error.message);
    }

    return new_date;
}
