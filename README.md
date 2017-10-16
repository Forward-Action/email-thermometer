# Email Thermometer

## URL Queries
String as many of these together as needed, they all have a default  
**Example:**  
https://www.lewj.ninja/prog/therm.php?contributed=21321312&goal=52000000&contributions=123&datestr=1508167978&showperc=false&showdate=false&showcontributions=false&halfsize=true

### Data Queries

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
**Type:** `true`  
**Desc:** Shows the percentage number on the progress bar

`?showdate=`  
**Type:** Boolean (eg. `true`)  
**Type:** `true`  
**Desc:** Shows the date on the bottom right

`?showcontributions=`  
**Type:** Boolean (eg. `true`)  
**Type:** `true`  
**Desc:** Shows the amount of contributions on the bottom left

`?halfsize=`  
**Type:** Boolean (eg. `true`)  
**Type:** `false`  
**Desc:** Reduces the height of the image to 150px, rather than 200px.  
_Note: only use this if you have `showperc`, `showdate` and `showcontributions` set to false_