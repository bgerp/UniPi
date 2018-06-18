<?php

// Neuron API.
require_once('Neuron.php');

// SDM120 API.
require_once('SDM120.php');

/**
 * Драйвер за електромер Eastrongroup SDM120
 *
 *
 * @category  bgerp
 * @package   unipi
 * @author    Orlin Dimitrov <orlin369@gmail.com>
 * @copyright 2018 POLYGONTeam OOD
 * @license   GPL 3
 * @since     v 0.1
 * @title     Eлектромер Eastrongroup SDM120
 * @see       https://bg-etech.de/download/manual/SDM120CT-Modbus.pdf
 */
class eastrongroup_SDM120 extends sens2_ProtoDriver
{
    /**
     * Заглавие на драйвера
     */
    var $title = 'EASTRONGROUP_SDM120';
    
    
    /**
     * Описание на входовете
     */
    var $inputs = array(
        'Voltage'              => array('caption'=>'Напрежение', 'uom' => 'V'),
        'Current'              => array('caption'=>'Ток', 'uom' => 'A'),
        'ActivePower'          => array('caption'=>'Активна енергия', 'uom' => 'W'),
        'ApparentPower'        => array('caption'=>'Явна енергия', 'uom' => 'VA'),
    	'ReactivePower'        => array('caption'=>'Реактивна енергия', 'uom' => 'WAr'),
        'PowerFactor'          => array('caption'=>'Косинус Фи', 'uom'=>'Deg'),
        'Frequency'            => array('caption'=>'Честота', 'uom'=>'Hz'),
        'ImportActiveEnergy'   => array('caption'=>'Вх. активна енергия', 'uom'=>'KWh'),
        'ExportActiveEnergy'   => array('caption'=>'Изх. активна енергия', 'uom'=>'KWh'),
        'ImportReactiveEnergy' => array('caption'=>'Вх. реактивна енергия', 'uom'=>'kvarh'),
        'ExportReactiveEnergy' => array('caption'=>'Изх. реактивна енергия', 'uom'=>'kvarh'),
    );
    
    /**
     *  Информация за входните портове на устройството
     *
     * @see  sens2_DriverIntf
     *
     * @return  array
     */
    function getInputPorts()
    {
        foreach($this->inputs as $name => $params) {
            $res[$name] = (object) array('caption' => $params['caption'], 'uom' => $params['uom']);
        }
        return $res;
    }
    
    /**
     * Подготвя форма с настройки на контролера, като добавя полета с $form->FLD(....)
     *
     * @see  sens2_DriverIntf
     *
     * @param core_Form
     */
    function prepareConfigForm($form)
    {
        $form->FNC('ip', 'ip', 'caption=IP,hint=Въведете IP адреса на устройството, input, mandatory');
        $form->FNC('port', 'int(5)', 'caption=Port,hint=Порт, input, mandatory,value=8080');
        $form->FNC('uart', 'int(5)', 'caption=UART,hint=RS485 порт, input, mandatory,value=UART_1');
        $form->FNC('unit', 'int(5)', 'caption=Unit,hint=Unit, input, mandatory,value=2');
        
        // Стойности по подразбиране
        $form->setDefault('port', 8080);
        $form->setDefault('uart', 'UART_1');
        $form->setDefault('unit', 2);
    }
    
    
    /**
     * Връща масив със стойностите на изразходваната активна мощност
     */
    function readInputs($inputs, $config, &$persistentState)
    {
        // Създай източник на дани.
        $neuron = new Neuron($config->ip, $config->port);
        
        // Вземи необходимите регистри.
        $sdm120_registers_indexes = SDM120::getRegistersIDs();
        
        // Вземи данните за регистрите от източника.
        $sdm120_registers_data = $neuron->getUartRegisters($config->uart, $config->unit, $sdm120_registers_indexes);
        
        // Създай уред и подай данните от регистрите.
        $sdm120 = new SDM120($sdm120_registers_data); 
        
        // Прочитаме изчерпаната до сега информация.
        $res['Voltage'] = $sdm120->getVoltage();
        $res['Current'] = $sdm120->getCurrent();
        $res['ActivePower'] = $sdm120->getActivePower();
        $res['ApparentPower'] = $sdm120->getApparentPower();
        $res['ReactivePower'] = $sdm120->getReactivePower();
        $res['PowerFactor'] = $sdm120->getPowerFactor();
        $res['Frequency'] = $sdm120->getFrequency();
        $res['ImportActiveEnergy'] = $sdm120->getImportActiveEnergy();
        $res['ExportActiveEnergy'] = $sdm120->getExportActiveEnergy();
        $res['ImportReactiveEnergy'] = $sdm120->getImportActiveEnergy();
        $res['ExportReactiveEnergy'] = $sdm120->getExportReactiveEnergy();
        
        if (empty($addresses)) {
            return "Грешка при четене от {$config->ip}";
        }
                
        return $res;
    }
    
}