$(document).ready(function() {
    $('form').submit(function(e) {
        e.preventDefault(); // Отмена действий браузера по умолчанию
        // Очищаем данные от предыдущих запросов
        $('#result').empty();
        $('#result').show();
        $('.errors_list').empty();
        $('.errors_list').show();

        // Отправляем данные на сервер ajax-запросом
        $.ajax({
            type: "POST",
            url: 'calculator.php',
            data: $(this).serialize(),
            success: function(response){
                var jsonData = JSON.parse(response); // Принимаем ответ от сервера
                
                if($.isArray(jsonData.result)){ // Если вернулся массив - возникли ошибки 
                    // Формируем список ошибок и заполняем его данными из массива
                    var cList = $('ul.errors_list')

                    $.each(jsonData.result, function(i)
                    {
                        var li = $('<li/>').appendTo(cList).text(jsonData.result[i]);
                    });
                }else{ // В противном случае - возвращается результат вычисления
                    document.getElementById('result').innerHTML = 'Результат вычисления: ' + jsonData.result; // Вставляем результат в тег
                }
            },
        });
    });
});