$(document).ready(function() {
    $('form').submit(function(e) {
        e.preventDefault(); // Отмена действий браузера по умолчанию

        //  Отправляем данные на сервер ajax-запросом
        $.ajax({
            type: "POST",
            url: 'calculator.php',
            data: $(this).serialize(),
            success: function(response){
                var jsonData = JSON.parse(response); // Принимаем ответ от сервера

                document.getElementById('result').innerHTML = 'Результат вычисления: ' + jsonData.result;
            }
        });
    });
});