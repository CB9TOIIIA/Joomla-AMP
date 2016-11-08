<?php defined('_JEXEC') or die; ?>
<?php
require_once '/amp/amp/vendor/autoload.php';
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
// $amp_html = str_replace('<div id="disqus_thread"></div>', '', $amp_html);
// dump($amp_html,0,'test');
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
<style amp-boilerplate>body{-webkit-animation:-amp-start 8s steps(1,end) 0s 1 normal both;-moz-animation:-amp-start 8s steps(1,end) 0s 1 normal both;-ms-animation:-amp-start 8s steps(1,end) 0s 1 normal both;animation:-amp-start 8s steps(1,end) 0s 1 normal both}@-webkit-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-moz-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-ms-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@-o-keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}@keyframes -amp-start{from{visibility:hidden}to{visibility:visible}}</style><noscript><style amp-boilerplate>body{-webkit-animation:none;-moz-animation:none;-ms-animation:none;animation:none}</style></noscript>
<style amp-custom>
/* any custom style goes here. */
body { background-color: white; overflow: hidden; font-family: Tahoma, Arial, Geneva, sans-serif; }  amp-img { background-color: #fff; } .logo amp-img  {background-color: #fff;} h1 {font-size: 1.1em; padding: 10px; } .logo {text-align: center; width: 95%;} .text {padding: 10px; } .date {margin-left: 5px;}.main-body {   margin: 0 auto 42px;    max-width: 600px; } .text img {max-width: 100%; } .row {position: relative;} .mainsite {background-color: #007E93; text-align: center; padding: 20px 10px;    } .mainsite a {color: #fff;  padding: 10px;}
</style>
</head>

<body>
<div class="main-body">
<?php echo $amp_html; ?>
</div>
</body>
</html>
