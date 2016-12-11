<?php defined('_JEXEC') or die; ?>
<?php

preg_match("/\d{1,}.\d{1,}.\d{1,}/", PHP_VERSION, $MyPHPver);
$MyPHPv = $MyPHPver[0];

if ($MyPHPv <= '5.5.30')
{
		die('Вам нужно обновить PHP до ' . '5.5.30' . ' или выше, чтобы использовать Disqus!');
}

?>
<?php
require_once __DIR__ . '/amp/amp/vendor/autoload.php';
use Lullabot\AMP\AMP;
use Lullabot\AMP\Validate\Scope;
?>
<!doctype html>
<html ⚡>
<head>
  <?php
  $document = JFactory::getDocument();
  echo "<title>".$document->title."</title>".PHP_EOL;
  if (!empty($document->description)) {
    echo "<meta name='description' content='".$document->description."'/>";
  }
  else {
    $descr = str_replace("\n", ' ', $document->_custom[8]); //description
    echo $descr;
  }
  $amp = new AMP();
  $html = file_get_contents(JURI::current().'?tmpl=ampcomponent');
  $amp->loadHtml($html);
  $amp_html = $amp->convertToAmpHtml();
  $amp_html = str_replace('<img alt="">', '', $amp_html);
  $amp_html = preg_replace('/<img src="data.+">/','', $amp_html);
  // $amp_html = str_replace('<div id="disqus_thread"></div>', '', $amp_html);
  // dump($amp_html,0,'test');

  $descr = str_replace("\n", "", $descr);
  preg_match('/\<meta name\="description" content\="(.+?)".+\>/', $descr, $descr);
  $descr = $descr[1];
  $descr = str_replace('"', '', $descr);

  $thumb = $document->_custom[3];
  preg_match('/\<meta property\="og\:image" content\="(.+?)"/', $thumb, $thumb);
  $thumb = $thumb[1];

  $articleid = $document->_custom[9];
  $articleCreated = $document->_custom[10];
  preg_match('/\<meta name\="article\-created" content\="(.+?)"\>/', $articleCreated, $articleCreated);
  $articleCreated = $articleCreated[1];
  $articleCreatedYear = date('Y-m-d',strtotime($articleCreated));
  $articleCreatedTime = date('H:i:s',strtotime($articleCreated));
  $articledate = $articleCreatedYear.'T'.$articleCreatedTime.'Z';

  $articleModified = $document->_custom[11];
  preg_match('/\<meta name\="article\-modified" content\="(.+?)"\>/', $articleModified, $articleModified);
  $articleModified = $articleModified[1];
  $articleModifiedYear = date('Y-m-d',strtotime($articleModified));
  $articleModifiedTime = date('H:i:s',strtotime($articleModified));
  $articledateMod = $articleModifiedYear.'T'.$articleModifiedTime.'Z';
  list($wIMG,$hIMG,$tIMG) = getimagesize($thumb);
  ?>
  <?php $titlewithoutquote = str_replace('"','',$document->title);  ?>

  <?php
  echo '<script type="application/ld+json">{
    "@context": "http://schema.org",
    "@type": "NewsArticle",
    "headline": "'.JString::substr(str_replace(' - mysite', '',$titlewithoutquote), 0, 110).'",
    "description": "'.$descr.'",
    "name": "'.$titlewithoutquote.'",
    "url": "'.JURI::current().'",
    "mainEntityOfPage":{
      "@type":"WebPage",
      "@id":"'.JURI::current().'"
    },
    "thumbnailUrl": "'.$thumb.'",
    "dateCreated": "'.$articledate.'",
    "datePublished": "'.$articledate.'",
    "dateModified": "'.$articledateMod.'",
    "author": {
      "@type": "Organization",
      "name": "YOUR-NAME-PLEASE-ENTER-HERE"
    },
    "publisher": {
      "@type": "Organization",
      "name": "YOUR-NAME-PLEASE-ENTER-HERE",
      "logo": {
        "@type": "ImageObject",
        "url": "http://mysite.ru/images/logo.png",
        "width": "218",
        "height": "84"
      }
    },
    "image": {
      "@type": "ImageObject",
      "representativeOfPage": "true",
      "url": "'.$thumb.'",
      "width": "'.$wIMG.'",
      "height": "'.$hIMG.'"
    }
  }</script>';

  ?>

  <meta charset="utf-8">
  <link rel='canonical' href='<?php echo JURI::current(); ?>' >
  <meta name="viewport" content="width=device-width,minimum-scale=1,initial-scale=1">
  <script async custom-element="amp-analytics" src="https://cdn.ampproject.org/v0/amp-analytics-0.1.js"></script>
  <script async src="https://cdn.ampproject.org/v0.js"></script>
  <script async custom-element="amp-ad" src="https://cdn.ampproject.org/v0/amp-ad-0.1.js"></script>
  <script async custom-element="amp-youtube" src="https://cdn.ampproject.org/v0/amp-youtube-0.1.js"></script>
  <script async custom-element="amp-sidebar" src="https://cdn.ampproject.org/v0/amp-sidebar-0.1.js"></script>
  <script async custom-element="amp-iframe" src="https://cdn.ampproject.org/v0/amp-iframe-0.1.js"></script>
  <script async custom-element="amp-facebook" src="https://cdn.ampproject.org/v0/amp-facebook-0.1.js"></script>
  <style amp-boilerplate>body{-webkit-animation:-amp-start 8s steps(1,end) 0s 1 normal both;-moz-animation:-amp-start 8s steps(1,end) 0s 1 normal both;-ms-animation:-amp-start 8s steps(1,end) 0s 1 normal both;animation:-amp-start 8s steps(1,end) 0s 1 normal both}@-webkit-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-moz-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-ms-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-o-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}</style><noscript><style amp-boilerplate>body{-webkit-animation:none;-moz-animation:none;-ms-animation:none;animation:none}</style></noscript>
  <style amp-custom>
  /* any custom style goes here. */
  body { background-color: white; overflow: hidden; font-family: Tahoma, Arial, Geneva, sans-serif; }  amp-img { background-color: #fff; } .logo amp-img  {background-color: #fff;} h1 {font-size: 1.1em; padding: 10px; } .logo {text-align: center; width: 95%;} .text {padding: 10px; } .date {margin-left: 5px;}.main-body {   margin: 0 auto 42px;    max-width: 600px; } .text img {max-width: 100%; } .row {position: relative;} .mainsite {background-color: #007E93; text-align: center; padding: 20px 10px;    } .mainsite a {color: #fff;  padding: 10px;}.printlogo amp-img {    width: 218px;    height: auto;    margin-left: auto;    margin-right: auto;    margin-bottom: 15px;    margin-top: 5px; } .urlarticleprint, .print {display:none;} .author {  text-indent: 10px; }  .author a {color: #000;} .date {    margin-left: 5px;    display: inline-block;    width: 70%;    padding: 0px;    margin: 5px;}  .author {    text-indent: 10px;    display: inline-block;    line-height: 3.3; } .text li a {    color: #000;    line-height: 1.8; } .dopblock {    display: inline; } .specyoutube {    white-space: normal;}
  </style>

    <meta content="summary" property="twitter:card" />
    <meta name="twitter:card" content="summary" />
    <meta name="twitter:site" content="@twittername" />
    <meta name="twitter:creator" content="twittername" />
  </head>

  <body>

    <div class="main-body">
      <amp-analytics type="metrika">
        <script type="application/json">
        {
          "vars": {
            "counterId": "111111111"
          }
        }
        </script>
      </amp-analytics>

      <amp-analytics id="analytics_liveinternet">
        <script type="application/json">{
          "requests": {
            "pageview": "https://counter.yadro.ru/hit?u${ampdocUrl};r${documentReferrer};s${screenWidth}*${screenHeight}*32;${random}"
          },
          "triggers": {
            "track pageview": {
              "on": "visible",
              "request": "pageview"
            }
          }
        }</script>
      </amp-analytics>

      <amp-analytics type="googleanalytics" id="googleanalytics">
        <script type="application/json">
        {
          "vars": {
            "account": "UA-11111111-1"
          },
          "triggers": {
            "defaultPageview": {
              "on": "visible",
              "request": "pageview",
              "vars": {
                "title": "AMP Pageview"
              }
            }
          }
        }
        </script>
      </amp-analytics>

      <?php echo $amp_html; ?>

    </div>
  </body>
  </html>
