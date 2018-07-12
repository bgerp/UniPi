<?php

require_once ("Data\BasicEnum.php");

/**
 * This class is dedicated to describe one modbus data types.
 */
abstract class ModbusDataTypes extends BasicEnum
{
    const UINT16_T = 'uint16_t';
    const INT16_T = 'int16_t';
    const UINT32_T = 'uint32_t';
    const INT32_T = 'int32_t';
    const FLOAT = 'float';
    const STRING = 'string';
}

