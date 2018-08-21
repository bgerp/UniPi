<?php

require_once ('ModbusDevice.php');
/**
 * Created by PhpStorm.
 * User: POLYGONTeam Ltd
 * Date: 21.8.2018 г.
 * Time: 12:06
 */

class DelcpsPro extends ModbusDevice
{

    #region Constructor

    /**
     * SDM120 constructor.
     */
    public function __construct()
    {
        $registers = $this->createSettings();
        parent::__construct($registers);
    }

    #endregion

    #region Private Methods

    private function createSettings()
    {
        /** @var array $registers Registers description.*/
        $registers = array();

        $registers[0] = new ModbusParameter('SpeedTarget', 'RPM', ModbusDataTypes::UINT16_T, array(35));
        $registers[1] = new ModbusParameter('CurrentMotor', 'A/10', ModbusDataTypes::UINT16_T, array(36));
        $registers[2] = new ModbusParameter('TemperatureHeatsink', 'DegC', ModbusDataTypes::INT16_T, array(37));
        $registers[3] = new ModbusParameter('VoltageDCLink', 'V', ModbusDataTypes::UINT16_T, array(38));
        $registers[4] = new ModbusParameter('SpeedMotorPercentage', 'Percentage', ModbusDataTypes::UINT16_T, array(39));
        $registers[5] = new ModbusParameter('SpeedMotorRPM ', 'RPM', ModbusDataTypes::UINT16_T, array(40));
        $registers[6] = new ModbusParameter('PowerMotorShaft', 'W', ModbusDataTypes::UINT16_T, array(41));
        $registers[7] = new ModbusParameter('PowerCompressorConsumption', 'W', ModbusDataTypes::UINT16_T, array(42));
        $registers[8] = new ModbusParameter('VolumeCompressorPercentage', 'Percentage', ModbusDataTypes::UINT16_T, array(43));
        $registers[9] = new ModbusParameter('VolumeCompressorCubics', 'CubicsPerMin/10', ModbusDataTypes::UINT16_T, array(44));
        $registers[10] = new ModbusParameter('VolumeGroupCubics', 'CubicsPerMin/10', ModbusDataTypes::UINT16_T, array(45));
        $registers[11] = new ModbusParameter('PressureStage1Output', 'mbar', ModbusDataTypes::INT16_T, array(46));
        $registers[12] = new ModbusParameter('PressureLine', 'mbar', ModbusDataTypes::INT16_T, array(47));
        $registers[13] = new ModbusParameter('TemperatureStage1Output', 'DegC', ModbusDataTypes::INT16_T, array(48));

        $registers[14] = new ModbusParameter('Status1', 'BitMatrix', ModbusDataTypes::UINT16_T, array(49));
        $registers[15] = new ModbusParameter('Status2', 'BitMatrix', ModbusDataTypes::UINT16_T, array(50));
        $registers[16] = new ModbusParameter('StartInhibitSource', 'BitMatrix', ModbusDataTypes::UINT16_T, array(51));
        $registers[17] = new ModbusParameter('DI31-16', 'BitMatrix', ModbusDataTypes::UINT16_T, array(52));
        $registers[18] = new ModbusParameter('DI15-0', 'BitMatrix', ModbusDataTypes::UINT16_T, array(53));
        $registers[19] = new ModbusParameter('DO31-16', 'BitMatrix', ModbusDataTypes::UINT16_T, array(54));
        $registers[20] = new ModbusParameter('DO15-0', 'BitMatrix', ModbusDataTypes::UINT16_T, array(55));
        $registers[21] = new ModbusParameter('AO0', 'V',ModbusDataTypes::UINT16_T, array(56));
        $registers[22] = new ModbusParameter('AO1', 'V', ModbusDataTypes::UINT16_T, array(57));

        $registers[23] = new ModbusParameter('FaultRegister4', 'BitMatrix', ModbusDataTypes::UINT16_T, array(103));
        $registers[24] = new ModbusParameter('WarningRegister1', 'BitMatrix', ModbusDataTypes::UINT16_T, array(104));
        $registers[25] = new ModbusParameter('WarningRegister2', 'BitMatrix', ModbusDataTypes::UINT16_T, array(105));
        $registers[26] = new ModbusParameter('WarningRegister3', 'BitMatrix', ModbusDataTypes::UINT16_T, array(106));
        $registers[27] = new ModbusParameter('WarningRegister4', 'BitMatrix', ModbusDataTypes::UINT16_T, array(107));
        $registers[28] = new ModbusParameter('SRFaultRegister1', 'BitMatrix', ModbusDataTypes::UINT16_T, array(108));
        $registers[29] = new ModbusParameter('SRFaultRegister2', 'BitMatrix', ModbusDataTypes::UINT16_T, array(109));
        $registers[30] = new ModbusParameter('SRFaultRegister3', 'BitMatrix', ModbusDataTypes::UINT16_T, array(110));
        $registers[31] = new ModbusParameter('SRFaultRegister4', 'BitMatrix', ModbusDataTypes::UINT16_T, array(111));
        $registers[32] = new ModbusParameter('SRFaultRegister5', 'BitMatrix', ModbusDataTypes::UINT16_T, array(112));
        $registers[33] = new ModbusParameter('RSFaultRegister1', 'BitMatrix', ModbusDataTypes::UINT16_T, array(108));
        $registers[34] = new ModbusParameter('RSFaultRegister2', 'BitMatrix', ModbusDataTypes::UINT16_T, array(109));
        $registers[35] = new ModbusParameter('RSFaultRegister3', 'BitMatrix', ModbusDataTypes::UINT16_T, array(110));
        $registers[36] = new ModbusParameter('RSFaultRegister4', 'BitMatrix', ModbusDataTypes::UINT16_T, array(111));
        $registers[37] = new ModbusParameter('RSFaultRegister5', 'BitMatrix', ModbusDataTypes::UINT16_T, array(112));
        $registers[38] = new ModbusParameter('RSFaultRegister6', 'BitMatrix', ModbusDataTypes::UINT16_T, array(113));
        $registers[39] = new ModbusParameter('RSFaultRegister7', 'BitMatrix', ModbusDataTypes::UINT16_T, array(114));
        $registers[40] = new ModbusParameter('RSFaultRegister8', 'BitMatrix', ModbusDataTypes::UINT16_T, array(115));

        $registers[41] = new ModbusParameter('SoftwareVersion', 'SoftwareVersion', ModbusDataTypes::STRING, array(200, 201, 202, 203, 204, 205, 206, 207, 208, 209, 210, 211, 212, 213));
        $registers[42] = new ModbusParameter('SerialNumber', 'SerialNumber', ModbusDataTypes::STRING, array(214, 215, 216, 217, 218, 219, 220, 221, 222));

        return $registers;
    }

    #endregion

}