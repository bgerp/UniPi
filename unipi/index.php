<?php

// Neuron API.
require_once('Neuron.php');

// SDM120 API.
require_once('SDM120.php');

// SDM630 API.
require_once('SDM630.php');

// SDM630 API.
require_once('SDM630MCT.php');

//
require_once('evok\EvokDevCfgGenerator.php');

//
require_once ('evok\EvokDevUpdater.php');
// Start

// From DB.
$ip = "176.33.1.153";
//$ip = "10.0.0.111";
$port = 80;
$device_id = 2; // Global device ID.
$uart = "UART_4"; // MODBUS Device ID.

// Master device.
$neuron = new Neuron($ip, $port);
$neuron->update();
$neuron->getParameter('input', '');
$neuron->getParameter('relay', '');
$neuron->getParameter('ai', '');
$neuron->getParameter('ao', '');
$neuron->getParameter('led', '');
$neuron->getParameter('wd', '');
$neuron->getParameter('neuron', '');
$neuron->getParameter('uart', '');
$neuron->getParameter('register', '');

testDeviceParameters($neuron);
//testLeds($neuron);
//testRelays($neuron);
//testUart($neuron);
//testOutput($neuron);
//$sdm120_parameters_values = getSDM120Parameters($neuron, $uart, $device_id);
//$sdm630_parameters_values = getSDM630Parameters($neuron, $uart, $device_id);
$sdm630_parameters_values = getSDM630MCTParameters($neuron, $uart, $device_id);

function testDeviceParameters($neuron)
{
    $last_comm_max = 0.05;
    $last_comm = $neuron->getLastComTime();
    echo ("<br>Last communication time: ".$last_comm.'[s]<br>');

    if($last_comm > $last_comm_max)
    {
        echo ("<br>Communication Alarm: ".$last_comm.'[s]<br>');
    }

    $model = $neuron->getDeviceModel();
    echo ("<br>Model: ".$model.'<br>');
    $sn = $neuron->getDeviceSerialNumber();
    echo ("<br>Serial Number: ".$sn.'<br>');
    $ver = $neuron->getDeviceVersion();
    echo ("<br>Version : ".$ver.'<br>');
}

function testRelays($neuron)
{
    for($index = 1; $index < 5; $index++)
    {
        $neuron->turnRelay($index, 1);
        sleep(0.2);
    }
    for($index = 1; $index < 5; $index++)
    {
        $neuron->turnRelay($index, 0);
        sleep(0.2);
    }
}

function testLeds($neuron)
{
    for($index = 1; $index < 5; $index++)
    {
        $neuron->turnLed($index, 1);
        sleep(0.2);
    }
    for($index = 1; $index < 5; $index++)
    {
        $neuron->turnLed($index, 0);
        sleep(0.2);
    }
}

function testUart($neuron)
{
    $neuron->setUartRegister("UART_1", 2, 0, 0);
    $neuron->setUartRegister("UART_1", 2, 1, 0);
}

function testOutput($neuron)
{
    $ledon = $neuron->turnOutput(1, 0);
}

function uploadHardwareDefinition()
{
    // Create device.
    $delcos_pro = ModbusDeviceFactory::DelcosPro();

    // Get device parameters.
    $regs = $delcos_pro->getRegisters();

    // Create configuration.
    $cfg2 = EvokDevCfgGenerator::createFromParameters(
            'DelcosPro',
            2,
            60,
            1,
            $regs);

    // Local resource path to the file.
    $file_path = __DIR__.'\hw_definitions\DelcosPro.yaml';

    // Generate YAML file for the EVOK.
    yaml_emit_file($file_path, $cfg2);

    // Create updater.
    // Parameters for the connection will come from the ERP DB.
    $deviceUpdater = new EvokDevUpdater(
            '176.33.1.25',
            22,
            'pi',
            'raspberry');

    // Add hardware definition.
    $deviceUpdater->addHardwareDefinition($file_path);

    // Restart the service to update the definitions.
    $deviceUpdater->restartService();
}

function getSDM120Parameters($neuron, $uart, $device_id)
{
    $parameters_values = null;

    try
    {

        /** @var object $sdm120 SDM120 Device.*/
        $sdm120 = new SDM120();

        /** @var Modbus registers IDs. $sdm120_registers_indexes */
        $sdm120_registers_ids = $sdm120->getRegistersIDs();

        /** @var Modbus registers values. $sdm120_registers_values */
        $sdm120_registers_values = $neuron->getUartRegisters($uart, $device_id, $sdm120_registers_ids);

        /** @var Parameters values. $parameters_values */
        $parameters_values = $sdm120->getParametersValues($sdm120_registers_values);
    }
    catch(Exception $e)
    {
        echo("Problem with 1 phase power meter.");
    }

    return $parameters_values;
}

function getSDM630Parameters($neuron, $uart, $device_id)
{
    $parameters_values = null;

    try
    {
        /** @var object $sdm630 SDM630 Device.*/
        $sdm360 = new SDM630();
        
        /** @var Modbus registers IDs. $sdm630_registers_ids */
        $sdm630_registers_ids = $sdm360->getRegistersIDs();

        /** @var Modbus registers values. $sdm630_registers_values */
        $sdm630_registers_values = $neuron->getUartRegisters($uart, $device_id, $sdm630_registers_ids);

        /** @var Parameters values. $parameters_values */
        $parameters_values = $sdm360->getParametersValues($sdm630_registers_values);
    }
    catch(Exception $e)
    {
        echo("Problem with 3 phase power meter.");
    }


    return $parameters_values;
}

function getSDM630MCTParameters($neuron, $uart, $device_id)
{
    $parameters_values = null;

    try
    {
        /** @var object $sdm630 SDM630MCT Device.*/
        $sdm360 = new SDM630MCT();
        
        /** @var Modbus registers IDs. $sdm630_registers_ids */
        $sdm630_registers_ids = $sdm360->getRegistersIDs();

        /** @var Modbus registers values. $sdm630_registers_values */
        $sdm630_registers_values = $neuron->getUartRegisters($uart, $device_id, $sdm630_registers_ids);

        /** @var Parameters values. $parameters_values */
        $parameters_values = $sdm360->getParametersValues($sdm630_registers_values);
    }
    catch(Exception $e)
    {
        echo("Problem with 3 phase power meter.");
    }


    return $parameters_values;
}

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>SDM120 - 2</title>
    </head>
    <body>
        <!-- <br> -->
        <!-- <br> -->
        <!-- <font size="5">1 phase</font> -->
        <!-- <br> -->
        <!-- <table> -->
            <!-- <col width="170"> -->
            <!-- <col width="160"> -->
            <!-- <col width="60"> -->
            <!-- <tr> -->
                <!-- <th>Name</th> -->
                <!-- <th>Value</th> -->
                <!-- <th>Unit</th> -->
            <!-- </tr> -->
            <!-- <tr> -->
                <!-- <td>Voltage</td> -->
                <!-- <td><?php echo number_format($sdm120_parameters_values['Voltage'], 3); ?></td> -->
                <!-- <td>[V]<td> -->
            <!-- </tr> -->
            <!-- <tr> -->
                <!-- <td>Current</td> -->
                <!-- <td><?php echo number_format($sdm120_parameters_values['Current'], 3); ?></td> -->
                <!-- <td>[A]</td> -->
            <!-- </tr> -->
            <!-- <tr> -->
                <!-- <td>Active Power</td> -->
                <!-- <td><?php echo number_format($sdm120_parameters_values['ActivePower'], 3); ?></td> -->
                <!-- <td>[W]</td> -->
            <!-- </tr> -->
            <!-- <tr> -->
                <!-- <td>Apparent Power</td> -->
                <!-- <td><?php echo number_format($sdm120_parameters_values['ApparentPower'], 3); ?></td> -->
                <!-- <td>[W]</td> -->
            <!-- </tr> -->
            <!-- <tr> -->
                <!-- <td>Reactive Power</td> -->
                <!-- <td><?php echo number_format($sdm120_parameters_values['ReactivePower'], 3); ?></td> -->
                <!-- <td>[W]</td> -->
            <!-- </tr> -->
            <!-- <tr> -->
                <!-- <td>Power Factor</td> -->
                <!-- <td><?php echo number_format($sdm120_parameters_values['PowerFactor'], 3); ?></td> -->
                <!-- <td>[&#176]</td> -->
            <!-- </tr> -->
            <!-- <tr> -->
                <!-- <td>Frequency</td> -->
                <!-- <td><?php echo number_format($sdm120_parameters_values['Frequency'], 3); ?></td> -->
                <!-- <td>[Hz]</td> -->
            <!-- </tr> -->
            <!-- <tr> -->
                <!-- <td>Import Active Energy</td> -->
                <!-- <td><?php echo number_format($sdm120_parameters_values['ImportActiveEnergy'], 3); ?></td> -->
                <!-- <td>[W]</td> -->
            <!-- </tr> -->
            <!-- <tr> -->
                <!-- <td>Export Active Energy</td> -->
                <!-- <td><?php echo number_format($sdm120_parameters_values['ExportActiveEnergy'], 3); ?></td> -->
                <!-- <td>[W]</td> -->
            <!-- </tr> -->
            <!-- <tr> -->
                <!-- <td>Import Reactive Energy</td> -->
                <!-- <td><?php echo number_format($sdm120_parameters_values['ImportReactiveEnergy'], 3); ?></td> -->
                <!-- <td>[W]</td> -->
            <!-- </tr> -->
            <!-- <tr> -->
                <!-- <td>Export Reactive Energy</td> -->
                <!-- <td><?php echo number_format($sdm120_parameters_values['ExportReactiveEnergy'], 3); ?></td> -->
                <!-- <td>[W]</td> -->
            <!-- </tr> -->
        <!-- </table> -->
        <?php 
        //print_r($parameters_values);
        ?>
        <br>
        <br>
        <p style="font-size:110%;">3 phase</p>
        <br>
        <table>
            <col width="150">
            <col width="60">
            <col width="60">
            <col width="60">
            <col width="60">
            <tr>
                <th>Name</th>
                <th>L1</th>
                <th>L2</th>
                <th>L3</th>
                <th>Unit</th>
            </tr>
            <tr>
                <td>Voltage</td>
                <td><?php echo number_format($sdm630_parameters_values['Phase1LineToNeutralVolts'], 3); ?></td>
                <td><?php echo number_format($sdm630_parameters_values['Phase2LineToNeutralVolts'], 3); ?></td>
                <td><?php echo number_format($sdm630_parameters_values['Phase3LineToNeutralVolts'], 3); ?></td>
                <td>[V]<td>
            </tr>
            <tr>
                <td>Current</td>
                <td><?php echo number_format($sdm630_parameters_values['Phase1Current'], 3); ?></td>
                <td><?php echo number_format($sdm630_parameters_values['Phase2Current'], 3); ?></td>
                <td><?php echo number_format($sdm630_parameters_values['Phase3Current'], 3); ?></td>
                <td>[A]<td>
            </tr>
            <tr>
                <td>Power</td>
                <td><?php echo number_format($sdm630_parameters_values['Phase1ActivePower'], 3); ?></td>
                <td><?php echo number_format($sdm630_parameters_values['Phase2ActivePower'], 3); ?></td>
                <td><?php echo number_format($sdm630_parameters_values['Phase3ActivePower'], 3); ?></td>
                <td>[W]<td>
            </tr>
            <tr>
                <td>Volt amps.</td>
                <td><?php echo number_format($sdm630_parameters_values['Phase1ApparentPower'], 3); ?></td>
                <td><?php echo number_format($sdm630_parameters_values['Phase2ApparentPower'], 3); ?></td>
                <td><?php echo number_format($sdm630_parameters_values['Phase3ApparentPower'], 3); ?></td>
                <td>[VA]<td>
            </tr>
            <tr>
                <td>Volt amps reactive</td>
                <td><?php echo number_format($sdm630_parameters_values['Phase1ReactivePower'], 3); ?></td>
                <td><?php echo number_format($sdm630_parameters_values['Phase2ReactivePower'], 3); ?></td>
                <td><?php echo number_format($sdm630_parameters_values['Phase3ReactivePower'], 3); ?></td>
                <td>[VAr]<td>
            </tr>
            <tr>
                <td>Power factor</td>
                <td><?php echo number_format($sdm630_parameters_values['Phase1PowerFactor(1)'], 3); ?></td>
                <td><?php echo number_format($sdm630_parameters_values['Phase2PowerFactor(1)'], 3); ?></td>
                <td><?php echo number_format($sdm630_parameters_values['Phase3PowerFactor(1)'], 3); ?></td>
                <td>[&#176]<td>
            </tr>
        </table>
        <br>
        <input type="button" value="Refresh Page" onClick="window.location.reload()">
    </body>
</html> 
