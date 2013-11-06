<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
        <link rel="stylesheet" href="/css/default.css" />
        <style>
           body { margin: 10px;}
        </style>

    </head>
    <body>
        <!--[if lt IE 7]>
            <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

            <?php

            printf("Right now is %s", \Carbon\Carbon::now()->toDateTimeString());
            echo '<br/>';
            printf("Right now in Vancouver is %s", \Carbon\Carbon::now('America/Vancouver'));  //implicit __toString()
            echo '<br/>';
            $tomorrow = \Carbon\Carbon::now()->addDay();
            $lastWeek = \Carbon\Carbon::now()->subWeek();
            $nextSummerOlympics = \Carbon\Carbon::createFromDate(2012)->addYears(4);

            $officialDate = \Carbon\Carbon::now()->toRFC2822String();
            printf('Official Date %s',$officialDate); echo '<br/>';
            $howOldAmI = \Carbon\Carbon::createFromDate(1966, 10, 15)->age;
            printf('I am %s years old',$howOldAmI);
            echo '<br/>';

            $noonTodayLondonTime = \Carbon\Carbon::createFromTime(12, 0, 0, 'Europe/London');
            printf('Noon today London Time %s',$noonTodayLondonTime); echo '<br/>';

            $worldWillEnd = \Carbon\Carbon::createFromDate(2012, 12, 21, 'GMT');

            echo $worldWillEnd.'<br>';

            // Don't really want to die so mock now
            // \Carbon\Carbon::setTestNow(\Carbon\Carbon::createFromDate(2000, 1, 1));

            // comparisons are always done in UTC
            // if (\Carbon\Carbon::now()->gte($worldWillEnd)) {
            //    die();
            // }

            // Phew! Return to normal behaviour
            // \Carbon\Carbon::setTestNow();

            (\Carbon\Carbon::now()->isWeekend()) ? printf ('Party!<br />') : printf ('Almost weekend <br />');

            echo \Carbon\Carbon::now()->subMinutes(55)->diffForHumans(); // '2 minutes ago'
            echo '<br />';
            echo \Carbon\Carbon::now()->subSeconds(26)->diffForHumans(); // '2 minutes ago'

            // ... but also does 'from now', 'after' and 'before'
            // rolling up to seconds, minutes, hours, days, months, years

            $daysSinceEpoch = \Carbon\Carbon::createFromTimeStamp(0)->diffInDays();

            ?>

        <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="lib/jquery-2.0.3.min.js"><\/script>')</script>

        <!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
        <script>
            (function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]=
            function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;
            e=o.createElement(i);r=o.getElementsByTagName(i)[0];
            e.src='//www.google-analytics.com/analytics.js';
            r.parentNode.insertBefore(e,r)}(window,document,'script','ga'));
            ga('create','UA-XXXXX-X');ga('send','pageview');
        </script>
    </body>
</html>