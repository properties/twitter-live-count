<?php

  /*
  https://github.com/properties/twitter-live-count
  */
  
  // Define ID with the post 'ID'
  define("ID", $_POST["id"]);

  // Add HTTP headers to the request
  $tweetHeaders = array(
  'http'=>array(
    'method'=>"GET",
    'header'=>"Accept-language:  nl-NL,nl;q=0.8,en-US;q=0.6,en;q=0.4\r\n" .
              "User-Agent: 	Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/50.0.2661.75 Safari/537.366\r\n" .
              "ACCEPT: 	text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8\r\n"
    )
  );

  // Request the tweet
  $fullHtml = file_get_contents("https://mobile.twitter.com/twitter/status/" . ID, false, stream_context_create($tweetHeaders));

  // Preg match the information
  preg_match("/jsaction=\"click:showRetweetStats\"><b class=\"TweetDetail-statCount\">(.*?)<\/b>/", $fullHtml, $retweetDetail);
  preg_match("/jsaction=\"click:showFavoriteStats\"><b class=\"TweetDetail-statCount\">(.*?)<\/b>/", $fullHtml, $favoriteDetail);
  preg_match("/<div class=\"TweetDetail-text u-textLarge TweetText u-textBreak u-dir\" (.*?)>(.*?)<\/div>/", $fullHtml, $textDetail);
  preg_match("/<b class=\"UserNames-displayName u-linkComplexTarget\">(.*?)<span class=\"u-hiddenVisually\">/", $fullHtml, $displayName);
  preg_match("/<span class=\"UserNames-screenName u-dir\" dir=\"ltr\">(.*?)<\/span>/", $fullHtml, $screenName);


  // Enter the information in a json
  $TweetDetail["retweets"]      = $retweetDetail[1];
  $TweetDetail["favorite"]      = $favoriteDetail[1];
  $TweetDetail["tweet"]         = $textDetail[2];

  $TweetDetail["displayname"]   = $displayName[1];
  $TweetDetail["screenname"]    = $screenName[1];

  // Echo the json
  echo json_encode($TweetDetail, JSON_PRETTY_PRINT);

?>
