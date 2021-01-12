<?php

class FlashMessage {
    /**
    Parameters:
    $name - string
    $value - string

    Description: Записать в массив $_SESSION сообщение $value в ключ $name

    Return value: null
     **/
    private static function put($name, $value) {
        return $_SESSION[$name] = $value;
    }

    /**
    Parameters:
    $name - string

    Description: Проверка на существование переданного ключа $name со значением в массиве $_SESSION

    Return value: boolean
     **/
    public static function exists($name) {
        return (isset($_SESSION[$name])) ? true : false;
    }

    /**
    Parameters:
    $name - string

    Description: Удаление переданного ключа $name с сообщением из массива $_SESSION

    Return value: null
     **/
    private static function delete($name) {
        if(self::exists($name)) {
            unset($_SESSION[$name]);
        }
    }

    /**
    Parameters:
    $name - string

    Description: Получение сообщения из массива $_SESSION по ключу $name

    Return value: string
     **/
    private static function get($name) {
        return $_SESSION[$name];
    }

    /**
    Parameters:
    $name - string
    $string - string

    Description: Запись/Чтение сообщений
     * Если ключ с переданным именем $name существует, то сообщение хранящееся в этом ключе будет возвращено.
     * Иначе в массив $_SESSION будет записан ключ с именем $name и значением $string

    Return value: string
     **/
    public static function flash($name, $string = '') { //работа с flash сообщением
        if(self::exists($name) && self::get($name) !== '') { //если ключ в массиве сессии с переданным именем существует и он не пустой, то получаем значение этого ключа; удаляем ключ со значением из сессии; возвращаем значение этого ключа
            $session = self::get($name);
            self::delete($name);
            return $session;
        } else {
            self::put($name, $string); //иначе создем в сессии ключ с переданным именем и задаем переданное значение этому ключу
        }
    }
}