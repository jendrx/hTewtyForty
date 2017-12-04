function parseChartData(data) {
    "use strict";

    var keys = Object.keys(data[0]);
    var cols = [];
    var rows = [];
    var keyIndex;
    var keysLength = keys.length;
    var rowIndex = 0;
    var length = data.length;

    for (keyIndex = 0; keyIndex < keysLength; keyIndex ++)
    {
        if(keyIndex > 1)
        {
            cols.push({label : keys[keyIndex], type : 'number', role:'interval'});
        }
        else
        {
            cols.push({label : keys[keyIndex], type : 'number'});
        }
    }
    for (rowIndex = 0; rowIndex < length; rowIndex ++)
    {
        var rowValues = Object.values(data[rowIndex]);
        var values = [];
        var colIndex;
        var rowLength = rowValues.length;
        for(colIndex = 0; colIndex < rowLength; colIndex ++)
        {
            values.push({v:rowValues[colIndex]});
        }
        rows.push({c:values});
    }
    return {cols:cols,rows:rows};
}

