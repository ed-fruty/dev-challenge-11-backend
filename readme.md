**Описание**

Приложение позволяет загрузить в систему результаты голосований различных округов в различных форматах (pdf/excel/csv и т.д.) и получать результаты в виде общедоступного api.


**Концепт проекта**

Приложение состоит из нескольких компонентов, каждый из которых содержит четыре слоя.

- Contracts. Слой интерфейсов
- Concern. Слой бизнес логики
- Infrastructure. Реализация контрактов
- Application. Слой приложения

За основу работы был взят CQRS, что позволяет приложению работать отчасти асинхронно.

Места, в которых команды могут хендлиться асинхронно шина вызывает метод `dispatch`. В местах же, где шина должна однозначно сейчас вернуть результат вызывается `dispatchNow`.

Так же используются различные модели чтения/записи данных.

Например документ разделен на две части, такие как:

````php
interface DocumentInterface
{
    public function getPath(): string;
}
````

и

````php
interface DocumetWriteInterface
{
    public function setPath(string $path);
    
    public funtion getReadDocument(): DocumentInterafce;
}
````

что позволяет безопасно использовать модели чтения не беспокоясь, что они будут изменены или их состояние после этого не будет сохранено. 

Изменить какое-либо состояние чего-либо можно только запустив команду на обработку через командную шину.

Выборка из репозиториев происходит через `Спецификации`.

Код конечно не framework agnostic, но не завязан жестко на фреймворке. В бизнес логике используются исключительно три интерфейса фреймворка (диспетчер событий, командная шина и работа с файлами).

Поэтому не составит большой проблемы интегрировать текущую бизнес логику с другими фреймворками, такими как Symfony.

Большинство зависимостей внедряется контейнером через Aware интерфейсы и наследования классов сведены с минимуму.


**Структура проекта**

Практически весь код, отвечающий за работу приложения распологается в **app/Common**

````
app\Common
    Document
        App
            Http
                Actions     Экшены, доступные из веб (контроллеры или аля ADR)
            Listeners       
            Parsers         Парсеры файлов
        Concern
            Commands        Команды для работы с документами
            Handlers        Обработчики команд
            Reader          Основа для чтения документов
            ValueObjects
        Infrastructure      Реализация контактов
    Specifications          Реализация спецификаций
    Vote
        App
            Http
                Actions     
        Concern
            Commands        Команды для работы с голосованиями
            Handlers        Обработчики команд
            ValueObjects
        Contracts           Контракты
        Infrastructure      Реализация контрактов
````

**Процесс**

1. Документ загружается через апи (CreateDocumentAction)
2. Создается синхронная команда (CreateDocumentCommand) и бросается в шину.
3. Обработчк команды (CreateDocumentHandler) загружает файл в облако или на север и создает новую сущность документа.
4. Бросает событие, что документ создан
5. Подписчик узнает, что создан документ и запускает команду, которая может быть асинхронна (ProcessDocumentCommand)
6. Обработчик команды (ProcessDocumentHandler) получает парсер, поддерживающий текущий документ и вытягивает из него все данные для голосований.
7. По очереди создает команды для создания нового голосования (CreateVoteCommand) (синхронные)
8. Записиывает бланки голосов (CreateVoteBlankCommand) (может быть асинхронно)
9. Помечает документ, как обработанный.


**Установка**
К сожалению, из-за отсутствия интернета не смог подготовить vagrant образ...

Требования:
php 7.1.*
ext-sqlite

Требования фреймворка
ext-mbstring
ext-openssl

При желании можно использовать другую sql базу, для этого необходимо изменить настройки в .env файле.

**Запуск**

`php artisan serve`
запустит php веб сервер на 8000 порту.




**Доступные роуты**
Список доступных api методов можно посмотеть выполнив команду

`php artisan route:list`


**Не успел**
- вагрант/докер
- тесты
- поиск зон соприкосновения