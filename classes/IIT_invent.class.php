<?php

interface IIT_invent {
    function getPointsInfo();
    /*
    *
    * Вывод списка всех точек с информацией
    * @return array - результат в виде массива
    *
    */

    function getTehnInfo($id_p);
    /*
    *
    * Вывод списка техники принадлежащей определённой точке 
    * @return array - результат в виде массива
    *
    */

    function addPoint($adress, $id_city, $id_p_type, $inet_1, $inet_2);
    /*
    *
    * Добавление новой точки без привязки к ней техники
    * 
    * @param string $adress - Адрес точки
    * @param integer $id_city - Идентификатор города
    * @param integer $id_p_type - Идентификатор типа точки
    * @param string $inet_1 - Информация об основном канале
    * @param string $inet_2 - Информация о резервном канале
    *
    * @return boolean - результат успех/ошибка
    *
    */

    function addTehn($id_p, $id_tehn, $id_model, $invN, $serN);
    /*
    * Добавление новой техники с привязкой к определённой точке
    * 
    * @param integer $id_p - Идентификатор точки к которой будет привязана техника
    * @param integer $id_tehn_s - Идентификатор наименования техники (Samsung, Ricoh, HP, Xerox...)
    * @param integer $id_model - Идентификатор модели техники
    * @param string $invN - Инвентарный номерр
    * @param string $serN - Серийный номер
    * 
    * @return boolean - резальтат успех/ошибка
    *
    */

    function remPoint($id_p, $delReason, $delDate);
    /*
    * Удаление точки 
    * Подразумевает перемещение всей привязанной техники на склад
    * А точку перемещает в специальную таблицу drop_points
    *
    * @param integer $id_p - Идентификатор удаляемой точки
    *
    * @return boolean - результат успех/ошибка
    */

    function remTehn($id_t, $delReason, $delDate);
    /*
    * Удаление техники
    * Подразумевает перемещение техники в таблицу списания drop_tehn с описанием причины списания
    * Либо если техника удаляется в связи с закрытием точки перемещение на склад
    * При нажатии на кнопку удаления задать вопрос о выполнении действия (удалить/переместить на склад)
    *
    * @param integer $id_t - Идентификатор удаляемой техники
    *
    * @return boolean - резальтат успех/ошибка
    *
    */

    function movTehn($id_t, $id_p);
    /*
    * Перемещение техники со склада на указанную точку
    *
    * @param integer $id_t - Идентификатор перемещаемой техники
    *
    * @return boolean - результат успех/ошибка
    *
    */

}

?>
