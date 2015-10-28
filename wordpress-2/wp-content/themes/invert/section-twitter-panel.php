<?php global $invert_shortname; ?>
    <div id="bot-twitter">
            <div class="twitter-row">
                <?php
                $numTweets = sketch_get_option($invert_shortname."_numb_lat_tw"); // Number of tweets to display.
                $name = sketch_get_option($invert_shortname."_tw_username");// Username to display tweets from.
                $excludeReplies = true; // Leave out @replies
                $transName = 'list-tweets'; // Name of value in database.
                $cacheTime = sketch_get_option($invert_shortname."_cachetime"); // Time in minutes between updates.
                $backupName = $transName . '-backup';

                // Do we already have saved tweet data? If not, lets get it.
                /*if(false === ($tweets = get_transient($transName) ) ) :*/

                // Get the tweets from Twitter.
                require_once locate_template('/includes/twitteroauth.php');

				$twitter_consumer = sketch_get_option($invert_shortname."_twitter_consumer");
				$twitter_con_s = sketch_get_option($invert_shortname."_twitter_con_s");
				$twitter_acc_t = sketch_get_option($invert_shortname."_twitter_acc_t");
				$twitter_acc_t_s = sketch_get_option($invert_shortname."_twitter_acc_t_s");

                $connection = new TwitterOAuth(
                    $twitter_consumer, // Consumer Key
                    $twitter_con_s, // Consumer secret
                    $twitter_acc_t, // Access token
                    $twitter_acc_t_s // Access token secret
                );

                // If excluding replies, we need to fetch more than requested as the
                // total is fetched first, and then replies removed.
                $totalToFetch = ($excludeReplies) ? max(50, $numTweets * 3) : $numTweets;

                $fetchedTweets = $connection->get(
                    'statuses/user_timeline',
                    array(
                        'screen_name' => $name,
                        'count' => $totalToFetch,
                        'exclude_replies' => $excludeReplies
                    )
                );


                // Did the fetch fail?
                if ($connection->http_code != 200) :
                    $tweets = get_option($backupName); // False if there has never been data saved.
                else :
                    // Fetch succeeded.
                    // Now update the array to store just what we need.
                    // (Done here instead of PHP doing this for every page load)
                    $limitToDisplay = min($numTweets, count($fetchedTweets));

                    for ($i = 0; $i < $limitToDisplay; $i++) :
                        $tweet = $fetchedTweets[$i];

                        // Core info.
                        $name = $tweet->user->name;
                        $permalink = 'http://twitter.com/' . $name . '/status/' . $tweet->id_str;

                        /* Alternative image sizes method: http://dev.twitter.com/doc/get/users/profile_image/:screen_name */
                        $image = $tweet->user->profile_image_url;

                        // Message. Convert links to real links.
                        $pattern = '/http:(\S)+/';
                        $replace = '<a href="${0}" target="_blank" rel="nofollow">${0}</a>';
                        $text = preg_replace($pattern, $replace, $tweet->text);

                        // Need to get time in Unix format.
                        $time = $tweet->created_at;
                        $time = date_parse($time);
                        $uTime = mktime($time['hour'], $time['minute'], $time['second'], $time['month'], $time['day'], $time['year']);

                        // Now make the new array.
                        $tweets[] = array(
                            'text' => $text,
                            'name' => $name,
                            'permalink' => $permalink,
                            'image' => $image,
                            'time' => $uTime
                        );
                    endfor;
                    update_option($backupName, $tweets);
                endif;
                ?>
                <div class="tw-slider clearfix">
                    <ul class="twitter_box slides">
					<?php if($tweets) { ?>
                        <?php foreach ($tweets as $t) : ?>
                            <li class="twitter-item">
								<i class="fa fa-twitter"></i>
                                <?php echo $t['text']; ?>
                                <span class="date"><?php echo human_time_diff($t['time'], current_time('timestamp')); ?>
                                    <?php _e('ago','invert');?>
                                </span>
                            </li>
                        <?php endforeach; ?>
					<?php } else { _e("Please Configure the twitter section in admin : Invert Options > Home Template Twitter Configuration",'invert'); } ?>
                    </ul>
                </div>
            </div>
            <div class="nav"></div>

        <script type="text/javascript">
            jQuery(window).load(function () {
                jQuery('.tw-slider').flexslider({
                    animation: "fade",
                    namespace: "foot-tw-",    //{NEW} String: Prefix string attached to the class of every element generated by the plugin
                    selector: ".slides > li", //{NEW} Selector: Must match a simple pattern. '{container} > {slide}' -- Ignore pattern at your own peril
                    easing: "swing",          //{NEW} String: Determines the easing method used in jQuery transitions. jQuery easing plugin is supported!
                    direction: "vertical",
                    slideshow: true,
					slideshowSpeed: 5000,     //Integer: Set the speed of the slideshow cycling, in milliseconds
					animationSpeed: 600,      //Integer: Set the speed of animations, in milliseconds
                    controlsContainer: "",
                    controlNav: false,        //Boolean: Create navigation for paging control of each clide? Note: Leave true for manualControls usage
                    directionNav: true,       //Boolean: Create navigation for previous/next navigation? (true/false)
                    prevText: "",             //String: Set the text for the "previous" directionNav item
                    nextText: ""
                });
            });
        </script>
 </div> 