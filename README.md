# awesome-todolist-yii2
simple todolist based on yii2 basic template

Главная страница
Выводится список задач, отсортированный сперва по факту выполнения, затем по дате дедлайна. Список выводим в формате: “<checkbox> текст задачи, дедлайн, количество комментариев”. Чекбокс кликабелен, в случае его нажатия, выполняется AJAX запрос, задача помечается выполненной и список задач перестраивается (без перезагрузки страницы). Выполненные задачи – зачеркнуты.

Ниже списка – форма добавления новой задачи. А именно: 1 инпут для ввода текста, второй – дедлайн. На поле дедлайн навешиваем datepicker. Добавление задач также AJAX-ом, с предварительной frontend-валидацией.

Каждая задача – ссылка, по клику на нее попадаем на страницу задачи.
Страница задачи
Выводим:
checkbox выполнения задачи (также кликабельный, по клику просто помечаем задачу выполненной. Рекомендуется переиспользовать JS-код для назначения задачи выполненной с главной страницы, тем не менее, учесть, что на главной необходимо обнавление списка задач, а здесь – нет).
заголовок задачи
дедлайн

Ниже: список комментариев, отсортированный по дате в порядке добавления.

Ниже: форма добавления комментариев. Имя + текст комментария.

Обязательно!!!
После применения миграций установить default value = CURRENT_TIMESTAMP для поля postdate в таблице comments.
Дамп базы (на всякий случай) в корневой папке
