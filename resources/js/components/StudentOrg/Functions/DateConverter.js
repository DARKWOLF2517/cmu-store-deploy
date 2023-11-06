/**
 * Converts date from yyyy-mm-dd to selected format.
 * Options: 
 *  1 (default) : Month Day, Year
 * @param {String} date
 * @param {Number} option
 * 
 * @returns {String} Converted date.
 */
export function convertDate(date, option = 1)
{
    let new_date = "";
    if(option = 1)
    {
        new_date = new Date(date).toDateString();
    }

    return new_date;
}
