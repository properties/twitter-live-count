# twitter-live-count
A PHP live tweet counter for Twitter.

Create a live updating tweet information as easy as this:
```sh
  POST to -> api.php
  
  VALUE -> id : "723413639558885376"
```
Will give an JSON response:
```sh
{
    "retweets": 1,
    "favorite": 5,
    "tweet": "hi, this is a tweet",
    "displayname": "matthew",
    "screenname": "properties"
}
```
