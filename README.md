# spring

A simple little PHP app that will grab the HTML source of a URL, display a list of the HTML tags, the number of occurrences and the HTML source itself. Clicking on the tag buttons will highlight the tags in the HTML source display.

I considered using a PHP DOM parser but was able to get good results with just a few regular expressions. I used the simpler `str_replace` where possible but opted for `preg_replace` as needed. 
