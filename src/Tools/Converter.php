<?php

namespace AllrivalSDK\Tools;

use AllrivalSDK\Exceptions\InvalidArgumentException;
use DateTime;

class Converter
{
    /**
     * Конвертирует строку формата Y-m-d?H:i:sT в DateTime
     *
     * @param string $strDate
     * @return DateTime
     */
    public static function convertStrToDt(string $strDate): DateTime
    {
        return DateTime::createFromFormat("Y-m-d?H:i:sT", $strDate);
    }

    /**
     * Конвертирует DateTime в строку формата Y-m-d?H:i:sT
     *
     * @param DateTime $dtDate
     * @return string
     */
    public static function convertDtToStr(DateTime $dtDate): string
    {
        return $dtDate->format("Y-m-d?H:i:sT");
    }

    /**
     * Конвертирует DateTime в Unix-время (Unix timestamp)
     *
     * @param DateTime $dtDate
     * @return int
     */
    public static function convertDtToTimstmp(DateTime $dtDate): int
    {
        return date_timestamp_get($dtDate);
    }

    /**
     * Конвертирует Unix-время (Unix timestamp) в DateTime
     *
     * @param int $timestamp
     * @return DateTime
     */
    public static function convertTimstmpToDt(int $timestamp): DateTime
    {
        return DateTime::createFromFormat('U', $timestamp);
    }

    /**
     * Конвертирует входной параметр $date в строку
     *
     * @param $date
     * @return string
     * @throws InvalidArgumentException
     */
    public static function convertDateToFormat($date, string $format = "d.m.Y, H:i"): string
    {
        if (is_string($date)) {
            if (!self::isCorrectStringDate($date)) {
                throw new InvalidArgumentException("You input date should be Date time or string in format $format\n");
            }

            return $date;
        }

        if ($date instanceof DateTime)
            return $date->format($format);

        if (is_int($date)) {
            if (!($dt = self::convertTimstmpToDt($date))) {
                throw new InvalidArgumentException("Invalid timestamp format\n");
            }

            return $dt->format($format);
        }

        return new InvalidArgumentException('Can\'t convert $date to string, DateTime or Unix timestamp');
    }

    /**
     * Конвертирует время в виде строки или DateTime в Unix время
     *
     * @param $date
     * @return int
     * @throws InvalidArgumentException
     */
    public static function convertDateToTmstmp($date): int
    {
        if (is_string($date)) {
            if (!self::isCorrectStringDate($date)) {
                throw new InvalidArgumentException("You input date should be Date time or string in format $format\n");
            }

            return strtotime($date);
        }

        if ($date instanceof DateTime)
            return $date->getTimestamp();

        throw new InvalidArgumentException('Can\'t convert $date to timestamp');
    }

    /**
     * Проверяет, можно ли сконвертировать строку $time в Unix timestamp
     *
     * @param $str
     * @return bool
     */
    public static function isCorrectStringDate(string $time): bool
    {
        return is_numeric(strtotime($time));
    }
}