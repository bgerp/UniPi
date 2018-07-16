<?php
/**
 * Created by PhpStorm.
 * User: POLYGONTeam Ltd
 * Date: 13.7.2018 г.
 * Time: 14:56
 */

class EvokDevUpdater
{

    #region Variables

    /**
     * @var string $ip IP address of the device.
     */
    private $ip = '';

    /**
     * @var integer $port Port of the device.
     */
    private $port = '';

    /**
     * @var string $user User of the device.
     */
    private $user = '';

    /**
     * @var string $password Password of the device.
     */
    private $password = '';

    /**
     * @var string $remote_hardware_definiotion_path Definitions path.
     */
    private $remote_hardware_definiotion_path = '/etc/hw_definitions/';

    #endregion

    public function __construct($ip, $port, $user, $password)
    {
        $this->ip = $ip;
        $this->port = $port;
        $this->user = $user;
        $this->password = $password;
    }

    public function addHardwareDefinition($file_path)
    {
        $file_name = pathinfo($file_path)['basename'];

        $connection = ssh2_connect($this->ip, $this->port);

        ssh2_auth_password($connection, $this->user, $this->password);

        ssh2_scp_send(
            $connection,
            $file_path,
            $this->remote_hardware_definiotion_path.$file_name,
            0644);

        // Exit.
        ssh2_exec(
            $connection,
            'exit');

        //
        unset($connection);

    }

    public function removeHardwareDefinition($file_name)
    {
        $connection = ssh2_connect($this->ip, $this->port);

        ssh2_auth_password($connection, $this->user, $this->password);

        $sftp = ssh2_sftp($connection);

        ssh2_sftp_unlink(
            $sftp,
            $this->remote_hardware_definiotion_path.$file_name);

        // Exit.
        ssh2_exec(
            $connection,
            'exit');

        //
        unset($connection);

    }

    public function restartService()
    {
        //
        $connection = ssh2_connect($this->ip, $this->port);

        //
        ssh2_auth_password($connection, $this->user, $this->password);

        // Stop the service.
        ssh2_exec(
            $connection,
            'systemctl stop evok');

        // Start the service.
        ssh2_exec(
            $connection,
            'sudo python /opt/evok/evok.py > /dev/null 2>&1 &');

        // Exit.
        ssh2_exec(
            $connection,
            'exit');

        //
        unset($connection);

    }
}