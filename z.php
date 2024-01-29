<html>
<head>
<title>Your Website Title</title>
<!-- You can use Open Graph tags to customize link previews.
Learn more: https://developers.facebook.com/docs/sharing/webmasters -->
<meta property="og:url"           content="https://www.your-domain.com/your-page.html" />
<meta property="og:type"          content="website" />
<meta property="og:title"         content="Your Website Title" />
<meta property="og:description"   content="Your description" />
<meta property="og:image"         content="https://www.your-domain.com/path/image.jpg" />
</head>
<body>

<!-- Load Facebook SDK for JavaScript -->
<div id="fb-root"></div>
<script>(function(d, s, id) {
var js, fjs = d.getElementsByTagName(s)[0];
if (d.getElementById(id)) return;
js = d.createElement(s); js.id = id;
js.src = "https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v3.0";
fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<!-- Your share button code -->
<div class="fb-share-button" 
data-href="https://www.your-domain.com/your-page.html" 
data-layout="button_count">
</div>

</body>
</html>

<script>
    setShareLinks();

function socialWindow(url) {
var left = (screen.width -570) / 2;
var top = (screen.height -570) / 2;
var params = "menubar=no,toolbar=no,status=no,width=570,height=570,top=" + top + ",left=" + left;  window.open(url,"NewWindow",params);}

function setShareLinks() {
var pageUrl = encodeURIComponent(document.URL);
var tweet = encodeURIComponent($("meta[property='og:description']").attr("content"));

$(".social-share.facebook").on("click", function() { url="https://www.facebook.com/sharer.php?u=" + pageUrl;
socialWindow(url);
});

$(".social-share.twitter").on("click", function() {
url = "https://twitter.com/intent/tweet?url=" + pageUrl + "&text=" + tweet;
socialWindow(url);
});

$(".social-share.linkedin").on("click", function() {
url = "https://www.linkedin.com/shareArticle?mini=true&url=" + pageUrl;
socialWindow(url);
})
}
</script>


