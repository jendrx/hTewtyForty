/**
 * Created by rom on 11/27/17.
 */
function objectifyForm(formArray)
{
    "use strict"
    var objectified = {};
    var i;
    var length;
    for(i = 0; i < length; i++)
    {
        objectified[formArray[i].name] = formArray[i].value;
    }
    return objectified;
}