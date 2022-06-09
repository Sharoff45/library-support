composer:

    composer require sharoff45/library-support


## Описание функций и одноименных классов
### isEmptyArrayFilter
    [] === array_filter($array)

### isNotEmptyArrayFilter
    [] !== array_filter($array)

### isEmptyArray [IsEmptyArray]
    [] === $value

### isNotEmptyArray [IsNotEmptyArray]
    true === is_array($value) && [] !== $value

### isNotEmptyString [IsNotEmptyString]
    true === is_string($value) && '' !== $value

### isNotNull [IsNotNull]
    null !== $value

### isNull [IsNull]
    null === $value

### isNullOrEmptyString [IsNullOrEmptyString]
    null === $value || '' === $value

### isNullOrZeroNumber [IsNullOrZeroNumber]
    null === $value || 0 === $value || 0.0 === $value

### Прочее

- `strStartsWith` проверяет, начинается ли строка с указанных символов (подстроки)
- `objectToArray` возвращает данные объекта без рефлексии

```
    class A
    {
    	private $a = 1;
    	protected $b = 2;
    	public $c = 3;
    }

    var_dump(objectToArray(new A));
```
result
```
array:3 [▼
  "a" => 1
  "b" => 2
  "c" => 3
]
```
- `all` Возвращает TRUE, если каждый элемент массива удовлетворяет условию в $callback функции

```
$isBelowThreshold = function ($value) {
    return $value < 40;
};

$items = [1, 30, 39, 29, 10, 13];

var_dump(all($items, $isBelowThreshold));
```
result
```
true
```

- MethodHelper::isSetter - true, если название метода начинается с set[A-Z]
- MethodHelper::isAdder - true, если название метода начинается с add[A-Z]
- MethodHelper::isGetter - true, если название метода начинается с get[A-Z]
- MethodHelper::isLogic - true, если название метода начинается с is[A-Z] или getIs[A-Z]

## Примеры использования с array_filter
```php
use Sharoff45\Library\Support\IsNotEmptyArray;
use Sharoff45\Library\Support\IsNotEmptyString;
use Sharoff45\Library\Support\IsNotNull;
use Sharoff45\Library\Support\IsNull;
use Sharoff45\Library\Support\IsNullOrEmptyString;
use Sharoff45\Library\Support\IsEmptyArray;

// ...
$result = array_filter($list, new IsNotEmptyArray());

//...
$result = array_filter($list, new IsNotEmptyString());

// ...
$result = array_filter($list, new IsNotNull());

//...
$result = array_filter($list, new IsNull());

// ...
$result = array_filter($list, new IsNullOrEmptyString());

// ...
$result = array_filter($list, new IsEmptyArray());
``` 

## Примеры использования в условиях
```php
use function Sharoff45\Library\Support\isEmptyArray;
use function Sharoff45\Library\Support\isNotEmptyArray;
use function Sharoff45\Library\Support\isNotEmptyString;
use function Sharoff45\Library\Support\isNotNull;
use function Sharoff45\Library\Support\isNull;
use function Sharoff45\Library\Support\isNullOrEmptyString;
use function Sharoff45\Library\Support\isEmptyArrayFilter;
use function Sharoff45\Library\Support\isNotEmptyArrayFilter;

if (isEmptyArray($value)) {}

if (isNotEmptyArray($value)) {}

if (isNotEmptyString($value)) {}

if (isNotNull($value)) {}

if (isNull($value)) {}

if (isNullOrEmptyString($value)) {}

if (isEmptyArrayFilter($array)) {}

if (isNotEmptyArrayFilter($array)) {}
```

## Функции для работы с  JSON
### Кидирование 
- Json::encode - возвращает JSON-представление данных
```
echo Json::encode(['a' => 1, 'b' => 2, 'c' => 3, 'd' => 4, 'e' => 5]);
```
result
```
{"a":1,"b":2,"c":3,"d":4,"e":5}
```

### Декодирование 
- Json::decodeAsArray - объекты JSON будут возвращены как ассоциативные массивы (array)
```
var_dump(Json::decodeAsArray('{"a":1,"b":2,"c":3,"d":4,"e":5}'));
```
result
```
array(5) {
    ["a"] => int(1)
    ["b"] => int(2)
    ["c"] => int(3)
    ["d"] => int(4)
    ["e"] => int(5)
}
```
- Json::decodeAsObject - объекты JSON будут возвращены как объекты (object)
```
var_dump(Json::decodeAsObject('{"a":1,"b":2,"c":3,"d":4,"e":5}'));
```
result
```
object(stdClass)#1 (5) {
    ["a"] => int(1)
    ["b"] => int(2)
    ["c"] => int(3)
    ["d"] => int(4)
    ["e"] => int(5)
}
```
```
В случае ошибки возвращается  `JsonException`
```

## Генерация Uuid
Метод UuidGenerator::getUuid используется для того чтобы получить uuid независимо от того получили ли мы на входе ID или уже готовый uuid
