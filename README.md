# Email Thermometer

## URL Queries
String as many of these together as needed, they all have a default  
**Example:**  
https://www.lewj.ninja/prog/therm.php?contributed=21321312&goal=52000000&contributions=123&datestr=1508167978&showperc=false&showdate=false&showcontributions=false&halfsize=true&top_left=TEST%20LABEL

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

`?showsignatures=`  
**Type:** Boolean (eg. `true`)  
**Default:** `true`  
**Desc:** Sets whether you want to display signatures on petition.php
_Note: only works on petition.php_

`?showcontributors=`  
**Type:** Boolean (eg. `true`)  
**Default:** `true`  
**Desc:** Sets whether you want to display contributors on monthly.php
_Note: only works on monthly.php_

`?showcontributed=`  
**Type:** Boolean (eg. `true`)  
**Default:** `true`  
**Desc:** Sets whether you want to display contributed on therm.php
_Note: only works on therm.php_

`?currency=`  
**Type:** Currency code  
**Default:** `GBP`  
**Desc:** Set it as GBP, EUR, USD, AUD, CAD

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

### Label Text
_for two words you may need to add `%20` instead of the space ie. `?top_left=TEST%20LABEL`_

`?top_left=`  
**Type:** String (eg. `SIGNATURES`)  
**Default:** `SIGNATURES` _dependant on which thermometer you use_
**Desc:** Sets text of top left label

`?top_right=`  
**Type:** String (eg. `GOAL`)  
**Default:** `GOAL` _dependant on which thermometer you use_
**Desc:** Sets text of top right label

`?bottom_left=`  
**Type:** String (eg. `CONTRIBUTIONS`)  
**Default:** `CONTRIBUTIONS` _dependant on which thermometer you use_
**Desc:** Sets text of bottom left label
