<?php /*
                         IOBasic.php
                   requires <script> already exists
*/ ?>
//              IOBasic.php Begins
<?php /*
            Section 1 Input 
*/?><?php // function StrToAr(sstr) : split str to string array using white spaces
?>function StrToAr(str){return str.split(/(\s+)/).filter( function(e) { return e.trim().length > 0; } ); }
<?php //  function StrArToNumAr(ar) : changes all str in array to numbers
?>function StrArToNumAr(ar){for(var i=0;i<ar.length;i++) if(!isNaN(ar[i])) ar[i] = Number(ar[i]); return ar;}
<?php // function TidyStr(str) : replaces all white spaces with single space
?>function TidyStr(str){return StrToAr(str).join(" ");}
<?php // function StrToNumAr(str) : split str to number array using white spaces
?>function StrToNumAr(str){return StrArToNumAr(StrToAr(str)); }
<?php // function StrToMx(str) : split str to str matrix using white spaces
?>function StrToMx(str){var lines = str.split("\n");var mx = [];var j = 0;for(i=0;i<lines.length;i++){var ar = StrToAr(lines[i]);if(ar.length>0)mx.push(ar);}return mx;}
<?php // function StrToNumMx(str) : split str to number matrix using white spaces
?>function StrToNumMx(str){var mx = StrToMx(str);  for(var i=0;i<mx.length;i++)for(var j=0;j<mx[i].length; j++)if(!isNaN(mx[i][j])) mx[i][j] = Number(mx[i][j]);return mx;}
<?php                    
                    // Section 2 : Arrays and Matrix 
?><?php     // function CreateArray(sz,val=null) : create array size se, default null values
?>function CreateArray(sz,val=null){return Array(sz).fill(val);} //use null for val if blanks wanted
<?php // function CreateMatrix(rows,cols,val=null) : create matrix size rows and cols, default null value values
?>function CreateMatrix(rows,cols,val=null){return Array.from({length:rows},()=>new Array(cols).fill(val));};
<?php // function ColumnFromMatrix(mx,col) : returns column col from matrix mx
?>function ColumnFromMatrix(mx,col){return mx.map(e => e[col]);}
<?php // function CopyArray(ar) : copies values to new array
?>function CopyArray(ar){var resAr=[];for(var i=0;i<ar.length;i++)resAr.push(ar[i]);return resAr;};
<?php // function CopyMatrix(mx) : copies values to new matrix
?>function CopyMatrix(mx){var resMx=[];for(var i=0;i<mx.length;i++) resMx.push(CopyArray(mx[i]));return resMx}
<?php // function MxToAr(mx) : convert values, array, matrix(compound) to single array
?>function MxToAr(mx){if(!Array.isArray(mx))return [mx];var ar=[];AddToAr(mx);function AddToAr(mx){for(var i=0;i<mx.length;i++){var x=mx[i];if(!Array.isArray(x)){ar.push(x);}else{AddToAr(x);}}}return ar;}
<?php /*               
                      Section 3 : Numbers 
*/?><?php // function isNumber(value) : check if variable is a number.  returns true/false
?>function isNumber(value){return typeof value === 'number' && isFinite(value);}
<?php /*
                      Section 4 :  Output 
*/ ?><?php // function DStr(n) : returns 4 dec points then truncate if it is a number
?>function DStr(n){if(isNaN(n)) return n;if(Number.isInteger(n)) return n;n = Number(n);n = n.toFixed(4);n = parseFloat(n);return n;}
<?php // function PStr(n) : returns probability to 4 dec points or <0.0001
?>function PStr(n){if(n<0.0001) return "&lt;0.0001";return DStr(n);}
<?php // function InPre(str) : return str inside pre tags 
?>function InPre(str){return `<pre>${str}</pre>`;}
<?php // function InTable(tab) : return body of html table inside table tags <table> </table>
?>function InTable(tab){return `<table>${tab}</table>`; }
<?php // function InNbTable(tab) : return body of html table inside table tags <table class=\"nb\"> </table>
?>function InNbTable(tab){return `<table class=${InQuote("nb")}>${tab}</table>`; }
<?php /* 
           Note complex values mean value, array, matrix or compound matrix
*/?><?php // function InQuote(str) returns "\" + str + "\"
?>function InQuote(str){return "\"" + str + "\""; }
<?php //returns <b>str</b>
?>function InBold(str){return "<b>" + str + "</b>";};
<?php // function InElement(typ,val,csp) : a utility function for td and th, and not directly called
?>function InElement(typ,val,csp){var cs="";if(csp>1)cs=` colspan=${InQuote(csp)}`;return `<${typ}${cs}>${DStr(val)}</${typ}>`;}
<?php // function InTd(val,csp=0) returns <td colspan="csp">val</td> colspan only used if >1
?>function InTd(val,csp=0){return InElement("td",val,csp);}
<?php // function InTh(val,csp=0) : returns <th colspan="csp">val</th> colspan only used if >1
?>function InTh(val,csp=0){return InElement("th",val,csp);}
<?php // function InTr(str) : returns "<tr> + str + "</tr>"
?>function InTr(str){return "<tr>" + str + "</tr>"};
<?php // function ValuesToElementAr(typ,vals) : utility function converting complex values to array of <td> or <th> tags
?>function ValuesToElementAr(typ,vals){var valAr=MxToAr(vals);var resAr=[];for(var i=0;i<valAr.length;i++)resAr.push(InElement(typ,valAr[i],0));return resAr;}
<?php // function ValuesToTdAr(vals) : returns complex values (value, array, matrix, simple or co,plex) to array of td tags
?>function ValuesToTdAr(vals){return ValuesToElementAr("td",vals);}
<?php // function ValuesToThAr(vals) : returns complex values (value, array, matrix, simple or co,plex) to array of td tags
?>function ValuesToThAr(vals){return ValuesToElementAr("th",vals);}
<?php // function RowArToRowStr(rowAr) : converts [<td></td>,...] to <tr>...</tr> string
?>function RowArToRowStr(rowAr){return `${InTr(rowAr.join(""))}`;}
<?php // function ValuesToTdRowStr(vals) : convert complex values (values, arrays, mx) to "<tr><td></td>....</tr>" str
?>function ValuesToTdRowStr(vals){var ar=ValuesToTdAr(vals);return RowArToRowStr(ar);}
function ValuesToRowTable(vals){return InTable(ValuesToTdRowStr(vals));}
function ValuesToNbRowTable(vals){return InNbTable(ValuesToTdRowStr(vals));}
<?php // function ValuesToThRowStr(vals) : convert complex values to "<tr><th></th>....</tr>" str
?>function ValuesToThRowStr(vals){var ar=ValuesToThAr(vals);return RowArToRowStr(ar);}
<?php // function MakeTableFromValueMatrix(mx,typ=0 : convert complex set of values to table (except <table> tags) 
      // typ 0 = all tds, typ=1 has ths in first row
?>function MakeTableFromValueMatrix(mx,typ=0){var resStr="";if(typ==1){resStr+=ValuesToThRowStr(mx[0]);}else{resStr+=ValuesToTdRowStr(mx[0]);}for(var i=1;i<mx.length;i++)resStr+=ValuesToTdRowStr(mx[i]);return resStr;}
<?php // function MakeSimpleTableFromValueMatrix(mx) : convert complex set of values to td table (except <table> tags)
?>function MakeSimpleTableFromValueMatrix(mx){return MakeTableFromValueMatrix(mx); }
<?php // function MakeHeaderTableFromValueMatrix(mx) : convert complex set of values to td table with first row th tags
?>function MakeHeaderTableFromValueMatrix(mx){return MakeTableFromValueMatrix(mx,1); }
<?php // function NbTableFromMx(mx) : nb class table from matric of data
?>function NbTableFromMx(mx){return InNbTable(MakeSimpleTableFromValueMatrix(mx));}
<?php // function NamedTableContent(row1,col1,mx) creates the body of a html table (without the table tags) with row names as first row, colNames as first col, and incorporating mx
?>function NamedTableContent(row1,col1,mx){str=ValuesToThRowStr(["&nbsp;",row1]);for(var i=0;i<col1.length;i++)str+=ValuesToTdRowStr([InBold(col1[i]),mx[i]]);return str;}
<?php // function MakeNamedTable(row1,col1,mx) creates a html table with row names as first row, colNames as first col, and incorporating mx
?>function MakeNamedTable(row1,col1,mx){return InTable(NamedTableContent(row1,col1,mx));}

<?php /*
         3 common table functions 
     */
?><?php // function OutMx(mx) : return a simple matrix in html table format 
?>function OutMx(mx){return InTable(MakeSimpleTableFromValueMatrix(mx));}
<?php // function MakeNbHeaderTable(arRow1,mx) produces nb table with a header and table main
?>function MakeNbHeaderTable(arRow1,mx){str=ValuesToThRowStr(arRow1);for(var i=0;i<mx.length;i++)str+=ValuesToTdRowStr(mx[i]);return InNbTable(str);}
<?php // function MakeNamedNbTable(row1,col1,mx) creates a html table (class=\"nb\") with row names as first row, colNames as first col, and incorporating mx
?>function MakeNamedNbTable(row1,col1,mx){return InNbTable(NamedTableContent(row1,col1,mx));}
<?php /*
         End 3 common table functions 
     */
?>

<?php /* 
                other functions related to widgets and containers. containers are div, span, td, th ?>
       */ 
?><?php // function ShowTableRow(id, show) : show or hide a row in a html table using 0 for hide and 1 for show
?>
function ShowTableRow(id, show){x = "none"; if(show>0)x = "table-row"; document.getElementById(id).style.display=x; }
<?php // function ShowContainer(id, show) : show or hide a containerusing 0 to hide and 1 to show.  containers are div, span, td, th
?>function ShowContainer(id, show){var x = "none"; if(show>0)x = "block"; document.getElementById(id).style.display=x; }
<?php // function InsertToContainer(id,txt) : replaces content of a container with txt
?>function InsertToContainer(id,txt){ document.getElementById(id).innerHTML = txt; } 
<?php // function FromContainer(id) : returns txt from a container
?>function FromContainer(id){ return document.getElementById(id).innerHTML; }
<?php //function ContainerToClipboard(id) : copies txt from container to the clipboard
?>function ContainerToClipboard(id){ navigator.clipboard.writeText(document.getElementById(id).innerHTML); }
<?php // function CanvasToClipboard(canvasId) : copies the png image from the canvas to the clipboard
?>function CanvasToClipboard(canvasId){document.getElementById(canvasId).toBlob(blob => navigator.clipboard.write([new ClipboardItem({'image/png': blob})]))}
//          IOBasic Ends
<?php /*
function NamedTableContent(row1,col1,mx)
{
   str = ValuesToThRowStr(["",row1]);
   for(var i=0;i<col1.length;i++) str += ValuesToTdRowStr([InBold(col1[i]),mx[i]]);
   return str;
}

function MakeNamedTable(row1,col1,mx){ return InTable(NamedTableContent(row1,col1,mx));}
function MakeNamedNbTable(row1,col1,mx){ return InNbTable(NamedTableContent(row1,col1,mx));}

*/ ?>
<?php /*

function TestRun()
{   alert("start");
    var resStr = InPre(StrToAr("a 2 3"));
//    document.getElementById("res").innerHTML = resStr;
    resStr += InPre(StrArToNumAr(["a",2,"3"]));
//    document.getElementById("res").innerHTML = resStr;
    var s = "a 2\t3\n4";
    resStr += InPre(s + "\n" + TidyStr(s));
//    document.getElementById("res").innerHTML = resStr;
    var mx = StrToMx("a 2\n3 4");
    resStr += InTable(MakeSimpleTableFromValueMatrix(mx));
    resStr += OutMx((mx));
//    document.getElementById("res").innerHTML = resStr;
    resStr += InPre(ColumnFromMatrix(mx,1));
//    document.getElementById("res").innerHTML = resStr;
    resStr += InTable(MakeHeaderTableFromValueMatrix(CopyMatrix(mx)));
//    document.getElementById("res").innerHTML = resStr;
    resStr += InPre(MxToAr([1,[2,3],[4,[5],[6,7,8]]]));
//    document.getElementById("res").innerHTML = resStr;
    resStr += InPre(`${isNumber("a")} ${isNumber("2")} ${isNumber(2)}`);
    document.getElementById("res").innerHTML = resStr;
    resStr += InPre(`${DStr(6.54321)} ${DStr("6.54321")} ${DStr(1234567)} ${PStr(0.0001)} ${PStr(0.00009)}`);
//    document.getElementById("res").innerHTML = resStr;
    var row1 = ["c1","c2","c3"];
    var col1 = ["r1","r2","r3","r4"];
    var mx = [["r1c1","r1c2","r1c3"],["r2c1","r2c2","r2c3"],["r3c1","r3c2","r3c3"],["r4c1","r4c2","r4c3"]];
    resStr += MakeNamedNbTable(row1,col1,mx);
    document.getElementById("res").innerHTML = resStr;
}
*/?>