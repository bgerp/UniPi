<?php
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
 * @title     Eлектромер Eastrongroup SDM630
 * @see       https://bg-etech.de/download/manual/SDM630Register1-5.pdf
 */
class eastrongroup_SDM630 extends sens2_ProtoDriver
{
    /**
     * Заглавие на драйвера
     */
    var $title = 'EASTRONGROUP_SDM630';
    
    
    /**
     * Описание на входовете
     */
    var $inputs = array(
        'Phase1LineToNeutralVolts' => array('caption'=>'Напрежение L1 към N', 'uom' => 'V'),
        'Phase2LineToNeutralVolts' => array('caption'=>'Напрежение L2 към N', 'uom' => 'V'),
        'Phase3LineToNeutralVolts' => array('caption'=>'Напрежение L3 към N', 'uom' => 'V'),
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
        $sdm630_registers_indexes = SDM630::getRegistersIDs();
        
        // Вземи данните за регистрите от източника.
        $sdm630_registers_data = $neuron->getUartRegisters($config->uart, $config->unit, $sdm630_registers_indexes);
        
        // Създай уред и подай данните от регистрите.
        $sdm630 = new SDM630($sdm630_registers_data); 

        
        // Прочитаме изчерпаната до сега мощност
        $res['Phase1LineToNeutralVolts'] = $sdm630->getPhase1Voltage();
        $res['Phase2LineToNeutralVolts'] = $sdm630->getPhase1Voltage();
        $res['Phase3LineToNeutralVolts'] = $sdm630->getPhase1Voltage();
        
        if (empty($addresses)) {
            return "Грешка при четене от {$config->ip}";
        }
                
        return $res;
    } 
}