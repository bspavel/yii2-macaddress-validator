# Yii2 MAC-address validator

### Описание

Это расширение вводит новый тип данных для вашего Yii2-проекта - MAC-адрес.
Валидация происходит как на стороне клиента, так и на сервере.

### Допустимые форматы MAC-адреса

На данный момент валидатор считает валидными следующие форматы MAC-адреса:

    AA:BB:CC:DD:EE:FF
    AA-BB-CC-DD-EE-FF
    AA BB CC DD EE FF

    AABB.CCDD.EEFF
    AABB CCDD EEFF

    AABBCC DDEEFF
    AABBCC-DDEEFF
    AABBCC:DDEEFF

    AABBCCDDEEFF

*Обратите внимание:*
- Указанные выше форматы используются в реальном проекте и также являются валидными для типа данных maccaddr в PostgreSQL;
- Хотя в примерах выше используются буквенные символы в верхнем регистре, на самом деле регистр не важен.

### Установка

В корне вашего проекта в composer.json в раздел "require" пропишите:

    "vakorovin/yii2-macaddress-validator": "dev-master"

и после выполните команду:

    php composer.phar install

Или же выполните команду:

    php composer.phar require --prefer-dist vakorovin/yii2-macaddress-validator "dev-master"

### Использование

	В модели пропишите:

	use vakorovin\yii2_macaddress_validator\MacaddressValidator;

    public function rules()
    {
        return [
			...
            [['mac'], MacaddressValidator::className()],
			...
		];
	}
