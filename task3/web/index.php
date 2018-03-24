<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Дубликаты текста</title>
    <style type="text/css">
        .highlight {
            background-color: yellow;
            font-weight: bolder;
        }
    </style>
</head>
<body>
<textarea rows="12" cols="30" id="text">Повторяющиеся слова слова выделяются жирным жирным.</textarea>
<div id="duplicate_text"></div>
</body>
<script>
    var textElement = document.getElementById('text');
    var duplicateTextElement = document.getElementById('duplicate_text');

    var regex = /([а-яa-z0-9]+)\s+(\1)([\s\.\,]+)/gi;

    textElement.addEventListener('keyup', function(e) {
        var value = e.target.value;
        var newValue = value.replace(regex, '$1 <span class="highlight">$2</span>$3');
        duplicateTextElement.innerHTML = newValue;
    });
</script>
</html>