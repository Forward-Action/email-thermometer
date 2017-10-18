# Email Thermometer

## URL Queries
String as many of these together as needed, they all have a default  
**Example:**  
https://www.lewj.ninja/prog/therm.php?contributed=21321312&goal=52000000&contributions=123&datestr=1508167978&showperc=false&showdate=false&showcontributions=false&halfsize=true

### Data Queries

`?geturl=`  
**Type:** URL
**Desc:** Links to a correctly formatted XML document with the data source, it will fetch the data from this

`?datestr=`  
**Type:** Unix Timestamp (eg. `1508168978`)
**Desc:** Controls the "as of" part

`?contributed=`  
**Type:** Unformatted Number (eg. `37820504`)  
**Desc:** The amount of money contributed

`?goal=`  
**Type:** Unformatted Number (eg. `49000000`)  
**Desc:** The money goal

`?contributions=`  
**Type:** Unformatted Number (eg. `1248258`)  
**Desc:** The amount of contributions made

### Display Queries

`?showperc=`  
**Type:** Boolean (eg. `true`)  
**Default:** `true`  
**Desc:** Shows the percentage number on the progress bar

`?showdate=`  
**Type:** Boolean (eg. `true`)  
**Default:** `true`  
**Desc:** Shows the date on the bottom right

`?showcontributions=`  
**Type:** Boolean (eg. `true`)  
**Default:** `true`  
**Desc:** Shows the amount of contributions on the bottom left

`?halfsize=`  
**Type:** Boolean (eg. `true`)  
**Default:** `false`  
**Desc:** Reduces the height of the image to 150px, rather than 200px.  
_Note: only use this if you have `showperc`, `showdate` and `showcontributions` set to false_

`?transbg=`  
**Type:** Boolean (eg. `true`)  
**Default:** `true`  
**Desc:** Sets whether you want a transparent background  
_Note: if you use this make sure you set the bgcolour_

### Colour Queries

`?textcolour=`  
**Type:** Hex Colour (eg. `ff0000`)  
**Default:** `1412cf`  
**Desc:** Sets colour of the contributions/goal text

`?barcolour=`  
**Type:** Hex Colour (eg. `ff0000`)  
**Default:** `4bcc67`  
**Desc:** Sets colour of the thermometer bar

`?labelcolour=`  
**Type:** Hex Colour (eg. `ff0000`)  
**Default:** `464646`  
**Desc:** Sets colour of the labels

`?bgcolour=`  
**Type:** Hex Colour (eg. `ff0000`)  
**Default:** `ffffff`  
**Desc:** Sets colour of the background
_Note: to use this set transbg to false_