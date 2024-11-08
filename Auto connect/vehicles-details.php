<?php
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    
</head>
<body>
    
<div id="google_translate_element"></div>

<div style="background-color:lightgreen;padding:20px;">
    <h3>This is the first div</h3>
    <p>This is some text inside the first div.</p>
</div>

<div class="notranslate" id="english_paragraph" style="background-color:lightblue;padding:20px;">
    <h3>This is the second div</h3>
    <p><span class="notranslate">This is some text inside the second div.</span></p>
</div>

</body>
<script type="text/javascript">
    function googleTranslateElementInit() {
        new google.translate.TranslateElement(
          {
            pageLanguage: "en",
            includedLanguages: "am,en",
            layout: google.translate.TranslateElement.InlineLayout.SIMPLE,
            autoDisplay: false,
          },
          "google_translate_element"
        );

        // Ensure the specific paragraph always displays in English
        var englishParagraph = document.getElementById("english_paragraph");
        if (englishParagraph) {
            var notranslateElements = englishParagraph.getElementsByClassName("notranslate");
            for (var i = 0; i < notranslateElements.length; i++) {
                notranslateElements[i].setAttribute("translate", "no");
            }
        }
    }
</script>
<script
    type="text/javascript"
    src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"
></script>
</html>
